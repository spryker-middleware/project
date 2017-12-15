<?php

namespace Middleware\Zed\Process\Communication\Plugin;

use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;
use SprykerMiddleware\Zed\Process\Communication\Plugin\AbstractMapperStagePlugin;

/**
 * @method \Middleware\Zed\Process\Communication\ProcessCommunicationFactory getFactory()
 */
class ProductImportMapperStagePlugin extends AbstractMapperStagePlugin
{
    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface
     */
    public function getMap(): MapInterface
    {
        return $this->getFactory()
            ->createProductImportMap();
    }
}
