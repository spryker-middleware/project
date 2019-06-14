<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

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

    /**
     * @return mixed
     */
    public function getDefaultThreshold()
    {
        return $this->get(ProcessConstants::DEFAULT_THRESHOLD, 1000);
    }
}
