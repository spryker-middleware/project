<?php
namespace Middleware\Middleware\Pipeline\Business\StagePlugin;

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
