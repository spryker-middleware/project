<?php

namespace Middleware\Zed\Process\Communication\Plugin;

use Generated\Shared\Transfer\MapperConfigTransfer;
use SprykerMiddleware\Zed\Process\Communication\Plugin\AbstractMapperStagePlugin;

/**
 * @method \Middleware\Zed\Process\Business\ProcessFacadeInterface getFacade()
 */
class MapGeneratorMapperStagePlugin extends AbstractMapperStagePlugin
{
    const PLUGIN_NAME = 'MAP_GENERATOR_MAPPER_STAGE_PLUGIN';

    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getMapperConfig(): MapperConfigTransfer
    {
        return $this->getFacade()
            ->getMapGeneratorMapperConfig();
    }
}
