<?php

namespace Middleware\Zed\Process\Business;

use Generated\Shared\Transfer\IteratorSettingsTransfer;
use Generated\Shared\Transfer\MapperConfigTransfer;
use Generated\Shared\Transfer\TranslatorConfigTransfer;
use Iterator;
use SprykerMiddleware\Zed\Process\Business\ProcessFacade as SprykerMiddlewareProcessFacade;

/**
 * @method \Middleware\Zed\Process\Business\ProcessBusinessFactory getFactory()
 */
class ProcessFacade extends SprykerMiddlewareProcessFacade implements ProcessFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getProductImportMapperConfig(): MapperConfigTransfer
    {
        return $this->getFactory()
            ->createProductImportMap()
            ->getMapperConfig();
    }

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getProductImportTranslatorConfig(): TranslatorConfigTransfer
    {
        return $this->getFactory()
            ->createProductImportDictionary()
            ->getTranslatorConfig();
    }

    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getMapGeneratorMapperConfig(): MapperConfigTransfer
    {
        return $this->getFactory()
            ->createMapGeneratorMap()
            ->getMapperConfig();
    }

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getMapGeneratorTranslatorConfig(): TranslatorConfigTransfer
    {
        return $this->getFactory()
            ->createMapGeneratorDictionary()
            ->getTranslatorConfig();
    }

    /**
     * @param \Generated\Shared\Transfer\IteratorSettingsTransfer $iteratorSettingsTransfer
     *
     * @return \Iterator
     */
    public function getProductImportIterator(IteratorSettingsTransfer $iteratorSettingsTransfer): Iterator
    {
        return $this->getFactory()
            ->createProductImportIterator($iteratorSettingsTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\IteratorSettingsTransfer $iteratorSettingsTransfer
     *
     * @return \Iterator
     */
    public function getMapGeneratorIterator(IteratorSettingsTransfer $iteratorSettingsTransfer): Iterator
    {
        return $this->getFactory()
            ->createMapGeneratorIterator($iteratorSettingsTransfer);
    }
}
