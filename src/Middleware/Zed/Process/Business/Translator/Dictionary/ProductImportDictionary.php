<?php

namespace Middleware\Zed\Process\Business\Translator\Dictionary;

use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\AbstractDictionary;

class ProductImportDictionary extends AbstractDictionary
{
    /**
     * @return array
     */
    public function getDictionary(): array
    {
        return [
            'associations' => [
                [
                    'StringToArray',
                    'options' => [
                        'delimiter' => '|',
                    ],
                ],
            ],
            'categories' => [
                [
                    'ArrayToString',
                    'options' => [
                        'glue' => '|',
                    ],
                ],
            ],
            'prices.*.*' => [
                'StringToFloat',
                'MoneyDecimalToInteger',
            ],
            'created' => 'StringToDateTime',
            'values.*' => function ($value, $key, $payload) {
                $result = [];
                foreach ($value as $element) {
                    $result[$element['locale']] = $element['data'];
                }
                return $result;
            },
            'values' => [
                [
                    'ExcludeKeysAssociativeFilter',
                    'options' => [
                        'excludeKeys' => [
                            'price',
                            'verschliessbarkeit',
                            'dach',
                            'material',
                            'localizedAttributes',
                        ],
                    ],
                ],
            ],
            'localizedAttributes.*' => [
                [
                    'WhitelistKeysAssociativeFilter',
                    'options' => [
                        'whitelistKeys' => [
                            'locale',
                            'keep',
                        ],
                    ],
                ],
            ],
        ];
    }
}
