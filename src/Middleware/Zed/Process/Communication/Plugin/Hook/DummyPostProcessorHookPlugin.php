<?php

namespace Middleware\Zed\Process\Communication\Plugin\Hook;

use SprykerMiddleware\Zed\Process\Communication\Plugin\AbstractPostProcessorHookPlugin;

class DummyPostProcessorHookPlugin extends AbstractPostProcessorHookPlugin
{
    const PLUGIN_NAME = 'DUMMY_POST_PROCESSOR_HOOK_PLUGIN';

    /**
     * @return void
     */
    public function process(): void
    {
    }
}
