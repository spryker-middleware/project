<?php

namespace Middleware\Zed\Process;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class ProcessConfig extends AbstractBundleConfig
{

    public function getProductImportPath()
    {
        return '/data/shop/development/packages/csv/1.csv';
    }
}