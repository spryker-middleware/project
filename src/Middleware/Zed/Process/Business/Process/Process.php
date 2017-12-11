<?php
namespace Middleware\Zed\Process\Business\Process;

use Iterator;
use Middleware\Zed\Process\Business\Pipeline\PipelineInterface;

class Process implements ProcessInterface
{
    /**
     * @var \Iterator
     */
    protected $iterator;

    /**
     * @var \Middleware\Zed\Process\Business\Pipeline\PipelineInterface
     */
    protected $pipeline;

    /**
     * @param \Iterator $iterator
     * @param \Middleware\Zed\Process\Business\Pipeline\PipelineInterface $pipeline
     */
    public function __construct(Iterator $iterator, PipelineInterface $pipeline)
    {
        $this->iterator = $iterator;
        $this->pipeline = $pipeline;
    }

    /**
     * @return void
     */
    public function process()
    {
        foreach ($this->iterator as $item) {
            $this->pipeline->process($item);
        }
    }
}
