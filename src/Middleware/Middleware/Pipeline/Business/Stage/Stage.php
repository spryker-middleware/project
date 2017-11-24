<?php

namespace Middleware\Middleware\Pipeline\Business\Stage;

use Middleware\Middleware\Pipeline\Business\StagePLugin\StagePluginInterface;

class Stage implements StageInterface
{
    /**
     * @var \Middleware\Middleware\Pipeline\Business\StagePlugin\StagePluginInterface
     */
    protected $stagePlugin;

    /**
     * @param \Middleware\Middleware\Pipeline\Business\StagePlugin\StagePluginInterface $stagePlugin
     */
    public function __construct(StagePluginInterface $stagePlugin)
    {
        $this->stagePlugin = $stagePlugin;
    }

    /**
     * @inheritdoc
     */
    public function __invoke($payload)
    {
        return $this->stagePlugin
            ->process($payload);
    }
}
