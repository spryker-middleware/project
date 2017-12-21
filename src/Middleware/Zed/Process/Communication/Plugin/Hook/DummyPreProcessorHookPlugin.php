<?php

namespace Middleware\Zed\Process\Communication\Plugin\Hook;

use SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PreProcessorHookPluginInterface;

class DummyPreProcessorHookPlugin implements PreProcessorHookPluginInterface
{
    /**
     * @return void
     */
    public function process(): void
    {
    }
}
