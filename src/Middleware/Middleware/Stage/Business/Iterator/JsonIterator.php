<?php

namespace Middleware\Middleware\Stage\Business\Iterator;

use SplFileObject;

class JsonIterator extends AbstractFileContentIterator
{
    /**
     * @return void
     */
    protected function initIterator()
    {
        $this->iterator = new SplFileObject($this->fileName, 'r');
        $this->iterator->setFlags(SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);
    }

    /**
     * @param mixed $current
     *
     * @return array
     */
    protected function parseCurrentAsArray($current): array
    {
        return json_decode($current, true);
    }
}
