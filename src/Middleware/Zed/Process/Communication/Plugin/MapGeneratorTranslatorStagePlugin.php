<?php

namespace Middleware\Zed\Process\Communication\Plugin;

use Generated\Shared\Transfer\TranslatorConfigTransfer;
use SprykerMiddleware\Zed\Process\Communication\Plugin\AbstractTranslatorStagePlugin;

/**
 * @method \Middleware\Zed\Process\Business\ProcessFacadeInterface getFacade()
 */
class MapGeneratorTranslatorStagePlugin extends AbstractTranslatorStagePlugin
{
    const PLUGIN_NAME = 'MAP_GENERATOR_TRANSLATOR_STAGE_PLUGIN';

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getTranslatorConfig(): TranslatorConfigTransfer
    {
        return $this->getFacade()
            ->getMapGeneratorTranslatorConfig();
    }
}
