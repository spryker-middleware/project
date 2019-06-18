<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\RabbitMqProcess\Business\MessagePublisher;

use Generated\Shared\Transfer\QueueSendMessageTransfer;
use Middleware\Zed\RabbitMqProcess\RabbitMqProcessConfig;
use Spryker\Client\Queue\QueueClientInterface;

class MessagePublisher implements MessagePublisherInterface
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
     * @param int $messagesAmount
     *
     * @return void
     */
    public function publishMessages(int $messagesAmount): void
    {
        $this->queueClient->sendMessages(
            $this->config->getQueueName(),
            $this->createMessages($messagesAmount)
        );
    }

    /**
     * @param int $messagesAmount
     *
     * @return array
     */
    protected function createMessages(int $messagesAmount): array
    {
        $messages = [];

        for ($i = 0; $i < $messagesAmount; $i++) {
            $messages[] = $this->createMessage();
        }

        return $messages;
    }

    /**
     * @return \Generated\Shared\Transfer\QueueSendMessageTransfer
     */
    protected function createMessage(): QueueSendMessageTransfer
    {
        return (new QueueSendMessageTransfer())
            ->setBody($this->createRandomMessageBody());
    }

    /**
     * @return string
     */
    protected function createRandomMessageBody(): string
    {
        return json_encode([md5(mt_rand())]);
    }
}
