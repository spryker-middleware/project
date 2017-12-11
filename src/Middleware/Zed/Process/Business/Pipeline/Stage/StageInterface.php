<?php
namespace  Middleware\Zed\Process\Business\Pipeline\Stage;

interface StageInterface
{
    /**
     * Process the payload.
     *
     * @param mixed $payload
     *
     * @return mixed
     */
    public function __invoke($payload);
}
