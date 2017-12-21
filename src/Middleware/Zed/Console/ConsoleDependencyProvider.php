<?php

namespace Middleware\Zed\Console;

use Spryker\Shared\Config\Environment;
use Spryker\Zed\CodeGenerator\Communication\Console\BundleClientCodeGeneratorConsole;
use Spryker\Zed\CodeGenerator\Communication\Console\BundleCodeGeneratorConsole;
use Spryker\Zed\CodeGenerator\Communication\Console\BundleServiceCodeGeneratorConsole;
use Spryker\Zed\CodeGenerator\Communication\Console\BundleSharedCodeGeneratorConsole;
use Spryker\Zed\CodeGenerator\Communication\Console\BundleYvesCodeGeneratorConsole;
use Spryker\Zed\CodeGenerator\Communication\Console\BundleZedCodeGeneratorConsole;
use Spryker\Zed\Console\ConsoleDependencyProvider as SprykerDependencyProvider;
use Spryker\Zed\Development\Communication\Console\CodeArchitectureSnifferConsole;
use Spryker\Zed\Development\Communication\Console\CodePhpMessDetectorConsole;
use Spryker\Zed\Development\Communication\Console\CodeStyleSnifferConsole;
use Spryker\Zed\Development\Communication\Console\CodeTestConsole;
use Spryker\Zed\Development\Communication\Console\GenerateClientIdeAutoCompletionConsole;
use Spryker\Zed\Development\Communication\Console\GenerateIdeAutoCompletionConsole;
use Spryker\Zed\Development\Communication\Console\GenerateServiceIdeAutoCompletionConsole;
use Spryker\Zed\Development\Communication\Console\GenerateYvesIdeAutoCompletionConsole;
use Spryker\Zed\Development\Communication\Console\GenerateZedIdeAutoCompletionConsole;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Transfer\Communication\Console\GeneratorConsole;
use Spryker\Zed\Transfer\Communication\Console\ValidatorConsole;
use SprykerMiddleware\Zed\Process\Communication\Console\ProcessConsole;

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
        $commands[] = new GeneratorConsole();
        $commands[] = new ProcessConsole();
        if (Environment::getEnvironment() == self::DEV_ENVIRONMENT) {
            $commands[] = new CodeTestConsole();
            $commands[] = new CodeStyleSnifferConsole();
            $commands[] = new CodePhpMessDetectorConsole();
            $commands[] = new CodeArchitectureSnifferConsole();
            $commands[] = new ValidatorConsole();
            $commands[] =new BundleCodeGeneratorConsole();
            $commands[] =new BundleYvesCodeGeneratorConsole();
            $commands[] =new BundleZedCodeGeneratorConsole();
            $commands[] =new BundleServiceCodeGeneratorConsole();
            $commands[] =new BundleSharedCodeGeneratorConsole();
            $commands[] =new BundleClientCodeGeneratorConsole();
            $commands[] =new GenerateZedIdeAutoCompletionConsole();
            $commands[] =new GenerateClientIdeAutoCompletionConsole();
            $commands[] =new GenerateServiceIdeAutoCompletionConsole();
            $commands[] =new GenerateYvesIdeAutoCompletionConsole();
            $commands[] =new GenerateIdeAutoCompletionConsole();
        }
        return $commands;
    }
}
