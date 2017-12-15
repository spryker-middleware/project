<?php

namespace Middleware\Zed\Process\Business\Translator\Dictionary;

use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface;

class ProductImportDictionary implements DictionaryInterface
{
    /**
     * @return array
     */
    public function getDictionary(): array
    {
        return [
            'headerdate2' => ['StringToDateTime'],
            'headerdate' => [
                'DateTimeToString',
                'options' => ['format' => 'Y-m-d\TH:i:s'],
            ],
            'customer.salutation' => [
                'Enum',
                'options' => [
                    'map' => [
                        '10' => 'Mr',
                        '20' => 'Mrs',
                    ],
                ],
            ],
            'key3' => ['BoolToString'],   //bool(false) => 'false', bool(true) => 'true'
            'key4' => ['FloatToInt'],
            'key5' => ['FloatToString'],
            'key6' => ['IntToFloat'],
            'key7' => ['IntToString'],
            'key8' => ['StringToInt'],
            'key9' => ['StringToFloat'],
            'key10' => ['StringToBool'],
        ];
    }
}
