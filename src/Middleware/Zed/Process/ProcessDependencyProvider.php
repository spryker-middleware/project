<?php
namespace Middleware\Zed\Process;

use Middleware\Zed\Process\Communication\Plugin\MapGeneratorMapperStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\MapGeneratorTranslatorStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\MapGeneratorWriterStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\ProductImportMapperStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\ProductImportTranslatorStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\ProductImportWriterStagePlugin;
use SprykerMiddleware\Zed\Process\ProcessDependencyProvider as SprykerMiddlewareProcessDependencyProvider;

class ProcessDependencyProvider extends SprykerMiddlewareProcessDependencyProvider
{
    const MAP_GENERATOR_PROCESS = 'MAP_GENERATOR_PROCESS';
    const PRODUCT_IMPORT_PROCESS = 'PRODUCT_IMPORT_PROCESS';

    /**
     * @return array
     */
    public function registerProcessStages()
    {
        $stages = [
            static::MAP_GENERATOR_PROCESS => [
                new MapGeneratorMapperStagePlugin(),
                new MapGeneratorTranslatorStagePlugin(),
                new MapGeneratorWriterStagePlugin(),
            ],
            static::PRODUCT_IMPORT_PROCESS => [
                new ProductImportMapperStagePlugin(),
                new ProductImportTranslatorStagePlugin(),
                new ProductImportWriterStagePlugin(),
            ],
        ];

        return $stages;
    }
}
