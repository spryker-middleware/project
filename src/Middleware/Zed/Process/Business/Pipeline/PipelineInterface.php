<?php
namespace Middleware\Zed\Process\Business\Pipeline;

use Middleware\Zed\Process\Business\Pipeline\Stage\StageInterface;

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

    /**
     * Process the payload.
     *
     * @param mixed $payload
     *
     * @return mixed
     */
    public function process($payload);
}
