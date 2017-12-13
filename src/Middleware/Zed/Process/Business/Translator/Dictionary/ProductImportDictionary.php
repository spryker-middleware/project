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
            'associations' => [
                'StringToArray',
                'options' => [
                    'delimiter' => '|',
                ],
            ],
            'categories' => [
                'ArrayToString',
                'options' => [
                    'glue' => '|',
                ],
            ],
            'created' =>  'StringToDateTime',
            'values' => function ($value) {
                $result = [];
                foreach ($value as $key => $data) {
                    $result[$key] = $data['value'];
                }

                return $result;
            },
        ];
    }
}
