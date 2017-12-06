<?php


namespace Middleware\Zed\Process\Business\Iterator;

use Iterator;
use OuterIterator;

class CombinedIterator implements OuterIterator
{
    /**
     * @var \SeekableIterator
     */
    protected $iterator;

    /**
     * @var \SeekableIterator
     */
    protected $innerIterator;

    /**
     * @var string
     */
    protected $innerIteratorClassName;

    /**
     * @var array
     */
    protected $innerIteratorArgs;

    /**
     * CombinedIterator constructor.
     *
     * @param \Iterator $iterator
     * @param string $innerIteratorClassName
     * @param array $innerIteratorArgs
     */
    public function __construct(Iterator $iterator, $innerIteratorClassName, $innerIteratorArgs)
    {
        $this->iterator = $iterator;
        $this->innerIteratorClassName = $innerIteratorClassName;
        $this->innerIteratorArgs = $innerIteratorArgs;
    }

    /**
     * @inheritdoc
     */
    public function current()
    {
        return $this->innerIterator
            ->current();
    }

    /**
     * @inheritdoc
     */
    public function next()
    {
        $this->innerIterator->next();
        if ($this->innerIterator->valid()) {
            return;
        }
        $this->initNextInnerIterator();
    }

    /**
     * @inheritdoc
     */
    public function key()
    {
        return $this->iterator->key() . '_' . $this->getInnerIterator()->key();
    }

    /**
     * @inheritdoc
     */
    public function valid()
    {
        return $this->iterator->valid();
    }

    /**
     * @inheritdoc
     */
    public function rewind()
    {
        $this->iterator->rewind();
        $this->innerIterator = null;
        $this->initNextInnerIterator();
    }

    /**
     * @return \SeekableIterator
     */
    public function getInnerIterator()
    {
        return $this->innerIterator;
    }

    /**
     * @return void
     */
    protected function initNextInnerIterator()
    {
        do {
            if ($this->innerIterator) {
                $this->iterator->next();
            }
            if (!$this->iterator->valid()) {
                return;
            }
            $this->innerIterator = new $this->innerIteratorClassName(
                $this->iterator->current(),
                ...$this->innerIteratorArgs
            );
        } while (!$this->innerIterator->valid());
    }
}
