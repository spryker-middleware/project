<?php

namespace Middleware\Zed\Process\Communication\Plugin;

use SprykerMiddleware\Zed\Process\Communication\Plugin\AbstractTranslatorStagePlugin;

/**
 * @method \Middleware\Zed\Process\Communication\ProcessCommunicationFactory getFactory()
 */
class ProductImportTranslatorStagePlugin extends AbstractTranslatorStagePlugin
{
    /**
     * @return array
     */
    public function getDictionary(): array
    {
        return $this->getFactory()
            ->createProductImportDictionary()
            ->getDictionary();
    }
}
