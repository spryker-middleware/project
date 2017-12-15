<?php

namespace Middleware\Zed\Process\Business\Mapper\Map;

use DateTime;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;

class ProductImportMap implements MapInterface
{
    /**
     * @var string
     */
    protected $preGeneratedMapPath;

    /**
     * @param string $preGeneratedMapPath
     */
    public function __construct(string $preGeneratedMapPath = '')
    {
        $this->preGeneratedMapPath = $preGeneratedMapPath;
    }
    
    /**
     * @return array
     */
    public function getMap(): array
    {
        $generated_map = ($this->preGeneratedMapPath != '') ? unserialize(file_get_contents($this->preGeneratedMapPath)) : [];
        $custom_map = [
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
            'headerdate' => function ($payload) {
                return new DateTime('2011-01-01T15:03:01.012345Z');
            },
            'headerdate2' => function ($payload) {
                return '2011-01-01T15:03:01.012345Z';
            },
            'customer.salutation' => function ($payload) {
                return '101';
            },
            'key3' => function ($payload) {
                return true;
            },
            'key4' => function ($payload) {
                return 1.0000124668092E+13;
            },
            'key5' => function ($payload) {
                return 1.0000124668092E+13;
            },
            'key6' => function ($payload) {
                return 123456;
            },
            'key7' => function ($payload) {
                return 123456;
            },
            'key8' => function ($payload) {
                return '123456';
            },
            'key9' => function ($payload) {
                return '1.0000124668092';
            },
            'key10' => function ($payload) {
                return 'Truesome';
            },
        ];
        return array_merge($generated_map, $custom_map);
    }
}
