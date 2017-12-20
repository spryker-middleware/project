<?php

namespace Middleware\Zed\Process\Business;

use Generated\Shared\Transfer\IteratorSettingsTransfer;
use Generated\Shared\Transfer\MapperConfigTransfer;
use Generated\Shared\Transfer\TranslatorConfigTransfer;
use Iterator;
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
     * @param \Generated\Shared\Transfer\IteratorSettingsTransfer $iteratorSettingsTransfer
     *
     * @return \Iterator
     */
    public function getProductImportIterator(IteratorSettingsTransfer $iteratorSettingsTransfer): Iterator;

    /**
     * @param \Generated\Shared\Transfer\IteratorSettingsTransfer $iteratorSettingsTransfer
     *
     * @return \Iterator
     */
    public function getMapGeneratorIterator(IteratorSettingsTransfer $iteratorSettingsTransfer): Iterator;
}
