<?php
namespace Middleware\Zed\Process\Communication;

use Middleware\Zed\Process\ProcessDependencyProvider;
use SprykerMiddleware\Zed\Process\Communication\ProcessCommunicationFactory as SprykerMiddlewareProcessCommunicationFactory;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Log\MiddlewareLoggerConfigPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface;

/**
 * @method \Middleware\Zed\Process\ProcessConfig getConfig()
 */
class ProcessCommunicationFactory extends SprykerMiddlewareProcessCommunicationFactory
{
    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Log\MiddlewareLoggerConfigPluginInterface
     */
    public function getDefaultLogConfigPlugin(): MiddlewareLoggerConfigPluginInterface
    {
        return $this->getProvidedDependency(ProcessDependencyProvider::MIDDLEWARE_DEFAULT_LOG_CONFIG_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface
     */
    public function getProductImportInputStreamPlugin(): InputStreamPluginInterface
    {
        return $this->getProvidedDependency(ProcessDependencyProvider::PRODUCT_IMPORT_INPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface
     */
    public function getProductImportOutputStreamPlugin(): OutputStreamPluginInterface
    {
        return $this->getProvidedDependency(ProcessDependencyProvider::PRODUCT_IMPORT_OUTPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface
     */
    public function getMapGeneratorInputStreamPlugin(): InputStreamPluginInterface
    {
        return $this->getProvidedDependency(ProcessDependencyProvider::MAP_GENERATOR_INPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface
     */
    public function getMapGeneratorOutputStreamPlugin(): OutputStreamPluginInterface
    {
        return $this->getProvidedDependency(ProcessDependencyProvider::MAP_GENERATOR_OUTPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface
     */
    public function getProductImportIteratorPlugin(): ProcessIteratorPluginInterface
    {
        return $this->getProvidedDependency(ProcessDependencyProvider::PRODUCT_IMPORT_ITERATOR_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PreProcessorHookPluginInterface[][]
     */
    public function getProductImportPreProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(ProcessDependencyProvider::PRODUCT_IMPORT_PRE_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface[][]
     */
    public function getProductImportPostProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(ProcessDependencyProvider::PRODUCT_IMPORT_POST_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    public function getProductImportStagePluginsStack(): array
    {
        return $this->getProvidedDependency(ProcessDependencyProvider::PRODUCT_IMPORT_STAGE_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface
     */
    public function getMapGeneratorIteratorPlugin(): ProcessIteratorPluginInterface
    {
        return $this->getProvidedDependency(ProcessDependencyProvider::MAP_GENERATOR_ITERATOR_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    public function getMapGeneratorStagePluginsStack(): array
    {
        return $this->getProvidedDependency(ProcessDependencyProvider::MAP_GENERATOR_STAGE_PLUGINS);
    }
}
