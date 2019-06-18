<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Shared\Process;

use SprykerMiddleware\Shared\Process\ProcessConstants as SprykerProcessConstants;

interface ProcessConstants extends SprykerProcessConstants
{
    const MAP_SOURCE_FILE_PATH = 'MAP_SOURCE_FILE_PATH';
    const GENERATED_MAP_FILE_PATH = 'GENERATED_MAP_FILE_PATH';
    const PRODUCT_IMPORT_FILE_PATH = 'PRODUCT_IMPORT_FILE_PATH';
    const PRODUCT_IMPORT_OUTPUT_PATH = 'PRODUCT_IMPORT_CONFIG_PATH';
    const PRODUCT_IMPORT_ADDITIONAL_MAP_FILE_PATH = 'PRODUCT_IMPORT_ADDITIONAL_MAP_FILE_PATH';
    const LOG_FILE_PATH_PRODUCT_IMPORT = 'LOG_FILE_PATH_PRODUCT_IMPORT';
}
