<?php

return [
    'phpro/conventions' => [
        '*' => [
            'configs/grumphp.yaml' => 'grumphp.yaml.dist',
            'configs/.php-cs-fixer.php' => '.php-cs-fixer.php',
        ],
        '1.0' => [
            'configs/grumphp.yaml' => 'grumphp.yaml.dist',
            'configs/.php-cs-fixer.php' => '.php-cs-fixer.php',
        ],
    ],
    'phpstan/phpstan' => [
        '1.4' => [
            'configs/phpstan.neon' => 'phpstan.neon',
        ],
    ],
    'vimeo/psalm' => [
        '4.22' => [
            'configs/psalm.xml' => 'psalm.xml',
        ],
    ],
];
