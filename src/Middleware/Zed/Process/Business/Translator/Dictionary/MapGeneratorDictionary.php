<?php

namespace Middleware\Zed\Process\Business\Translator\Dictionary;

use Generated\Shared\Transfer\TranslatorConfigTransfer;
use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface;

class MapGeneratorDictionary implements DictionaryInterface
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
    public function getDictionary(): array
    {
        return [
            'parent' => [
                [
                    'Enum',
                    'options' => [
                        'map' => [
                            '' => 'parent',
                            '1' => 'ancestor',
                        ],
                    ],
                ],
            ],
        ];
    }
}
