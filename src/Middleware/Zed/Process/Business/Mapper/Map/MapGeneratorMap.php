<?php

namespace Middleware\Zed\Process\Business\Mapper\Map;

use Generated\Shared\Transfer\MapperConfigTransfer;
use Middleware\Shared\Process\ProcessConstants;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;

class MapGeneratorMap implements MapInterface
{
    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getMapperConfig(): MapperConfigTransfer
    {
        $mapperConfigTransfer = new MapperConfigTransfer();
        $mapperConfigTransfer->setMap($this->getMap());
        $mapperConfigTransfer->setStrategy($this->getStrategy());
        return $mapperConfigTransfer;
    }

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
        return ProcessConstants::MAPPER_STRATEGY_SKIP_UNKNOWN;
    }
}
