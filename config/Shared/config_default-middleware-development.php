<?php

use Middleware\Shared\Process\ProcessConstants;

// Input file for map generator process
$config[ProcessConstants::MAP_SOURCE_FILE_PATH] = APPLICATION_ROOT_DIR . '/files/map.json';
// Output file for map generator process (to be used in product import map)
$config[ProcessConstants::GENERATED_MAP_FILE_PATH] = APPLICATION_ROOT_DIR . '/files/config/product_import.map';

// Input file for product import process
$config[ProcessConstants::PRODUCT_IMPORT_FILE_PATH] = APPLICATION_ROOT_DIR . '/files/product.txt';
// Output file for product import process (might be used to check results)
$config[ProcessConstants::PRODUCT_IMPORT_OUTPUT_PATH] = APPLICATION_ROOT_DIR . '/files/output/product_import.output';

$config[ProcessConstants::LOG_FILE_PATH_PRODUCT_IMPORT] = sprintf(
    '%s/data/logs/%s/application.log',
    APPLICATION_ROOT_DIR,
    APPLICATION
);
