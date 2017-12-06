<?php
namespace Middleware\Zed\Process\Communication\Console;

use Generated\Shared\Transfer\IteratorSettingsTransfer;
use Generated\Shared\Transfer\ProcessSettingsTransfer;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Middleware\Zed\Process\Communication\ProcessCommunicationFactory getFactory()
 */
class ProcessConsole extends Console
{
    const COMMAND_NAME = 'middleware:process:run';
    const DESCRIPTION = 'Run middleware process';
    const OPTION_PROCESS_NAME = 'process';
    const OPTION_ITERATOR_OFFSET = 'offset';
    const OPTION_ITERATOR_LIMIT = 'limit';

    /**
     * @var int
     */
    protected $exitCode = self::CODE_SUCCESS;

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName(static::COMMAND_NAME)
            ->setDescription(static::DESCRIPTION);

        $this->addOption(
            static::OPTION_PROCESS_NAME,
            'p',
            InputOption::VALUE_REQUIRED,
            'Name of middleware process.'
        );

        $this->addOption(
            static::OPTION_ITERATOR_OFFSET,
            'o',
            InputOption::VALUE_OPTIONAL,
            'Count of items that should be skipped during processing'
        );

        $this->addOption(
            static::OPTION_ITERATOR_LIMIT,
            'l',
            InputOption::VALUE_OPTIONAL,
            'Count of items that should be processed'
        );
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $processSettingsTransfer = $this->processArgs($input, $output);
        if ($this->hasError()) {
            return $this->exitCode;
        }
        $this->getFactory()
            ->createProcess($processSettingsTransfer)
            ->process();

        return $this->exitCode;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return \Generated\Shared\Transfer\ProcessSettingsTransfer
     */
    protected function processArgs(InputInterface $input, OutputInterface $output): ProcessSettingsTransfer
    {
        $processSettingsTransfer = new ProcessSettingsTransfer();
        $processSettingsTransfer->setIteratorSettings(new IteratorSettingsTransfer());
        if ($input->getOption(self::OPTION_PROCESS_NAME)) {
            $processSettingsTransfer->setName($input->getOption(self::OPTION_PROCESS_NAME));
            $offset = $input->getOption(self::OPTION_ITERATOR_OFFSET) ?: 0;
            $limit = $input->getOption(self::OPTION_ITERATOR_LIMIT) ?: -1;
            $processSettingsTransfer->getIteratorSettings()->setOffset($offset);
            $processSettingsTransfer->getIteratorSettings()->setLimit($limit);

            return $processSettingsTransfer;
        }
        $this->exitCode = self::CODE_ERROR;
        $this->error('Process name is required.');
        return $processSettingsTransfer;
    }

    /**
     * @return bool
     */
    protected function hasError()
    {
        return $this->exitCode !== self::CODE_SUCCESS;
    }
}
