<?php

namespace Middleware\Zed\Process\Business\Translator\Dictionary;

use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\AbstractDictionary;

class MapGeneratorDictionary extends AbstractDictionary
{
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
