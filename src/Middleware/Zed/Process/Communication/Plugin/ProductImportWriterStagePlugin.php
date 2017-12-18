<?php

namespace Middleware\Zed\Process\Communication\Plugin;

use SprykerMiddleware\Zed\Process\Communication\Plugin\AbstractWriterStagePlugin;

/**
 * @method \Middleware\Zed\Process\Communication\ProcessCommunicationFactory getFactory()
 */
class ProductImportWriterStagePlugin extends AbstractWriterStagePlugin
{
    /**
     * @return string
     */
    public function getDestination(): string
    {
        return $this->getFactory()->getConfig()->getProductImportOutputPath();
    }
}
