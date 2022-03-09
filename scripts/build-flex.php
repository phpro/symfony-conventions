<?php

use Psl\Collection\Map;
use function Psl\Dict\reindex;
use function Psl\Filesystem\read_directory;
use function Psl\Filesystem\read_file;
use function Psl\Filesystem\write_file;
use function Psl\Iter\reduce_with_keys;
use function Psl\Json\encode;
use function Psl\Str\replace;
use function Psl\Vec\keys;

$base = dirname(__DIR__);
require_once $base.'/vendor/autoload.php';

$recipes = require $base.'/recipes.php';
$recipesDir = $base.'/recipes';
$configs = new Map(reindex(
    read_directory($base.'/configs'),
    static fn (string $file) => basename($file)
));


$placeFileInline = static fn(string $file): array => [
    'contents' => explode("\n", read_file($file)),
    'executable' => false,
];

$syncFiles = static fn (array $files): array => reduce_with_keys(
    $files,
    static fn(array $inlined, string $recipeFileName, string $file): array
        => [...$inlined, $recipeFileName => $placeFileInline($configs->at(basename($recipeFileName)))],
    []
);

$calculateManifestRef = static fn (array $manifest): array => [
    ...$manifest,
    'ref' => sha1(encode($manifest)),
];

$buildManifest = static fn (string $package, $files): array => [
    'manifests' => [
        $package => $calculateManifestRef([
            'manifest' => [
                'copy-from-recipe' => $files,
            ],
            'files' => $syncFiles($files),
        ]),
    ],
];


$branch = $_SERVER['FLEX_BRANCH'] ?? 'master';
$fork = $_SERVER['FLEX_FORK'] ?? 'phpro';

$buildIndex = static fn (array $recipes): array => [
    'recipes' => $recipes,
    'branch' => $branch,
    'is_contrib' => true,
    '_links' => [
        'repository' => 'github.com/'.$fork.'/conventions',
        'origin_template' => '{package}:{version}@github.com/'.$fork.'/conventions:'.$branch,
        'recipe_template' => 'https://api.github.com/repos/'.$fork.'/conventions/contents/recipes/{package_dotted}.{version}.json?ref='.$branch
    ]
];

$manifestTarget = static fn (string $package, string $version): string =>
    $recipesDir . '/' . replace($package, '/', '.') . '.' . $version . '.json';

$writeJson = static function (string $file, array $contents): void {
    write_file($file, encode(
        [
            'WARNING' => 'This file is auto-generated and may only be changed by computers!',
            ...$contents,
        ],
        true
    ));
};

$index = [];
foreach ($recipes as $package => $versions) {
    $index[$package] = keys($versions);

    foreach ($versions as $version => $files) {
        $manifest = $buildManifest($package, $files);
        $targetRecipeFile = $manifestTarget($package, $version);
        $writeJson($targetRecipeFile, $manifest);
        echo 'Parsed recipe '.$targetRecipeFile.PHP_EOL;
    }
}

$writeJson($base.'/index.json', $buildIndex($index));
echo 'Updated index.json'.PHP_EOL;

echo 'DONE'.PHP_EOL;
