<?php

namespace Middleware\Zed\Process;

use Middleware\Shared\Process\ProcessConstants;
use SprykerMiddleware\Zed\Process\ProcessConfig as SprykerMiddlewareProcessConfig;

class ProcessConfig extends SprykerMiddlewareProcessConfig
{
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

    /**
     * @return string
     */
    public function getProductImportAdditionalMapPath()
    {
        return $this->get(ProcessConstants::PRODUCT_IMPORT_ADDITIONAL_MAP_FILE_PATH);
    }

    public function getDefaultThreshold()
    {
        return $this->get(ProcessConstants::DEFAULT_THRESHOLD, 1000);
    }
}
