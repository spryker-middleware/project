<?php

namespace  Middleware\Zed\Process\Business\Pipeline\Stage;

use Middleware\Zed\Process\Business\Pipeline\StagePLugin\StagePluginInterface;

class Stage implements StageInterface
{
    /**
     * @var \Middleware\Zed\Process\Business\Pipeline\StagePlugin\StagePluginInterface
     */
    protected $stagePlugin;

    /**
     * @param \Middleware\Zed\Process\Business\Pipeline\StagePlugin\StagePluginInterface $stagePlugin
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
