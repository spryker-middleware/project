<?php

namespace Middleware\Zed\Process\Communication\Plugin\Hook;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface;

/**
 * @method \Middleware\Zed\Process\Business\ProcessFacadeInterface getFacade()
 * @method \Middleware\Zed\Process\Communication\ProcessCommunicationFactory getFactory()
 */
class DummyPreProcessorHookPlugin extends AbstractPlugin implements PostProcessorHookPluginInterface
{
    const PLUGIN_NAME = 'DUMMY_PRE_PROCESSOR_HOOK_PLUGIN';

    /**
     * @return void
     */
    public function process(): void
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::PLUGIN_NAME;
    }
}
