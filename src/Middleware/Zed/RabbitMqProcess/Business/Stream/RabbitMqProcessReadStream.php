<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\RabbitMqProcess\Business\Stream;

use Middleware\Zed\RabbitMqProcess\Business\MessageManager\MessageManagerInterface;
use Middleware\Zed\RabbitMqProcess\RabbitMqProcessConfig;
use SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface;

class RabbitMqProcessReadStream implements ReadStreamInterface
{
    /**
     * @var \Middleware\Zed\RabbitMqProcess\Business\MessageManager\MessageManagerInterface
     */
    protected $messageManager;

    /**
     * @var \Middleware\Zed\RabbitMqProcess\RabbitMqProcessConfig
     */
    protected $config;

    /**
     * @var \Generated\Shared\Transfer\QueueReceiveMessageTransfer[]
     */
    protected $messages;

    /**
     * @var int
     */
    protected $position;

    /**
     * @param \Middleware\Zed\RabbitMqProcess\Business\MessageManager\MessageManagerInterface $messageManager
     * @param \Middleware\Zed\RabbitMqProcess\RabbitMqProcessConfig $config
     */
    public function __construct(MessageManagerInterface $messageManager, RabbitMqProcessConfig $config)
    {
        $this->messageManager = $messageManager;
        $this->config = $config;
        $this->messages = [];
    }

    /**
     * @return array
     */
    public function read(): array
    {
        $this->position++;

        if ($this->eof()) {
            $this->messages = array_merge($this->messages, $this->readMessages());
        }

        return json_decode($this->messages[$this->position]->getQueueMessage()->getBody());
    }

    /**
     * @return bool
     */
    public function open(): bool
    {
        $this->messages = $this->readMessages();
        $this->position = 0;

        return true;
    }

    /**
     * @return bool
     */
    public function close(): bool
    {
        $this->messageManager->ackMessages($this->messages);

        return true;
    }

    /**
     * @param int $offset
     * @param int $whence
     *
     * @return int
     */
    public function seek(int $offset, int $whence): int
    {
        return -1;
    }

    /**
     * @return bool
     */
    public function eof(): bool
    {
        return $this->position >= count($this->messages);
    }

    protected function readMessages(): array
    {
        $retryAmount = 0;
        do {
            $messages = $this->messageManager->readMessages();
            if ($retryAmount > 0) {
                sleep($this->config->getRetryDelayInterval());
            }
            $retryAmount++;
        } while (empty($messages) && ($retryAmount <= $this->config->getMaxRetryAmount()));

        return $messages;
    }
}
