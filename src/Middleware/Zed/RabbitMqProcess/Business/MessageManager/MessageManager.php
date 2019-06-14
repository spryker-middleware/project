<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\RabbitMqProcess\Business\MessageManager;

use Middleware\Zed\RabbitMqProcess\Business\MessageAcker\MessageAckerInterface;
use Middleware\Zed\RabbitMqProcess\Business\MessagePublisher\MessagePublisherInterface;
use Middleware\Zed\RabbitMqProcess\Business\MessageReader\MessageReaderInterface;

class MessageManager implements MessageManagerInterface
{
    /**
     * @var \Middleware\Zed\RabbitMqProcess\Business\MessageAcker\MessageAckerInterface
     */
    protected $messageReader;

    /**
     * @var \Middleware\Zed\RabbitMqProcess\Business\MessageReader\MessageReaderInterface
     */
    protected $messageAcker;

    /**
     * @var \Middleware\Zed\RabbitMqProcess\Business\MessagePublisher\MessagePublisherInterface
     */
    protected $messagePublisher;

    /**
     * @param \Middleware\Zed\RabbitMqProcess\Business\MessageReader\MessageReaderInterface $messageReader
     * @param \Middleware\Zed\RabbitMqProcess\Business\MessageAcker\MessageAckerInterface $messageAcker
     * @param \Middleware\Zed\RabbitMqProcess\Business\MessagePublisher\MessagePublisherInterface $messagePublisher
     */
    public function __construct(
        MessageReaderInterface $messageReader,
        MessageAckerInterface $messageAcker,
        MessagePublisherInterface $messagePublisher
    ) {
        $this->messageReader = $messageReader;
        $this->messageAcker = $messageAcker;
        $this->messagePublisher = $messagePublisher;
    }

    /**
     * @param \Generated\Shared\Transfer\QueueReceiveMessageTransfer[] $messages
     *
     * @return void
     */
    public function ackMessages(array $messages): void
    {
        $this->messageAcker->ackMessages($messages);
    }

    /**
     * @return \Generated\Shared\Transfer\QueueReceiveMessageTransfer[]
     */
    public function readMessages(): array
    {
        return $this->messageReader->readMessages();
    }

    /**
     * @param int $messagesAmount
     *
     * @return void
     */
    public function publishMessages(int $messagesAmount): void
    {
        $this->messagePublisher->publishMessages($messagesAmount);
    }
}
