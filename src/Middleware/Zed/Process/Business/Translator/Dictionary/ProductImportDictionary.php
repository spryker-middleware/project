<?php

namespace Middleware\Zed\Process\Business\Translator\Dictionary;

use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\AbstractDictionary;
use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\ArrayToString;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\StringToArray;

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
                    DictionaryInterface::OPTIONS => [
                        StringToArray::OPTION_DELIMITER => '|',
                    ],
                ],
            ],
            'categories' => [
                [
                    'ArrayToString',
                    DictionaryInterface::OPTIONS => [
                        ArrayToString::OPTION_GLUE => '|',
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
