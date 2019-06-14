<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\Process\Business;

use Generated\Shared\Transfer\MapperConfigTransfer;
use Generated\Shared\Transfer\TranslatorConfigTransfer;
use Generated\Shared\Transfer\ValidatorConfigTransfer;
use SprykerMiddleware\Zed\Process\Business\ProcessFacadeInterface as SprykerMiddlewareProcessFacadeInterface;

interface ProcessFacadeInterface extends SprykerMiddlewareProcessFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getProductImportMapperConfig(): MapperConfigTransfer;

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getProductImportTranslatorConfig(): TranslatorConfigTransfer;

    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getMapGeneratorMapperConfig(): MapperConfigTransfer;

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getMapGeneratorTranslatorConfig(): TranslatorConfigTransfer;

    /**
     * @return \Generated\Shared\Transfer\ValidatorConfigTransfer
     */
    public function getProductImportValidatorConfig(): ValidatorConfigTransfer;
}
