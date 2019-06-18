<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\RabbitMqProcess;

use Generated\Shared\Transfer\RabbitMqConsumerOptionTransfer;
use Middleware\Shared\RabbitMqProcess\RabbitMqProcessConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class RabbitMqProcessConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getOptions(): array
    {
        $rabbitMqReceiveOptionTransfer = new RabbitMqConsumerOptionTransfer();

        $rabbitMqReceiveOptionTransfer->setConsumerExclusive(false);
        $rabbitMqReceiveOptionTransfer->setNoWait(false);
        $rabbitMqReceiveOptionTransfer->setNoAck(false);

        return [
            'rabbitmq' => $rabbitMqReceiveOptionTransfer,
        ];
    }

    /**
     * @return string
     */
    public function getQueueName(): string
    {
        return $this->get(RabbitMqProcessConstants::MIDDLEWARE_QUEUE_NAME);
    }

    /**
     * @return int
     */
    public function getBulkSize(): int
    {
        return 5;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return sprintf('%s/files/output/middleware.process_%d.json', APPLICATION_ROOT_DIR, time());
    }

    /**
     * @return int
     */
    public function getMaxRetryAmount(): int
    {
        return 10;
    }

    /**
     * @return int - seconds
     */
    public function getRetryDelayInterval(): int
    {
        return 1;
    }
}
