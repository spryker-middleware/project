<?php

namespace Middleware\Zed\Process\Communication\Plugin;

use SprykerMiddleware\Zed\Process\Communication\Plugin\AbstractMapperStagePlugin;

/**
 * @method \Middleware\Zed\Process\Communication\ProcessCommunicationFactory getFactory()
 */
class MapGeneratorMapperStagePlugin extends AbstractMapperStagePlugin
{
    /**
     * @return array
     */
    public function getMap(): array
    {
        return $this->getFactory()
            ->createMapGeneratorMap()
            ->getMap();
    }
}
