<?php

namespace Middleware\Zed\Process\Business\Mapper\Map;

use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;

class MapGeneratorMap implements MapInterface
{
    /**
     * @return array
     */
    public function getMap(): array
    {
        return [
            'link' => function ($payload) {
                return $payload['link_field_name'];
            },
            'sku' => function ($payload) {
                return $payload['sku_field_name'];
            },
            'categories' => function ($payload) {
                return $payload['categories_field_name'];
            },
            'is_active' => function ($payload) {
                return $payload['active_field_name'];
            },
            'parent' => '',
        ];
    }
}
