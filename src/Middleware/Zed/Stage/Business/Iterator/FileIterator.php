<?php
namespace  Middleware\Zed\Stage\Business\Iterator;

use Generated\Shared\Transfer\IteratorSettingsTransfer;
use Symfony\Component\Finder\Finder;

class FileIterator extends AbstractProxyIterator
{
    /**
     * @var string
     */
    protected $directory;

    /**
     * @var \Symfony\Component\Finder\Finder
     */
    protected $finder;

    /**
     * @param string $directory
     * @param \Symfony\Component\Finder\Finder $finder
     * @param \Generated\Shared\Transfer\IteratorSettingsTransfer|null $settings
     */
    public function __construct(string $directory, Finder $finder, IteratorSettingsTransfer $settings = null)
    {
        parent::__construct($settings);
        $this->directory = $directory;
        $this->finder = $finder;
        $this->initIterator();
    }

    /**
     * @return \SplFileInfo
     */
    public function current()
    {
        return $this->iterator
            ->current()
            ->getRealPath();
    }

    /**
     * @return false
     */
    protected function initIterator()
    {
        $this->iterator = $this->finder
            ->files()
            ->in($this->directory)
            ->depth(0)
            ->sortByName()
            ->getIterator();
    }
}
