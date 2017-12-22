<?php
namespace Middleware\Zed\Process;

use Middleware\Zed\Process\Communication\Plugin\MapGeneratorMapperStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\MapGeneratorTranslatorStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\ProductImportMapperStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\ProductImportTranslatorStagePlugin;
use SprykerMiddleware\Zed\Process\ProcessDependencyProvider as SprykerMiddlewareProcessDependencyProvider;

class ProcessDependencyProvider extends SprykerMiddlewareProcessDependencyProvider
{
    const MAP_GENERATOR_PIPELINE = 'MAP_GENERATOR_PIPELINE';
    const PRODUCT_IMPORT_PIPELINE = 'PRODUCT_IMPORT_PIPELINE';
    const MAP_GENERATOR_PROCESS = 'MAP_GENERATOR_PROCESS';
    const PRODUCT_IMPORT_PROCESS = 'PRODUCT_IMPORT_PROCESS';

    const PIPELINE = 'PIPELINE';

    /**
     * @return array
     */
    public function getProcesses(): array
    {
        return [
            static::MAP_GENERATOR_PROCESS => [
                static::PIPELINE => static::MAP_GENERATOR_PIPELINE,
            ],
            static::PRODUCT_IMPORT_PROCESS => [
                static::PIPELINE => static::PRODUCT_IMPORT_PIPELINE,
            ],
        ];
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[][]
     */
    public function getPipelines(): array
    {
        return [
            static::MAP_GENERATOR_PIPELINE => [
                new MapGeneratorMapperStagePlugin(),
                new MapGeneratorTranslatorStagePlugin(),
            ],
            static::PRODUCT_IMPORT_PIPELINE => [
                new ProductImportMapperStagePlugin(),
                new ProductImportTranslatorStagePlugin(),
            ],
        ];
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PreProcessorHookPluginInterface[][]
     */
    public function getPreProcessorHooks(): array
    {
        return [
            static::MAP_GENERATOR_PROCESS => [],
            static::PRODUCT_IMPORT_PROCESS => [],
        ];
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface[][]
     */
    public function getPostProcessorHooks(): array
    {
        return [
            static::MAP_GENERATOR_PROCESS => [],
            static::PRODUCT_IMPORT_PROCESS => [],
        ];
    }
}
