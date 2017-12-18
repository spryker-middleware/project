<?php
namespace Middleware\Zed\Process\Communication;

use Generated\Shared\Transfer\IteratorSettingsTransfer;
use Generated\Shared\Transfer\LoggerSettingsTransfer;
use Iterator;
use Middleware\Zed\Process\Business\Log\Config\ProductImportLoggerConfig;
use Middleware\Zed\Process\Business\Mapper\Map\ProductImportMap;
use Middleware\Zed\Process\Business\Translator\Dictionary\ProductImportDictionary;
use Middleware\Zed\Process\ProcessDependencyProvider;
use Spryker\Shared\Log\Config\LoggerConfigInterface;
use SprykerMiddleware\Zed\Process\Business\Iterator\JsonIterator;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;
use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface;
use SprykerMiddleware\Zed\Process\Communication\ProcessCommunicationFactory as SprykerMiddlewareProcessCommunicationFactory;

/**
 * @method \Middleware\Zed\Process\ProcessConfig getConfig()
 */
class ProcessCommunicationFactory extends SprykerMiddlewareProcessCommunicationFactory
{
    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface
     */
    public function createProductImportMap(): MapInterface
    {
        return new ProductImportMap();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface
     */
    public function createProductImportDictionary(): DictionaryInterface
    {
        return new ProductImportDictionary();
    }

    /**
     * @return array
     */
    protected function getProcessIteratorsList(): array
    {
        return [
            ProcessDependencyProvider::PRODUCT_IMPORT_PROCESS => function (IteratorSettingsTransfer $iteratorSettingsTransfer) {
                return $this->createProductImportIterator($iteratorSettingsTransfer);
            },
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\IteratorSettingsTransfer $iteratorSettingsTransfer
     *
     * @return \Iterator
     */
    protected function createProductImportIterator(IteratorSettingsTransfer $iteratorSettingsTransfer): Iterator
    {
        $iteratorSettingsTransfer->setParseAsArray(true);
        return new JsonIterator($this->getConfig()->getProductImportPath(), $iteratorSettingsTransfer);
    }

    /**
     * @return array
     */
    protected function getRegisteredPreProcessorsList(): array
    {
        return [
            ProcessDependencyProvider::PRODUCT_IMPORT_PROCESS => [],
        ];
    }

    /**
     * @return array
     */
    protected function getRegisteredPostProcessorsList(): array
    {
        return [
            ProcessDependencyProvider::PRODUCT_IMPORT_PROCESS => [],
        ];
    }

    /**
     * @return array
     */
    protected function getProcessLoggerConfigList(): array
    {
        return [
            ProcessDependencyProvider::PRODUCT_IMPORT_PROCESS => function (LoggerSettingsTransfer $loggerSettingsTransfer) {
                return $this->createProductImportLoggerConfig($loggerSettingsTransfer);
            },
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\LoggerSettingsTransfer $loggerSettingsTransfer
     *
     * @return \Spryker\Shared\Log\Config\LoggerConfigInterface
     */
    protected function createProductImportLoggerConfig(LoggerSettingsTransfer $loggerSettingsTransfer): LoggerConfigInterface
    {
        return new ProductImportLoggerConfig($loggerSettingsTransfer);
    }
}
