<?php

namespace  Middleware\Zed\Stage\Business\Iterator;

use Generated\Shared\Transfer\IteratorSettingsTransfer;

abstract class AbstractFileContentIterator extends AbstractProxyIterator
{
    /**
     * @var string
     */
    protected $fileName;

    /**
     * @var \SeekableIterator
     */
    protected $iterator;

    /**
     * @var \Generated\Shared\Transfer\IteratorSettingsTransfer
     */
    protected $settings;

    /**
     * @var int
     */
    protected $counter;

    /**
     * @param string $fileName
     * @param \Generated\Shared\Transfer\IteratorSettingsTransfer $settings
     */
    public function __construct(string $fileName, IteratorSettingsTransfer $settings)
    {
        parent::__construct($settings);
        $this->fileName = $fileName;
        $this->initIterator();
        $this->setOffset();
    }

    /**
     * @inheritdoc
     */
    public function current()
    {
        $current = $this->iterator->current();

        if ($this->settings->getParseAsArray()) {
            $current = $this->parseCurrentAsArray($current);
        }
        return $current;
    }

    /**
     * @param mixed $current
     *
     * @return array
     */
    abstract protected function parseCurrentAsArray($current): array;
}
