<?php

namespace Middleware\Zed\Process;

use Middleware\Shared\Process\ProcessConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ProcessConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getProductImportPath()
    {
        return $this->get(ProcessConstants::PRODUCT_IMPORT_FILE_PATH);
    }
}
