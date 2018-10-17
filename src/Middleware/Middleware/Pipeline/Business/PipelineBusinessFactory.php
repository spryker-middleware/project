<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Middleware\Pipeline\Stage;

use League\Pipeline\FingersCrossedProcessor;
use Middleware\Middleware\Pipeline\Business\Stage\Stage;
use Middleware\Middleware\Pipeline\Business\StagePlugin\StagePluginInterface;
use Middleware\Middleware\Pipeline\Pipeline\Business\Pipeline;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class PipelineBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @var \Middleware\Middleware\Pipeline\Business\StagePlugin\StagePluginInterface
     */
    protected $stagePlugin;

    /**
     * @param \Middleware\Middleware\Pipeline\Business\StagePlugin\StagePluginInterface[] $stagePlugins
     *
     * @return \Middleware\Middleware\Pipeline\Pipeline\Business\PipelineInterface
     */
    public function createPipeline(array $stagePlugins)
    {
        return new Pipeline(
            $this->createPipelineProcessor(),
            $this->getStages($stagePlugins)
        );
    }

    /**
     * @param \Middleware\Middleware\Pipeline\Business\StagePlugin\StagePluginInterface[] $stagePlugins
     *
     * @return \Middleware\Middleware\Pipeline\Business\Stage\StageInterface[]
     */
    protected function getStages(array $stagePlugins)
    {
        $stages = [];
        foreach ($stagePlugins as $stagePlugin) {
            $stages[] = $this->createStage($stagePlugin);
        }

        return $stages;
    }

    /**
     * @param \Middleware\Middleware\Pipeline\Business\StagePlugin\StagePluginInterface $stagePlugin
     *
     * @return \Middleware\Middleware\Pipeline\Business\Stage\StageInterface
     */
    protected function createStage(StagePluginInterface $stagePlugin)
    {
        return new Stage($stagePlugin);
    }

    /**
     * @return \League\Pipeline\FingersCrossedProcessor
     */
    public function createPipelineProcessor()
    {
        return new FingersCrossedProcessor();
    }
}
