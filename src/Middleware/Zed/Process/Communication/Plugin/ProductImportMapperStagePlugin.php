<?php

namespace Middleware\Zed\Process\Communication\Plugin;

use Generated\Shared\Transfer\MapperConfigTransfer;
use SprykerMiddleware\Zed\Process\Communication\Plugin\AbstractMapperStagePlugin;

/**
 * @method \Middleware\Zed\Process\Business\ProcessFacadeInterface getFacade()
 */
class ProductImportMapperStagePlugin extends AbstractMapperStagePlugin
{
    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getMapperConfig(): MapperConfigTransfer
    {
        return $this->getFacade()
            ->getProductImportMapperConfig();
    }
}
