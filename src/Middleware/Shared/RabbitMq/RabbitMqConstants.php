<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Shared\RabbitMq;

interface RabbitMqConstants
{
    public const MIDDLEWARE_QUEUE_NAME = 'RABBIT_MQ_CONSTANTS:MIDDLEWARE_QUEUE_NAME';
    public const MIDDLEWARE_ERROR_QUEUE_NAME = 'RABBIT_MQ_CONSTANTS:MIDDLEWARE_ERROR_QUEUE_NAME';
}
