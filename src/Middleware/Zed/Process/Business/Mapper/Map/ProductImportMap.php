<?php

namespace Middleware\Zed\Process\Business\Mapper\Map;

use SprykerMiddleware\Shared\Process\ProcessConstants;
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
        $generated_map = ($this->preGeneratedMapPath != '') ? json_decode(file_get_contents($this->preGeneratedMapPath), true) : [];
        $custom_map = [
            'prices' => function (array $payload, string $key) {
                $prices = $payload['values']['price'];
                $mappedPrices = [];
                foreach ($prices as $price) {
                    $localePrices = [];
                    foreach ($price['data'] as $localePrice) {
                        $localePrices[$localePrice['currency']] = (float)$localePrice['amount'];
                    }
                    $mappedPrices[$price['locale']] = $localePrices;
                }

                return $mappedPrices;
            },
            'values' => [
                'values',
                'itemMap' => [
                    'value' => function (array $item, string $key) {
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
        return array_merge(reset($generated_map), $custom_map);
    }

    /**
     * @return string
     */
    public function getStrategy(): string
    {
        return ProcessConstants::MAPPER_STRATEGY_SKIP_UNKNOWN;
    }
}
