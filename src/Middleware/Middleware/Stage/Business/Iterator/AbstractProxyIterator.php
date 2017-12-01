<?php


namespace Middleware\Middleware\Stage\Business\Iterator;

use Generated\Shared\Transfer\IteratorSettingsTransfer;
use Iterator;

abstract class AbstractProxyIterator implements Iterator
{
    /**
     * @var \Generated\Shared\Transfer\IteratorSettingsTransfer
     */
    protected $settings;

    /**
     * @var int
     */
    protected $counter;

    /**
     * @var \SeekableIterator
     */
    protected $iterator;

    /**
     * @param \Generated\Shared\Transfer\IteratorSettingsTransfer|null $settings
     */
    public function __construct(IteratorSettingsTransfer $settings = null)
    {
        $this->settings = $settings;
    }

    /**
     * @inheritdoc
     */
    public function current()
    {
        return $this->iterator->current();
    }

    /**
     * @inheritdoc
     */
    public function next()
    {
        $this->iterator->next();
        $this->counter++;
    }

    /**
     * @inheritdoc
     */
    public function key()
    {
        return $this->iterator->key();
    }

    /**
     * @inheritdoc
     */
    public function valid()
    {
        return $this->iterator->valid() && !$this->isLimitReached();
    }

    /**
     * @inheritdoc
     */
    public function rewind()
    {
        $this->iterator->rewind();
        $this->setOffset();
    }

    /**
     * @return void
     */
    protected function setOffset()
    {
        $this->iterator->seek($this->settings->getOffset());
        $this->counter = $this->settings->getOffset();
    }

    /**
     * @return bool
     */
    protected function isLimitReached()
    {
        if ($this->settings->getLimit() < 0) {
            return false;
        }
        return $this->counter >= $this->settings->getOffset() + $this->settings->getLimit();
    }

    /**
     * @return void
     */
    abstract protected function initIterator();
}
