<?php
namespace Middleware\Zed\Process;

use Middleware\Zed\Process\Communication\Plugin\ProductImportMapperStagePlugin;
use Middleware\Zed\Process\Communication\Plugin\ProductImportTranslatorStagePlugin;
use SprykerMiddleware\Zed\Process\ProcessDependencyProvider as SprykerMiddlewareProcessDependencyProvider;

class ProcessDependencyProvider extends SprykerMiddlewareProcessDependencyProvider
{
    const PRODUCT_IMPORT_PROCESS = 'PRODUCT_IMPORT_PROCESS';

    /**
     * @return array
     */
    public function registerProcessStages()
    {
        $stages = [
            static::PRODUCT_IMPORT_PROCESS => [
                new ProductImportMapperStagePlugin(),
                new ProductImportTranslatorStagePlugin(),
            ],
        ];

        return $stages;
    }
}
