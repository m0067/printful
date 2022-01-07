<?php

declare(strict_types=1);

namespace Dev\Printful;

class ConsoleApp
{
    public function run(): void
    {
        foreach (\glob($this->getProjectDir().'/src/Command/*Command.php') as $fileName) {
            $className = pathinfo($fileName)['filename'];
            $command = '\\Dev\\Printful\\Command\\'.$className;

            if ($command::getName() === $this->getArg()) {
                (new $command)->execute();
            }
        }
    }

    public function getProjectDir(): string
    {
        return \dirname(__DIR__);
    }

    public static function getTempDir(): string
    {
        $dir = \sys_get_temp_dir();

        if (isset($_ENV['CONSOLE_APP']) && $_ENV['consoleApp'] === 'test') {
            $dir .= '/tests';
        }

        return $dir;
    }

    private function getArg(): string
    {
        $arg = $_SERVER['argv'][1] ?? '';

        return (string)$arg;
    }
}
