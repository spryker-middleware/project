<?php

namespace Middleware\Zed\Process\Business\Mapper\Map;

use Middleware\Zed\Process\ProcessConfig as MiddlewareProcessConfig;
use SprykerMiddleware\Shared\Process\ProcessConfig;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\AbstractMap;

class ProductImportMap extends AbstractMap
{
    /**
     * @var \Middleware\Zed\Process\ProcessConfig string
     */
    protected $config;

    /**
     * ProductImportMap constructor.
     *
     * @param \SprykerMiddleware\Shared\Process\ProcessConfig $config
     */
    public function __construct(MiddlewareProcessConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    protected function getMap(): array
    {
        $generated_map = $this->readMapFromFile($this->config->getMapGeneratorOutputPath());
        $additional_map = $this->readMapFromFile($this->config->getProductImportAdditionalMapPath());
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
