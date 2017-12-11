<?php
namespace  Middleware\Zed\Process\Business\Pipeline\StagePlugin;

interface StagePluginInterface
{
    /**
     * Process the payload.
     *
     * @param mixed $payload
     *
     * @return mixed
     */
    public function process($payload);
}
