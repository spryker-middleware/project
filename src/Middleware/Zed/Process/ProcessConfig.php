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
}
