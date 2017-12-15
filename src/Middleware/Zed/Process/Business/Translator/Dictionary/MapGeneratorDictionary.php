<?php

namespace Middleware\Zed\Process\Business\Translator\Dictionary;

use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface;

class MapGeneratorDictionary implements DictionaryInterface
{
    /**
     * @return array
     */
    public function getDictionary(): array
    {
        return [
            'parent' => [
                'Enum',
                'options' => [
                    'map' => [
                        '' => 'parent',
                        '1' => 'ancestor',
                    ],
                ],
            ],
        ];
    }
}
