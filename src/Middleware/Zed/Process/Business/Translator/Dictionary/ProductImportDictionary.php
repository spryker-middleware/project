<?php

namespace Middleware\Zed\Process\Business\Translator\Dictionary;

use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\AbstractDictionary;

class ProductImportDictionary implements AbstractDictionary
{
    /**
     * @return array
     */
    protected function getDictionary(): array
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
            'values' => function ($value, $key, $payload) {
                $result = [];
                foreach ($value as $key => $data) {
                    $result[$key] = $data['value'];
                }

                return $result;
            },
        ];
    }
}
