<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\RabbitMqProcess\Business\MessageManager;

interface MessageManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\QueueReceiveMessageTransfer[] $messages
     *
     * @return void
     */
    public function ackMessages(array $messages): void;

    /**
     * @return \Generated\Shared\Transfer\QueueReceiveMessageTransfer[]
     */
    public function readMessages(): array;

    /**
     * @param int $messagesAmount
     *
     * @return void
     */
    public function publishMessages(int $messagesAmount): void;
}
