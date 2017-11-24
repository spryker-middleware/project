<?php
namespace Middleware\Middleware\Pipeline\Business\Stage;

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
