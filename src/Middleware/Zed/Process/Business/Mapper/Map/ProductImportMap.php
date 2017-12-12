<?php

namespace Middleware\Zed\Process\Business\Mapper\Map;

use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;

class ProductImportMap implements MapInterface
{
    /**
     * @return array
     */
    public function getMap(): array
    {
        return [
            'link' => '_links.self.href',
            'sku' => 'identifier',
            'categories' => 'categories',
            'is_active' => 'enabled',
            'parent' => 'parent',
            'prices' => function (array $payload) {
                $prices = $payload['values']['price'];
                $mappedPrices = [];
                foreach ($prices as $price) {
                    $localePrices = [];
                    foreach ($price['data'] as $localePrice) {
                        $localePrices[$localePrice['currency']] = $localePrice['amount'];
                    }
                    $mappedPrices[$price['locale']] = $localePrices;
                }

                return $mappedPrices;
            },
            'values' => [
                'values',
                'itemMap' => [
                    'value' => function (array $item) {
                        $mappedItem = [];
                        foreach ($item as $element) {
                            $mappedItem[$element['locale']] = $element['data'];
                        }
                        return $mappedItem;
                    },
                ],
                'except' => ['price', 'verschliessbarkeit', 'dach', 'material'],
            ],
            'created' => 'created',
            'associations' => 'associations',
        ];
    }
}
