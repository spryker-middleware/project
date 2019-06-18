<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\Process\Business\Mapper\Map;

use SprykerMiddleware\Shared\Process\ProcessConfig;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\AbstractMap;

class MapGeneratorMap extends AbstractMap
{
    /**
     * @return array
     */
    protected function getMap(): array
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

    /**
     * @return string
     */
    protected function getStrategy(): string
    {
        return ProcessConfig::MAPPER_STRATEGY_SKIP_UNKNOWN;
    }
}
