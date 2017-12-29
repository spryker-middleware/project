<?php
namespace Middleware\Zed\Process;

use Middleware\Zed\Process\Communication\Plugin\Hook\DummyPostProcessorHookPlugin;
use Middleware\Zed\Process\Communication\Plugin\Hook\DummyPreProcessorHookPlugin;
use Middleware\Zed\Process\Communication\Plugin\MapGeneratorMapperStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\MapGeneratorTranslatorStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\ProductImportMapperStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\ProductImportTranslatorStagePlugin;
use SprykerMiddleware\Zed\Process\Business\Iterator\NullIterator;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Iterator\NullIteratorPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\JsonReaderStagePlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\JsonWriterStagePlugin;
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
            static::PRODUCT_IMPORT_PROCESS => [
                static::ITERATOR => NullIterator::class,
            ],
        ];
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PreProcessorHookPluginInterface[][]
     */
    public function getPreProcessorHooksStack(): array
    {
        return [
            new DummyPreProcessorHookPlugin(),
        ];
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface[][]
     */
    public function getPostProcessorHooksStack(): array
    {
        return [
            new DummyPostProcessorHookPlugin(),
        ];
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    public function getStagePluginsStack()
    {
        return [
            new JsonReaderStagePlugin(),
            new ProductImportMapperStagePlugin(),
            new ProductImportTranslatorStagePlugin(),
            new JsonWriterStagePlugin(),
            new MapGeneratorMapperStagePlugin(),
            new MapGeneratorTranslatorStagePlugin(),
        ];
    }
    
    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface[]
     */
    public function getIteratorsStack()
    {
        return [
            new NullIteratorPlugin(),
        ];
    }
}
