<?php

namespace Middleware\Middleware\Stage\Business\Iterator;

use Generated\Shared\Transfer\IteratorSettingsTransfer;
use Iterator;
use XMLReader;

class XmlIterator implements Iterator
{
    /**
     * @var string
     */
    protected $fileName;

    /**
     * @var \XMLReader
     */
    protected $xmlReader;

    /**
     * @var \Generated\Shared\Transfer\IteratorSettingsTransfer
     */
    protected $settings;

    /**
     * @var string
     */
    protected $current;

    /**
     * @var bool
     */
    protected $isValid;

    /**
     * @var string
     */
    private $rootNodeName;

    /**
     * @var int
     */
    protected $counter;

    /**
     * @param string $fileName
     * @param string $rootNodeName
     * @param \Generated\Shared\Transfer\IteratorSettingsTransfer $settings
     */
    public function __construct(string $fileName, string $rootNodeName, IteratorSettingsTransfer $settings)
    {
        $this->fileName = $fileName;
        $this->settings = $settings;
        $this->rootNodeName = $rootNodeName;
        $this->initIterator();
    }

    /**
     * @inheritdoc
     */
    public function current()
    {
        return $this->current;
    }

    /**
     * @inheritdoc
     */
    public function next()
    {
        $this->readNode();
    }

    /**
     * @inheritdoc
     */
    public function key()
    {
        return $this->counter;
    }

    /**
     * @inheritdoc
     */
    public function valid()
    {
        return $this->isValid && !$this->isLimitReached();
    }

    /**
     * @inheritdoc
     */
    public function rewind()
    {
        $this->initIterator();
    }

    /**
     * @return void
     */
    protected function initIterator()
    {
        $this->counter = -1;
        $this->xmlReader = new XMLReader();
        $this->xmlReader->open($this->fileName);
        $this->setOffset();
    }

    public function __destruct()
    {
        $this->xmlReader->close();
    }

    /**
     * @return void
     */
    protected function readNode()
    {
        while ($this->xmlReader->read()) {
            if ($this->xmlReader->nodeType === XMLReader::ELEMENT &&
                $this->xmlReader->name === $this->rootNodeName) {
                $this->current = $this->xmlReader->readOuterXml();
                $this->counter++;
                $this->isValid = true;
                return;
            }
        }
        $this->isValid = false;
    }

    /**
     * @return void
     */
    protected function setOffset()
    {
        $offset = $this->settings->getOffset();
        do {
            $this->readNode();
        } while ($offset > $this->counter && $this->valid());
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
}
