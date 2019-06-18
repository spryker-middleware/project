<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\RabbitMqProcess\Business\MessageAcker;

use Spryker\Client\Queue\QueueClientInterface;

class MessageAcker implements MessageAckerInterface
{
    /**
     * @var \Spryker\Client\Queue\QueueClientInterface
     */
    protected $queueClient;

    /**
     * @param \Spryker\Client\Queue\QueueClientInterface $queueClient
     */
    public function __construct(QueueClientInterface $queueClient)
    {
        $this->queueClient = $queueClient;
    }

    /**
     * @param \Generated\Shared\Transfer\QueueReceiveMessageTransfer[] $messages
     *
     * @return void
     */
    public function ackMessages(array $messages): void
    {
        foreach ($messages as $message) {
            $this->queueClient->acknowledge($message);
        }
    }
}
