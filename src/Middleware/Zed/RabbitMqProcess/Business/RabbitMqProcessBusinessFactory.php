<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\RabbitMqProcess\Business;

use Middleware\Zed\RabbitMqProcess\Business\MessagePublisher\MessagePublisher;
use Middleware\Zed\RabbitMqProcess\Business\MessagePublisher\MessagePublisherInterface;
use Middleware\Zed\RabbitMqProcess\RabbitMqProcessDependencyProvider;
use Spryker\Client\Queue\QueueClientInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Middleware\Zed\RabbitMqProcess\RabbitMqProcessConfig getConfig()
 */
class RabbitMqProcessBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Middleware\Zed\RabbitMqProcess\Business\MessagePublisher\MessagePublisherInterface
     */
    public function createMessagePublisher(): MessagePublisherInterface
    {
        return new MessagePublisher($this->getQueueClient(), $this->getConfig());
    }

    /**
     * @return \Spryker\Client\Queue\QueueClientInterface
     */
    public function getQueueClient(): QueueClientInterface
    {
        return $this->getProvidedDependency(RabbitMqProcessDependencyProvider::QUEUE_CLIENT);
    }
}
