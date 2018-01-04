<?php

namespace Middleware\Zed\Process\Business;

use Middleware\Zed\Process\Business\Mapper\Map\MapGeneratorMap;
use Middleware\Zed\Process\Business\Mapper\Map\ProductImportMap;
use Middleware\Zed\Process\Business\Translator\Dictionary\MapGeneratorDictionary;
use Middleware\Zed\Process\Business\Translator\Dictionary\ProductImportDictionary;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;
use SprykerMiddleware\Zed\Process\Business\ProcessBusinessFactory as SprykerMiddlewareProcessBusinessFactory;
use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface;

/**
 * @method \Middleware\Zed\Process\ProcessConfig getConfig()
 */
class ProcessBusinessFactory extends SprykerMiddlewareProcessBusinessFactory
{
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
}
