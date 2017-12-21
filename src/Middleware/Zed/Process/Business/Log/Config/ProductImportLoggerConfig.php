<?php

namespace Middleware\Zed\Process\Business\Log\Config;

use Middleware\Shared\Process\ProcessConstants;
use Monolog\Formatter\LogstashFormatter;
use Monolog\Handler\StreamHandler;
use Spryker\Shared\Config\Config;
use SprykerMiddleware\Zed\Process\Business\Log\Config\MiddlewareLoggerConfig;

class ProductImportLoggerConfig extends MiddlewareLoggerConfig
{
    const NAME = 'ProductImport';

    /**
     * @return \Monolog\Handler\HandlerInterface[]
     */
    public function getHandlers(): array
    {
        $handlers = parent::getHandlers();
        if (!$this->loggerSettings->getIsQuiet()) {
            $handlers[] = $this->createStreamHandler();
        }

        return $handlers;
    }

    /**
     * @return \Monolog\Handler\StreamHandler
     */
    protected function createStreamHandler(): StreamHandler
    {
        $streamHandler = new StreamHandler(
            $this->getLogFilePath(),
            $this->loggerSettings->getVerboseLevel()
        );
        $formatter = new LogstashFormatter(static::NAME);
        $streamHandler->setFormatter($formatter);

        return $streamHandler;
    }

    /**
     * @return string
     */
    protected function getLogFilePath(): string
    {
        return Config::get(ProcessConstants::LOG_FILE_PATH_PRODUCT_IMPORT);
    }
}
