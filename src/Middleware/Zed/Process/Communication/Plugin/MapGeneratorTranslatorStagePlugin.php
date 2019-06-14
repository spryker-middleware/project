<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\Process\Communication\Plugin;

use Generated\Shared\Transfer\TranslatorConfigTransfer;
use SprykerMiddleware\Zed\Process\Communication\Plugin\AbstractTranslatorStagePlugin;

/**
 * @method \Middleware\Zed\Process\Business\ProcessFacadeInterface getFacade()
 */
class MapGeneratorTranslatorStagePlugin extends AbstractTranslatorStagePlugin
{
    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getTranslatorConfig(): TranslatorConfigTransfer
    {
        return $this->getFacade()
            ->getMapGeneratorTranslatorConfig();
    }
}
