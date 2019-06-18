<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\AkeneoPimMiddlewareConnector;

use Middleware\Zed\AkeneoPimMiddlewareConnector\Communication\DataImporter\AttributeImporterPlugin;
use Middleware\Zed\AkeneoPimMiddlewareConnector\Communication\DataImporter\CategoryImporterPlugin;
use Middleware\Zed\AkeneoPimMiddlewareConnector\Communication\DataImporter\ProductAbstractImporterPlugin;
use Middleware\Zed\AkeneoPimMiddlewareConnector\Communication\DataImporter\ProductAbstractStoresImporterPlugin;
use Middleware\Zed\AkeneoPimMiddlewareConnector\Communication\DataImporter\ProductConcreteImporterPlugin;
use Middleware\Zed\AkeneoPimMiddlewareConnector\Communication\DataImporter\ProductPriceImporterPlugin;
use Spryker\Zed\Kernel\Container;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorDependencyProvider as SprykerEcoAkeneoPimMiddlewareConnectorDependencyProvider;

class AkeneoPimMiddlewareConnectorDependencyProvider extends SprykerEcoAkeneoPimMiddlewareConnectorDependencyProvider
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCategoryDataImporterPlugin(Container $container): Container
    {
        $container->set(static::AKENEO_PIM_MIDDLEWARE_CATEGORY_IMPORTER_PLUGIN, function () {
            return new CategoryImporterPlugin();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAttributeDataImporterPlugin(Container $container): Container
    {
        $container->set(static::AKENEO_PIM_MIDDLEWARE_ATTRIBUTE_IMPORTER_PLUGIN, function () {
            return new AttributeImporterPlugin();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductAbstractDataImporterPlugin(Container $container): Container
    {
        $container->set(static::AKENEO_PIM_MIDDLEWARE_PRODUCT_ABSTRACT_IMPORTER_PLUGIN, function () {
            return new ProductAbstractImporterPlugin();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductConcreteDataImporterPlugin(Container $container): Container
    {
        $container->set(static::AKENEO_PIM_MIDDLEWARE_PRODUCT_CONCRETE_IMPORTER_PLUGIN, function () {
            return new ProductConcreteImporterPlugin();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductPriceDataImporterPlugin(Container $container): Container
    {
        $container->set(static::AKENEO_PIM_MIDDLEWARE_PRODUCT_PRICE_IMPORTER_PLUGIN, function () {
            return new ProductPriceImporterPlugin();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductAbstractStoresDataImporterPlugin(Container $container): Container
    {
        $container->set(static::AKENEO_PIM_MIDDLEWARE_PRODUCT_ABSTRACT_STORES_IMPORTER_PLUGIN, function () {
            return new ProductAbstractStoresImporterPlugin();
        });

        return $container;
    }
}
