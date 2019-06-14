<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\RabbitMqProcess;

use Spryker\Client\Queue\QueueClientInterface;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use SprykerMiddleware\Zed\Process\Communication\Plugin\StreamReaderStagePlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\StreamWriterStagePlugin;

class RabbitMqProcessDependencyProvider extends AbstractBundleDependencyProvider
{
    public const STAGE_PLUGINS = 'STAGE_PLUGINS';
    public const QUEUE_CLIENT = 'QUEUE_CLIENT';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = $this->addStagePlugins($container);
        $container = $this->addQueueClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addQueueClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStagePlugins(Container $container): Container
    {
        $container[static::STAGE_PLUGINS] = function (): array {
            return $this->getStagePlugins();
        };
        return $container;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    protected function getStagePlugins(): array
    {
        return [
            new StreamReaderStagePlugin(),
            new StreamWriterStagePlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addQueueClient(Container $container): Container
    {
        $container->set(static::QUEUE_CLIENT, function (Container $container): QueueClientInterface {
            return $container->getLocator()->queue()->client();
        });

        return $container;
    }
}
