<?php
namespace Middleware\Zed\Process;

use Middleware\Zed\Process\Communication\Plugin\Hook\DummyPostProcessorHookPlugin;
use Middleware\Zed\Process\Communication\Plugin\Hook\DummyPreProcessorHookPlugin;
use Middleware\Zed\Process\Communication\Plugin\MapGeneratorMapperStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\MapGeneratorTranslatorStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\ProductImportMapperStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\ProductImportTranslatorStagePlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Iterator\NullIteratorPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\JsonReaderStagePlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\JsonWriterStagePlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Stream\JsonStreamPlugin;
use SprykerMiddleware\Zed\Process\ProcessDependencyProvider as SprykerMiddlewareProcessDependencyProvider;

class ProcessDependencyProvider extends SprykerMiddlewareProcessDependencyProvider
{
    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PreProcessorHookPluginInterface[][]
     */
    protected function getPreProcessorHooksStack(): array
    {
        return [
            new DummyPreProcessorHookPlugin(),
        ];
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface[][]
     */
    protected function getPostProcessorHooksStack(): array
    {
        return [
            new DummyPostProcessorHookPlugin(),
        ];
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    protected function getStagePluginsStack()
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
    protected function getIteratorsStack()
    {
        return [
            new NullIteratorPlugin(),
        ];
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\ProcessStreamPluginInterface[]
     */
    protected function getStreamPluginsStack()
    {
        return [
            new JsonStreamPlugin(),
        ];
    }
}
