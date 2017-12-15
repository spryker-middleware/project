<?php

namespace Middleware\Shared\Process;

use SprykerMiddleware\Shared\Process\ProcessConstants as SprykerProcessConstants;

interface ProcessConstants extends SprykerProcessConstants
{
    const MAP_SOURCE_FILE_PATH = 'MAP_SOURCE_FILE_PATH';
    const GENERATED_MAP_FILE_PATH = 'GENERATED_MAP_FILE_PATH';
    const PRODUCT_IMPORT_FILE_PATH = 'PRODUCT_IMPORT_FILE_PATH';
    const PRODUCT_IMPORT_OUTPUT_PATH = 'PRODUCT_IMPORT_CONFIG_PATH';
}
