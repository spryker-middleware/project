<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\RabbitMqProcess\Communication\Plugin\Stream;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface;

/**
 * @method \Middleware\Zed\RabbitMqProcess\Communication\RabbitMqProcessCommunicationFactory getFactory()
 * @method \Middleware\Zed\RabbitMqProcess\RabbitMqProcessConfig getConfig()
 * @method \Middleware\Zed\RabbitMqProcess\Business\RabbitMqProcessFacade getFacade()
 */
class RabbitMqProcessOutputStreamPlugin extends AbstractPlugin implements OutputStreamPluginInterface
{
    /**
     * @api
     *
     * @return string
     */
    public function getName(): string
    {
        return static::class;
    }

    /**
     * @api
     *
     * @param string $path
     *
     * @return \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface
     */
    public function getOutputStream(string $path): WriteStreamInterface
    {
        return $this->getFactory()->createRabbitMqProcessWriteStream();
    }
}
