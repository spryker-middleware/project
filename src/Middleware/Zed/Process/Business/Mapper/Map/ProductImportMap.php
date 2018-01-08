<?php

namespace Middleware\Zed\Process\Business\Mapper\Map;

use SprykerMiddleware\Shared\Process\ProcessConfig;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\AbstractMap;

class ProductImportMap extends AbstractMap
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
    protected function getMap(): array
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
            'localizedAttributes' => 'values.localizedAttributes',
            'values' => 'values',
            'created' => 'created',
            'associations' => 'associations',
        ];
        return array_merge(reset($generated_map), $custom_map);
    }

    /**
     * @return string
     */
    protected function getStrategy(): string
    {
        return ProcessConfig::MAPPER_STRATEGY_COPY_UNKNOWN;
    }
}
