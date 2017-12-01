<?php

namespace Middleware\Zed\Console;

use Spryker\Shared\Config\Environment;
use Spryker\Zed\Console\ConsoleDependencyProvider as SprykerDependencyProvider;
use Spryker\Zed\Development\Communication\Console\CodePhpMessDetectorConsole;
use Spryker\Zed\Development\Communication\Console\CodeStyleSnifferConsole;
use Spryker\Zed\Development\Communication\Console\CodeTestConsole;
use Spryker\Zed\Kernel\Container;

class ConsoleDependencyProvider extends SprykerDependencyProvider
{
    const DEV_ENVIRONMENT = 'middleware-development';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Symfony\Component\Console\Command\Command[]
     */
    public function getConsoleCommands(Container $container)
    {
        $commands = [];
        if (Environment::getEnvironment() == self::DEV_ENVIRONMENT) {
            $commands[] = new CodeTestConsole();
            $commands[] = new CodeStyleSnifferConsole();
            $commands[] = new CodePhpMessDetectorConsole();
        }
        return $commands;
    }
}
