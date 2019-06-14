<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\RabbitMqProcess\Business\MessageReader;

interface MessageReaderInterface
{
    /**
     * @return \Generated\Shared\Transfer\QueueReceiveMessageTransfer[]
     */
    public function readMessages(): array;
}
