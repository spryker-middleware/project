<?php

namespace Middleware\Zed\Process\Business\Log\Config;

use Middleware\Shared\Process\ProcessConstants;
use Spryker\Shared\Config\Config;
use SprykerMiddleware\Zed\Process\Business\Log\Config\MiddlewareLoggerConfig;

class ProductImportLoggerConfig extends MiddlewareLoggerConfig
{
    const NAME = 'ProductImport';

    /**
     * @return string
     */
    protected function getLogFilePath(): string
    {
        return Config::get(ProcessConstants::LOG_FILE_PATH_PRODUCT_IMPORT);
    }
}
