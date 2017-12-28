<?php

namespace Middleware\Zed\Process\Communication\Plugin\Hook;

use SprykerMiddleware\Zed\Process\Communication\Plugin\AbstractPreProcessorHookPlugin;

class DummyPreProcessorHookPlugin extends AbstractPreProcessorHookPlugin
{
    const PLUGIN_NAME = 'DUMMY_PRE_PROCESSOR_HOOK_PLUGIN';

    /**
     * @return void
     */
    public function process(): void
    {
    }
}
