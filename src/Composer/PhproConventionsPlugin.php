<?php declare(strict_types=1);

namespace PHProConventions\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class PhproConventionsPlugin implements PluginInterface
{
    private IOInterface $io;
    private Composer $composer;

    public function activate(Composer $composer, IOInterface $io)
    {
        $this->io = $io;
        $this->composer = $composer;
        $this->installFiles();
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {
        // TODO: Implement deactivate() method.
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
        // TODO: Implement uninstall() method.
    }

    private function safeCopy(string $file): void
    {
        $path = getcwd() . '/' . $file;
        if (file_exists($path)) {
            return;
        }
        $this->io->write('Installing ' . $file);
        copy(__DIR__ . '/../../' . $file, $path);
    }

    public function installFiles(): void
    {
        $this->safeCopy('phpstan.neon');
        $this->safeCopy('grumphp.yml');
        $this->safeCopy('.php_cs.php');
    }
}