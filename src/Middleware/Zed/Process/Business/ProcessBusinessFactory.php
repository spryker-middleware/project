<?php

namespace Middleware\Zed\Process\Business;

use Generated\Shared\Transfer\AggregatorSettingsTransfer;
use Generated\Shared\Transfer\IteratorSettingsTransfer;
use Generated\Shared\Transfer\LoggerSettingsTransfer;
use Generated\Shared\Transfer\WriterConfigTransfer;
use Iterator;
use Middleware\Zed\Process\Business\Log\Config\ProductImportLoggerConfig;
use Middleware\Zed\Process\Business\Mapper\Map\MapGeneratorMap;
use Middleware\Zed\Process\Business\Mapper\Map\ProductImportMap;
use Middleware\Zed\Process\Business\Translator\Dictionary\MapGeneratorDictionary;
use Middleware\Zed\Process\Business\Translator\Dictionary\ProductImportDictionary;
use Middleware\Zed\Process\ProcessDependencyProvider;
use Spryker\Shared\Log\Config\LoggerConfigInterface;
use SprykerMiddleware\Zed\Process\Business\Aggregator\AggregatorInterface;
use SprykerMiddleware\Zed\Process\Business\Aggregator\BatchAggregator;
use SprykerMiddleware\Zed\Process\Business\Iterator\JsonIterator;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;
use SprykerMiddleware\Zed\Process\Business\ProcessBusinessFactory as SprykerMiddlewareProcessBusinessFactory;
use SprykerMiddleware\Zed\Process\Business\Renderer\JsonRenderer;
use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface;
use SprykerMiddleware\Zed\Process\Business\Writer\FileWriter;

/**
 * @method \Middleware\Zed\Process\ProcessConfig getConfig()
 */
class ProcessBusinessFactory extends SprykerMiddlewareProcessBusinessFactory
{
    /**
     * @return array
     */
    protected function getProcessIteratorsList(): array
    {
        return [
            ProcessDependencyProvider::MAP_GENERATOR_PROCESS => function (IteratorSettingsTransfer $iteratorSettingsTransfer) {
                return $this->createMapGeneratorIterator($iteratorSettingsTransfer);
            },
            ProcessDependencyProvider::PRODUCT_IMPORT_PROCESS => function (IteratorSettingsTransfer $iteratorSettingsTransfer) {
                return $this->createProductImportIterator($iteratorSettingsTransfer);
            },
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

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface
     */
    public function createMapGeneratorMap(): MapInterface
    {
        return new MapGeneratorMap();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface
     */
    public function createMapGeneratorDictionary(): DictionaryInterface
    {
        return new MapGeneratorDictionary();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface
     */
    public function createProductImportMap(): MapInterface
    {
        return new ProductImportMap($this->getConfig()->getMapGeneratorOutputPath());
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface
     */
    public function createProductImportDictionary(): DictionaryInterface
    {
        return new ProductImportDictionary();
    }

    /**
     * @param \Generated\Shared\Transfer\IteratorSettingsTransfer $iteratorSettingsTransfer
     *
     * @return \Iterator
     */
    public function createProductImportIterator(IteratorSettingsTransfer $iteratorSettingsTransfer): Iterator
    {
        $iteratorSettingsTransfer->setParseAsArray(true);
        return new JsonIterator($this->getConfig()->getProductImportPath(), $iteratorSettingsTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\IteratorSettingsTransfer $iteratorSettingsTransfer
     *
     * @return \Iterator
     */
    public function createMapGeneratorIterator(IteratorSettingsTransfer $iteratorSettingsTransfer): Iterator
    {
        $iteratorSettingsTransfer->setParseAsArray(true);
        return new JsonIterator($this->getConfig()->getMapSourcePath(), $iteratorSettingsTransfer);
    }

    /**
     * @return array
     */
    protected function getProcessAggregatorsList(): array
    {
        return [
            ProcessDependencyProvider::MAP_GENERATOR_PROCESS => function (AggregatorSettingsTransfer $aggregatorSettingsTransfer) {
                return $this->createMapGeneratorAggregator($aggregatorSettingsTransfer);
            },
            ProcessDependencyProvider::PRODUCT_IMPORT_PROCESS => function (AggregatorSettingsTransfer $aggregatorSettingsTransfer) {
                return $this->createProductImportAggregator($aggregatorSettingsTransfer);
            },
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\AggregatorSettingsTransfer $aggregatorSettingsTransfer
     *
     * @return \SprykerMiddleware\Zed\Process\Business\Aggregator\AggregatorInterface
     */
    protected function createMapGeneratorAggregator(AggregatorSettingsTransfer $aggregatorSettingsTransfer): AggregatorInterface
    {
        $aggregatorSettingsTransfer->getWriterConfig()->setDestination($this->getConfig()->getMapGeneratorOutputPath());
        $aggregatorSettingsTransfer->setThreshold(1000);
        return new BatchAggregator(
            $this->createFileWriter($aggregatorSettingsTransfer->getWriterConfig()),
            $this->createJsonRenderer(),
            $aggregatorSettingsTransfer
        );
    }

    /**
     * @param \Generated\Shared\Transfer\AggregatorSettingsTransfer $aggregatorSettingsTransfer
     *
     * @return \SprykerMiddleware\Zed\Process\Business\Aggregator\AggregatorInterface
     */
    protected function createProductImportAggregator(AggregatorSettingsTransfer $aggregatorSettingsTransfer): AggregatorInterface
    {
        $aggregatorSettingsTransfer->getWriterConfig()->setDestination($this->getConfig()->getProductImportOutputPath());
        $aggregatorSettingsTransfer->setThreshold(1000);
        return new BatchAggregator(
            $this->createFileWriter($aggregatorSettingsTransfer->getWriterConfig()),
            $this->createJsonRenderer(),
            $aggregatorSettingsTransfer
        );
    }

    /**
     * @param \Generated\Shared\Transfer\WriterConfigTransfer $writerConfigTransfer
     *
     * @return \SprykerMiddleware\Zed\Process\Business\Writer\FileWriter
     */
    protected function createFileWriter(WriterConfigTransfer $writerConfigTransfer)
    {
        return new FileWriter($writerConfigTransfer);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Renderer\JsonRenderer
     */
    protected function createJsonRenderer()
    {
        return new JsonRenderer($this->getProvidedDependency(ProcessDependencyProvider::SERVICE_UTIL_ENCODING));
    }
}
