<?php

namespace Middleware\Zed\Process;

use Middleware\Shared\Process\ProcessConstants;
use Middleware\Zed\Process\Communication\Plugin\Hook\DummyPostProcessorHookPlugin;
use Middleware\Zed\Process\Communication\Plugin\Hook\DummyPreProcessorHookPlugin;
use Middleware\Zed\Process\Communication\Plugin\MapGeneratorMapperStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\MapGeneratorTranslatorStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\ProductImportMapperStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\ProductImportTranslatorStagePlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Iterator\NullIteratorPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\JsonReaderStagePlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\JsonWriterStagePlugin;
use SprykerMiddleware\Zed\Process\ProcessConfig as SprykerMiddlewareProcessConfig;

class ProcessConfig extends SprykerMiddlewareProcessConfig
{
    /**
     * @return array
     */
    public function getProcessesConfig()
    {
        return [
            ProcessConstants::MAP_GENERATOR_PROCESS => [
                MapGeneratorMapperStagePlugin::PLUGIN_NAME,
                MapGeneratorTranslatorStagePlugin::PLUGIN_NAME,
            ],
            ProcessConstants::PRODUCT_IMPORT_PROCESS => [
                JsonReaderStagePlugin::PLUGIN_NAME,
                ProductImportMapperStagePlugin::PLUGIN_NAME,
                ProductImportTranslatorStagePlugin::PLUGIN_NAME,
                JsonWriterStagePlugin::PLUGIN_NAME,
            ],
        ];
    }

    /**
     * @return array
     */
    public function getProcessIteratorsConfig()
    {
        return [
            ProcessConstants::PRODUCT_IMPORT_PROCESS => NullIteratorPlugin::PLUGIN_NAME,
        ];
    }

    /**
     * @return array
     */
    public function getPreProcessorHooksConfig()
    {
        return [
            ProcessConstants::PRODUCT_IMPORT_PROCESS => [
                DummyPreProcessorHookPlugin::PLUGIN_NAME,
            ],
        ];
    }

    /**
     * @return array
     */
    public function getPostProcessorHooksConfig()
    {
        return [
            ProcessConstants::PRODUCT_IMPORT_PROCESS => [
                DummyPostProcessorHookPlugin::PLUGIN_NAME,
            ],
        ];
    }

    /**
     * @return string
     */
    public function getProductImportPath()
    {
        return $this->get(ProcessConstants::PRODUCT_IMPORT_FILE_PATH);
    }

    /**
     * @return string
     */
    public function getProductImportOutputPath()
    {
        return $this->get(ProcessConstants::PRODUCT_IMPORT_OUTPUT_PATH);
    }

    /**
     * @return string
     */
    public function getMapSourcePath()
    {
        return $this->get(ProcessConstants::MAP_SOURCE_FILE_PATH);
    }

    /**
     * @return string
     */
    public function getMapGeneratorOutputPath()
    {
        return $this->get(ProcessConstants::GENERATED_MAP_FILE_PATH);
    }
}
