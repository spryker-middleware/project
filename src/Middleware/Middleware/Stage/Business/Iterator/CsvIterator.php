<?php
namespace Middleware\Middleware\Stage\Business\Iterator;

use SplFileObject;

class CsvIterator extends AbstractFileContentIterator
{
    /**
     * @var string
     */
    protected $delimiter;

    /**
     * @param string $fileName
     * @param \Generated\Shared\Transfer\IteratorSettingsTransfer|null $settings
     * @param string $delimiter
     */
    public function __construct($fileName, $settings = null, $delimiter = ',')
    {
        $this->delimiter = $delimiter;
        parent::__construct($fileName, $settings);
    }

    /**
     * @return void
     */
    protected function initIterator()
    {
        $this->iterator = new SplFileObject($this->fileName, 'r');
        $this->iterator->setFlags(SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);

        if ($this->settings->getParseAsArray()) {
            $this->iterator->setFlags($this->iterator->getFlags() | SplFileObject::READ_CSV);
            $this->iterator->setCsvControl($this->delimiter);
        }
    }

    /**
     * @param mixed $current
     *
     * @return array
     */
    protected function parseCurrentAsArray($current): array
    {
        return $current;
    }
}
