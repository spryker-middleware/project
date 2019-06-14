<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\RabbitMqProcess\Communication;

use Middleware\Zed\RabbitMqProcess\Business\MessageAcker\MessageAcker;
use Middleware\Zed\RabbitMqProcess\Business\MessageAcker\MessageAckerInterface;
use Middleware\Zed\RabbitMqProcess\Business\MessageManager\MessageManager;
use Middleware\Zed\RabbitMqProcess\Business\MessageManager\MessageManagerInterface;
use Middleware\Zed\RabbitMqProcess\Business\MessagePublisher\MessagePublisher;
use Middleware\Zed\RabbitMqProcess\Business\MessagePublisher\MessagePublisherInterface;
use Middleware\Zed\RabbitMqProcess\Business\MessageReader\MessageReader;
use Middleware\Zed\RabbitMqProcess\Business\MessageReader\MessageReaderInterface;
use Middleware\Zed\RabbitMqProcess\Business\Stream\RabbitMqProcessReadStream;
use Middleware\Zed\RabbitMqProcess\Communication\Plugin\Stream\RabbitMqProcessInputStreamPlugin;
use Middleware\Zed\RabbitMqProcess\Communication\Plugin\Stream\RabbitMqProcessOutputStreamPlugin;
use Middleware\Zed\RabbitMqProcess\RabbitMqProcessDependencyProvider;
use Spryker\Client\Queue\QueueClientInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface;
use SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface;
use SprykerMiddleware\Zed\Process\Business\Stream\JsonWriteStream;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Iterator\NullIteratorPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Log\MiddlewareLoggerConfigPlugin;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Log\MiddlewareLoggerConfigPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface;

/**
 * @method \Middleware\Zed\RabbitMqProcess\RabbitMqProcessConfig getConfig()
 */
class RabbitMqProcessCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface
     */
    public function createRabbitMqProcessReadStream(): ReadStreamInterface
    {
        return new RabbitMqProcessReadStream(
            $this->createMessageManager(),
            $this->getConfig()
        );
    }

    /**
     * @return \Middleware\Zed\RabbitMqProcess\Business\MessageManager\MessageManagerInterface
     */
    public function createMessageManager(): MessageManagerInterface
    {
        return new MessageManager(
            $this->createMessageReader(),
            $this->createMessageAcker(),
            $this->createMessagePublisher()
        );
    }

    /**
     * @return \Middleware\Zed\RabbitMqProcess\Business\MessageReader\MessageReaderInterface
     */
    public function createMessageReader(): MessageReaderInterface
    {
        return new MessageReader($this->getQueueClient(), $this->getConfig());
    }

    /**
     * @return \Middleware\Zed\RabbitMqProcess\Business\MessageAcker\MessageAckerInterface
     */
    public function createMessageAcker(): MessageAckerInterface
    {
        return new MessageAcker($this->getQueueClient());
    }

    /**
     * @return \Middleware\Zed\RabbitMqProcess\Business\MessagePublisher\MessagePublisherInterface
     */
    public function createMessagePublisher(): MessagePublisherInterface
    {
        return new MessagePublisher($this->getQueueClient(), $this->getConfig());
    }

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface
     */
    public function createRabbitMqProcessWriteStream(): WriteStreamInterface
    {
        return new JsonWriteStream($this->getConfig()->getPath());
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface
     */
    public function createRabbitMqProcessInputStreamPlugin(): InputStreamPluginInterface
    {
        return new RabbitMqProcessInputStreamPlugin();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface
     */
    public function createRabbitMqProcessOutputStreamPlugin(): OutputStreamPluginInterface
    {
        return new RabbitMqProcessOutputStreamPlugin();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface
     */
    public function createNullIteratorPlugin(): ProcessIteratorPluginInterface
    {
        return new NullIteratorPlugin();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Log\MiddlewareLoggerConfigPluginInterface
     */
    public function createMiddlewareLoggerConfigPlugin(): MiddlewareLoggerConfigPluginInterface
    {
        return new MiddlewareLoggerConfigPlugin();
    }

    /**
     * @return \Spryker\Client\Queue\QueueClientInterface
     */
    public function getQueueClient(): QueueClientInterface
    {
        return $this->getProvidedDependency(RabbitMqProcessDependencyProvider::QUEUE_CLIENT);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    public function getStagePlugins(): array
    {
        return $this->getProvidedDependency(RabbitMqProcessDependencyProvider::STAGE_PLUGINS);
    }
}
