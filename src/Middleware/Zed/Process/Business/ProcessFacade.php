<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\Process\Business;

use Generated\Shared\Transfer\MapperConfigTransfer;
use Generated\Shared\Transfer\TranslatorConfigTransfer;
use Generated\Shared\Transfer\ValidatorConfigTransfer;
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
     * @return \Generated\Shared\Transfer\ValidatorConfigTransfer
     */
    public function getProductImportValidatorConfig(): ValidatorConfigTransfer
    {
        return $this->getFactory()
            ->createProductImportValidationRuleSet()
            ->getValidatorConfig();
    }
}
