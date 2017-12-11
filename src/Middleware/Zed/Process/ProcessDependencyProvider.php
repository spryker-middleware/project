<?php
namespace Middleware\Zed\Process;

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
                //plugin1
                //plugin2
                //....
            ],
        ];

        return $stages;
    }
}
