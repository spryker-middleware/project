<?php

namespace Middleware\Zed\Process\Business;

use Generated\Shared\Transfer\MapperConfigTransfer;
use Generated\Shared\Transfer\TranslatorConfigTransfer;
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
}
