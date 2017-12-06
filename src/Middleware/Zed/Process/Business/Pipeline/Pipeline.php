<?php
namespace Middleware\Zed\Process\Business\Pipeline;

use League\Pipeline\ProcessorInterface;

class Pipeline implements PipelineInterface
{
    /**
     * @var \Middleware\Zed\Process\Business\Pipeline\Stage\StageInterface[]
     */
    protected $stages = [];

    /**
     * @var \League\Pipeline\ProcessorInterface
     */
    protected $processor;

    /**
     * @param \League\Pipeline\ProcessorInterface $processor
     * @param \Middleware\Zed\Process\Business\Pipeline\Stage\StageInterface[] $stages
     */
    public function __construct(ProcessorInterface $processor, array $stages)
    {
        $this->processor = $processor;
        $this->stages = $stages;
    }

    /**
     * Create a new pipeline with an appended stage.
     *
     * @param \Middleware\Zed\Process\Business\Pipeline\Stage\StageInterface|callable $stage
     *
     * @return static
     */
    public function pipe(callable $stage)
    {
        $pipeline = clone $this;
        $pipeline->stages[] = $stage;

        return $pipeline;
    }

    /**
     * Process the payload.
     *
     * @param mixed $payload
     *
     * @return mixed
     */
    public function process($payload)
    {
        return $this->processor->process($this->stages, $payload);
    }

    /**
     * @inheritdoc
     */
    public function __invoke($payload)
    {
        return $this->process($payload);
    }
}
