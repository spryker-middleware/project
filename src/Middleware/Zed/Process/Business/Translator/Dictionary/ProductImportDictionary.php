<?php

namespace Middleware\Zed\Process\Business\Translator\Dictionary;

use Generated\Shared\Transfer\TranslatorConfigTransfer;
use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface;

class ProductImportDictionary implements DictionaryInterface
{
    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getTranslatorConfig(): TranslatorConfigTransfer
    {
        $translatorConfigTransfer = new TranslatorConfigTransfer();
        $translatorConfigTransfer->setDictionary($this->getDictionary());
        return $translatorConfigTransfer;
    }

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
