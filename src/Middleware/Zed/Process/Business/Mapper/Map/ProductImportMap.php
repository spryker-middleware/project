<?php

namespace Middleware\Zed\Process\Business\Mapper\Map;

use SprykerMiddleware\Shared\Process\ProcessConfig;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\AbstractMap;

class ProductImportMap extends AbstractMap
{
    /**
     * @var string
     */
    protected $generatedMapPath;

    /**
     * @var string
     */
    protected $additionalMapPath;

    /**
     * ProductImportMap constructor.
     *
     * @param string $generatedMapPath
     * @param string $additionalMapPath
     */
    public function __construct(string $generatedMapPath, string $additionalMapPath)
    {
        $this->generatedMapPath = $generatedMapPath;
        $this->additionalMapPath = $additionalMapPath;
    }

    /**
     * @return array
     */
    protected function getMap(): array
    {
        $generated_map = $this->readMapFromFile($this->generatedMapPath);
        $additional_map = $this->readMapFromFile($this->additionalMapPath);
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
            'localizedAttributes' => [
                'values.localizedAttributes',
                'itemMap' => [
                        'keep' => 'keep',
                ],
                'itemExcept' => ['leaveOut', 'data'],
                'except' => [],
            ],
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
                'except' => ['price', 'verschliessbarkeit', 'dach', 'material', 'localizedAttributes'],
            ],
            'created' => 'created',
            'associations' => 'associations',
        ];
        return array_merge(reset($generated_map), reset($additional_map), $custom_map);
    }

    /**
     * @return string
     */
    protected function getStrategy(): string
    {
        return ProcessConfig::MAPPER_STRATEGY_COPY_UNKNOWN;
    }
}
