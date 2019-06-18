<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\RabbitMqProcess\Business\MessageReader;

use Middleware\Zed\RabbitMqProcess\RabbitMqProcessConfig;
use Spryker\Client\Queue\QueueClientInterface;

class MessageReader implements MessageReaderInterface
{
    /**
     * @var \Spryker\Client\Queue\QueueClientInterface
     */
    protected $queueClient;

    /**
     * @var \Middleware\Zed\RabbitMqProcess\RabbitMqProcessConfig
     */
    protected $config;

    /**
     * @param \Spryker\Client\Queue\QueueClientInterface $queueClient
     * @param \Middleware\Zed\RabbitMqProcess\RabbitMqProcessConfig $config
     */
    public function __construct(
        QueueClientInterface $queueClient,
        RabbitMqProcessConfig $config
    ) {
        $this->queueClient = $queueClient;
        $this->config = $config;
    }

    /**
     * @return \Generated\Shared\Transfer\QueueReceiveMessageTransfer[]
     */
    public function readMessages(): array
    {
        return $this->queueClient->receiveMessages(
            $this->config->getQueueName(),
            $this->config->getBulkSize(),
            $this->config->getOptions()
        );
    }
}
