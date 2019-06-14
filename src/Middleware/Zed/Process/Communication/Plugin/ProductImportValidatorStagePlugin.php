<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\Process\Communication\Plugin;

use Generated\Shared\Transfer\ValidatorConfigTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface;
use SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface;

/**
 * @method \Middleware\Zed\Process\Business\ProcessFacadeInterface getFacade()
 * @method \Middleware\Zed\Process\Communication\ProcessCommunicationFactory getFactory()
 */
class ProductImportValidatorStagePlugin extends AbstractPlugin implements StagePluginInterface
{
    /**
     * @param mixed $payload
     * @param \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface $inStream
     * @param \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface $outStream
     * @param mixed $originalPayload
     *
     * @return mixed
     */
    public function process($payload, ReadStreamInterface $inStream, WriteStreamInterface $outStream, $originalPayload)
    {
        return $this->getFacade()
            ->validate($payload, $this->getValidatorConfig());
    }

    /**
     * @return \Generated\Shared\Transfer\ValidatorConfigTransfer
     */
    protected function getValidatorConfig(): ValidatorConfigTransfer
    {
        return $this->getFacade()
            ->getProductImportValidatorConfig();
    }
}
