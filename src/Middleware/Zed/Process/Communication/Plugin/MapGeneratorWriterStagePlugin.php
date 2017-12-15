<?php

namespace Middleware\Zed\Process\Communication\Plugin;

use SprykerMiddleware\Zed\Process\Communication\Plugin\AbstractWriterStagePlugin;

/**
 * @method \Middleware\Zed\Process\Communication\ProcessCommunicationFactory getFactory()
 */
class MapGeneratorWriterStagePlugin extends AbstractWriterStagePlugin
{
    /**
     * @return string
     */
    public function getDestination(): string
    {
        return $this->getFactory()->getConfig()->getMapGeneratorOutputPath();
    }

    /**
     * @param mixed $payload
     *
     * @return array
     */
    public function process($payload)
    {
        return $this->getFacade()
            ->writeSerialized($payload, $this->getDestination());
    }
}
