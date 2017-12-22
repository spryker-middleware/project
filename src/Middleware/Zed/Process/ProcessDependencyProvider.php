<?php
namespace Middleware\Zed\Process;

use Middleware\Zed\Process\Communication\Plugin\MapGeneratorMapperStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\MapGeneratorTranslatorStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\ProductImportMapperStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\ProductImportTranslatorStagePlugin;
use SprykerMiddleware\Zed\Process\Business\Iterator\NullIterator;
use SprykerMiddleware\Zed\Process\Communication\Plugin\JsonReaderStagePlugin;
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
    public function registerProcesses(): array
    {
        return [
            static::MAP_GENERATOR_PROCESS => [
                static::PIPELINE => static::MAP_GENERATOR_PIPELINE,
            ],
            static::PRODUCT_IMPORT_PROCESS => [
                static::PIPELINE => static::PRODUCT_IMPORT_PIPELINE,
                static::ITERATOR => NullIterator::class
            ],
        ];
    }

    /**
     * @return array
     */
    public function registerPipelines(): array
    {
        return [
            static::MAP_GENERATOR_PIPELINE => [
                new MapGeneratorMapperStagePlugin(),
                new MapGeneratorTranslatorStagePlugin(),
            ],
            static::PRODUCT_IMPORT_PIPELINE => [
                new JsonReaderStagePlugin(),
                new ProductImportMapperStagePlugin(),
                new ProductImportTranslatorStagePlugin(),
            ],
        ];
    }

    /**
     * @return array
     */
    public function registerPreProcessorHooks(): array
    {
        return [
            static::MAP_GENERATOR_PROCESS => [],
            static::PRODUCT_IMPORT_PROCESS => [],
        ];
    }

    /**
     * @return array
     */
    public function registerPostProcessorHooks(): array
    {
        return [
            static::MAP_GENERATOR_PROCESS => [],
            static::PRODUCT_IMPORT_PROCESS => [],
        ];
    }
}
