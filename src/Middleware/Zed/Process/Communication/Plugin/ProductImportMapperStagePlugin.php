<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\Process\Communication\Plugin;

use Generated\Shared\Transfer\MapperConfigTransfer;
use SprykerMiddleware\Zed\Process\Communication\Plugin\AbstractMapperStagePlugin;

/**
 * @method \Middleware\Zed\Process\Business\ProcessFacadeInterface getFacade()
 */
class ProductImportMapperStagePlugin extends AbstractMapperStagePlugin
{
    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getMapperConfig(): MapperConfigTransfer
    {
        return $this->getFacade()
            ->getProductImportMapperConfig();
    }
}
