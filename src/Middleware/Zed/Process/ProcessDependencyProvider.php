<?php
namespace Middleware\Zed\Process;

use Middleware\Zed\Process\Communication\Plugin\Configuration\MapGeneratorConfigurationPlugin;
use Middleware\Zed\Process\Communication\Plugin\Configuration\ProductImportConfigurationPlugin;
use Middleware\Zed\Process\Communication\Plugin\Hook\DummyPostProcessorHookPlugin;
use Middleware\Zed\Process\Communication\Plugin\Hook\DummyPreProcessorHookPlugin;
use Middleware\Zed\Process\Communication\Plugin\MapGeneratorMapperStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\MapGeneratorTranslatorStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\ProductImportMapperStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\ProductImportTranslatorStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\ProductImportValidatorStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\TranslatorFunction\MixedToNullTranslatorFunctionPlugin;
use Spryker\Zed\Kernel\Container;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Configuration\DefaultConfigurationProfilePlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Iterator\NullIteratorPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\JsonReaderStagePlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\JsonWriterStagePlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Stream\JsonStreamPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\TranslatorFunction\ArrayToStringTranslatorFunctionPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\TranslatorFunction\ExcludeKeysAssociativeFilterTranslatorFunctionPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\TranslatorFunction\MoneyDecimalToIntegerTranslatorFunctionPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\TranslatorFunction\StringToArrayTranslatoFunctionPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\TranslatorFunction\StringToDateTimeTranslatorFunctionPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\TranslatorFunction\StringToFloatTranslatorFunctionPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\TranslatorFunction\WhitelistKeysAssociativeFilterTranslatorFunctionPlugin;
use SprykerMiddleware\Zed\Process\ProcessDependencyProvider as SprykerMiddlewareProcessDependencyProvider;

class ProcessDependencyProvider extends SprykerMiddlewareProcessDependencyProvider
{
    const PRODUCT_IMPORT_INPUT_STREAM_PLUGIN = 'PRODUCT_IMPORT_INPUT_STREAM_PLUGIN';
    const PRODUCT_IMPORT_OUTPUT_STREAM_PLUGIN = 'PRODUCT_IMPORT_OUTPUT_STREAM_PLUGIN';
    const PRODUCT_IMPORT_ITERATOR_PLUGIN = 'PRODUCT_IMPORT_ITERATOR_PLUGIN';
    const PRODUCT_IMPORT_STAGE_PLUGINS = 'PRODUCT_IMPORT_STAGE_PLUGINS';
    const PRODUCT_IMPORT_PRE_PROCESSOR_PLUGINS = 'PRODUCT_IMPORT_PRE_PROCESSOR_PLUGINS';
    const PRODUCT_IMPORT_POST_PROCESSOR_PLUGINS = 'PRODUCT_IMPORT_POST_PROCESSOR_PLUGINS';

    const MAP_GENERATOR_INPUT_STREAM_PLUGIN = 'MAP_GENERATOR_INPUT_STREAM_PLUGIN';
    const MAP_GENERATOR_OUTPUT_STREAM_PLUGIN = 'MAP_GENERATOR_OUTPUT_STREAM_PLUGIN';
    const MAP_GENERATOR_ITERATOR_PLUGIN = 'MAP_GENERATOR_ITERATOR_PLUGIN';
    const MAP_GENERATOR_STAGE_PLUGINS = 'MAP_GENERATOR_STAGE_PLUGINS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);
        $this->addProductImportProcessPlugins($container);
        $this->addMapGeneratorProcessPlugins($container);

        return $container;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ConfigurationProfilePluginInterface[]
     */
    protected function getConfigurationProfilePluginsStack(): array
    {
        return [
            new DefaultConfigurationProfilePlugin(),
        ];
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ProcessConfigurationPluginInterface[]
     */
    protected function getDefaultProcessesPluginsStack(): array
    {
        return [
            new ProductImportConfigurationPlugin(),
            new MapGeneratorConfigurationPlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductImportProcessPlugins(Container $container)
    {
        $container[static::PRODUCT_IMPORT_INPUT_STREAM_PLUGIN] = function () {
            return new JsonStreamPlugin();
        };
        $container[static::PRODUCT_IMPORT_OUTPUT_STREAM_PLUGIN] = function () {
            return new JsonStreamPlugin();
        };

        $container[static::PRODUCT_IMPORT_ITERATOR_PLUGIN] = function () {
            return $this->getProductImportIteratorPlugin();
        };

        $container[static::PRODUCT_IMPORT_STAGE_PLUGINS] = function () {
            return $this->getProductImportStagePluginsStack();
        };

        $container[static::PRODUCT_IMPORT_PRE_PROCESSOR_PLUGINS] = function () {
            return $this->getProductImportPreProcessorPluginsStack();
        };

        $container[static::PRODUCT_IMPORT_POST_PROCESSOR_PLUGINS] = function () {
            return $this->getProductImportPostProcessorPluginsStack();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addMapGeneratorProcessPlugins(Container $container)
    {
        $container[static::MAP_GENERATOR_INPUT_STREAM_PLUGIN] = function () {
            return new JsonStreamPlugin();
        };
        $container[static::MAP_GENERATOR_OUTPUT_STREAM_PLUGIN] = function () {
            return new JsonStreamPlugin();
        };

        $container[static::MAP_GENERATOR_ITERATOR_PLUGIN] = function () {
            return $this->getMapGeneratorIteratorPlugin();
        };

        $container[static::MAP_GENERATOR_STAGE_PLUGINS] = function () {
            return $this->getMapGeneratorStagePluginsStack();
        };

        return $container;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface
     */
    protected function getProductImportIteratorPlugin()
    {
        return $this->getNullIterator();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface
     */
    protected function getMapGeneratorIteratorPlugin()
    {
        return $this->getNullIterator();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface
     */
    protected function getNullIterator()
    {
        return new NullIteratorPlugin();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PreProcessorHookPluginInterface[][]
     */
    protected function getProductImportPreProcessorPluginsStack(): array
    {
        return [
            new DummyPreProcessorHookPlugin(),
        ];
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface[][]
     */
    protected function getProductImportPostProcessorPluginsStack(): array
    {
        return [
            new DummyPostProcessorHookPlugin(),
        ];
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    protected function getProductImportStagePluginsStack()
    {
        return [
            new JsonReaderStagePlugin(),
            new ProductImportValidatorStagePlugin(),
            new ProductImportMapperStagePlugin(),
            new ProductImportTranslatorStagePlugin(),
            new JsonWriterStagePlugin(),
        ];
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    protected function getMapGeneratorStagePluginsStack()
    {
        return [
            new JsonReaderStagePlugin(),
            new MapGeneratorMapperStagePlugin(),
            new MapGeneratorTranslatorStagePlugin(),
            new JsonWriterStagePlugin(),
        ];
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\TranslatorFunction\TranslatorFunctionPluginInterface[]
     */
    protected function getGenericTranslatorFunctionsStack(): array
    {
        $pluginsStack = parent::getGenericTranslatorFunctionsStack();
        $pluginsStack[] = new MixedToNullTranslatorFunctionPlugin();

        return $pluginsStack;
    }
}
