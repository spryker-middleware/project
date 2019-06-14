<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Client\Queue;


use Spryker\Client\Kernel\Container;
use Spryker\Client\Queue\QueueDependencyProvider as SprykerQueueDependencyProvider;

class QueueDependencyProvider extends SprykerQueueDependencyProvider
{
    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Queue\Model\Adapter\AdapterInterface[]
     */
    protected function createQueueAdapters(Container $container): array
    {
        return [
            $container->getLocator()->rabbitMq()->client()->createQueueAdapter(),
        ];
    }
}
