<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\RabbitMqProcess\Business;

interface RabbitMqProcessFacadeInterface
{
    /**
     * Specification:
     * - Publishes messages into RabbitMq queue configured in RabbitMqProcessConfig
     *
     * @api
     *
     * @param int $messagesAmount
     *
     * @return void
     */
    public function publishMessages(int $messagesAmount): void;
}
