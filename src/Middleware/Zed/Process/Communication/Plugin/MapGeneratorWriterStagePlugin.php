<?php

namespace Middleware\Zed\Process\Communication\Plugin;

use Psr\Log\LoggerInterface;
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
     * @inheritdoc
     */
    public function process($payload, LoggerInterface $logger)
    {
        return $this->getFacade()
            ->write($payload, 'SerializedDump', $this->getDestination());
    }
}
