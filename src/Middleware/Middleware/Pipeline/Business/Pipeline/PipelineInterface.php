<?php
namespace Middleware\Middleware\Pipeline\Pipeline\Business;

use Middleware\Middleware\Pipeline\Business\Stage\StageInterface;

interface PipelineInterface extends StageInterface
{
    /**
     * Create a new pipeline with an appended stage.
     *
     * @param callable $operation
     *
     * @return static
     */
    public function pipe(callable $operation);
}
