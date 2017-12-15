<?php

use Middleware\Shared\Process\ProcessConstants;
use Spryker\Shared\Propel\PropelConstants;
use Spryker\Shared\PropelOrm\PropelOrmConstants;

// ---------- Propel

$config[PropelConstants::PROPEL_DEBUG] = true;
$config[PropelOrmConstants::PROPEL_SHOW_EXTENDED_EXCEPTION] = true;
$config[PropelConstants::ZED_DB_USERNAME] = 'development';
$config[PropelConstants::ZED_DB_PASSWORD] = 'mate20mg';
$config[PropelConstants::ZED_DB_DATABASE] = 'DE_development_zed';
$config[PropelConstants::ZED_DB_HOST] = '127.0.0.1';
$config[PropelConstants::ZED_DB_PORT] = 5432;
$config[PropelConstants::ZED_DB_ENGINE] = $config[PropelConstants::ZED_DB_ENGINE_PGSQL];

$config[ProcessConstants::PRODUCT_IMPORT_FILE_PATH] = APPLICATION_ROOT_DIR . '/files/product.json';
$config[ProcessConstants::PRODUCT_IMPORT_OUTPUT_PATH] = APPLICATION_ROOT_DIR . '/files/output/product_import.output';
$config[ProcessConstants::MAP_SOURCE_FILE_PATH] = APPLICATION_ROOT_DIR . '/files/map.json';
$config[ProcessConstants::GENERATED_MAP_FILE_PATH] = APPLICATION_ROOT_DIR . '/files/config/product_import.map';
