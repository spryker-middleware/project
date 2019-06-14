<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\RabbitMqProcess\Communication\Plugin\Stream;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface;

/**
 * @method \Middleware\Zed\RabbitMqProcess\Communication\RabbitMqProcessCommunicationFactory getFactory()
 * @method \Middleware\Zed\RabbitMqProcess\RabbitMqProcessConfig getConfig()
 * @method \Middleware\Zed\RabbitMqProcess\Business\RabbitMqProcessFacade getFacade()
 */
class RabbitMqProcessInputStreamPlugin extends AbstractPlugin implements InputStreamPluginInterface
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
     * @return \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface
     */
    public function getInputStream(string $path): ReadStreamInterface
    {
        return $this->getFactory()->createRabbitMqProcessReadStream();
    }
}
