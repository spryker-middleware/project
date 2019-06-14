<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Client\RabbitMq;


use ArrayObject;
use Generated\Shared\Transfer\RabbitMqOptionTransfer;
use Spryker\Client\RabbitMq\Model\Connection\Connection;
use Spryker\Client\RabbitMq\RabbitMqConfig as SprykerRabbitMqConfig;

class RabbitMqConfig extends SprykerRabbitMqConfig
{
    protected const MIDDLEWARE_QUEUE = 'middleware';
    protected const MIDDLEWARE_ERROR_QUEUE = 'middleware.error';
    /**
     * @return \ArrayObject
     */
    protected function getQueueOptions(): ArrayObject
    {
        $queueOptionCollection = new ArrayObject();

        $queueOptionCollection->append(
            $this->createQueueOption(
                static::MIDDLEWARE_QUEUE,
                static::MIDDLEWARE_ERROR_QUEUE
            )
        );

        return $queueOptionCollection;
    }

    /**
     * @param string $queueName
     * @param string $errorQueueName
     * @param string $routingKey
     *
     * @return \Generated\Shared\Transfer\RabbitMqOptionTransfer
     */
    protected function createQueueOption($queueName, $errorQueueName, $routingKey = 'error'): RabbitMqOptionTransfer
    {
        $queueOptionTransfer = new RabbitMqOptionTransfer();
        $queueOptionTransfer
            ->setQueueName($queueName)
            ->setDurable(true)
            ->setType('direct')
            ->setDeclarationType(Connection::RABBIT_MQ_EXCHANGE)
            ->addBindingQueueItem($this->createQueueBinding($queueName))
            ->addBindingQueueItem($this->createErrorQueueBinding($errorQueueName, $routingKey));

        return $queueOptionTransfer;
    }

    /**
     * @param string $queueName
     *
     * @return \Generated\Shared\Transfer\RabbitMqOptionTransfer
     */
    protected function createQueueBinding($queueName): RabbitMqOptionTransfer
    {
        $queueOptionTransfer = new RabbitMqOptionTransfer();
        $queueOptionTransfer
            ->setQueueName($queueName)
            ->setDurable(true)
            ->addRoutingKey('');

        return $queueOptionTransfer;
    }

    /**
     * @param string $errorQueueName
     * @param string $routingKey
     *
     * @return \Generated\Shared\Transfer\RabbitMqOptionTransfer
     */
    protected function createErrorQueueBinding($errorQueueName, $routingKey): RabbitMqOptionTransfer
    {
        $queueOptionTransfer = new RabbitMqOptionTransfer();
        $queueOptionTransfer
            ->setQueueName($errorQueueName)
            ->setDurable(true)
            ->addRoutingKey($routingKey);

        return $queueOptionTransfer;
    }
}
