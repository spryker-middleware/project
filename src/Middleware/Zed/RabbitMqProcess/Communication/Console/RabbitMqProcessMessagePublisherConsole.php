<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\RabbitMqProcess\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Middleware\Zed\RabbitMqProcess\Business\RabbitMqProcessFacadeInterface getFacade()
 */
class RabbitMqProcessMessagePublisherConsole extends Console
{
    protected const COMMAND_NAME = 'queue:publish-messages';
    protected const DESCRIPTION = 'Publishes messages to queue';
    protected const OPTION_MESSAGES_AMOUNT = 'amount';
    protected const OPTION_MESSAGES_AMOUNT_SHORTCUT = 'a';

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName(static::COMMAND_NAME)
            ->setDescription(static::DESCRIPTION);

        $this->addOption(
            static::OPTION_MESSAGES_AMOUNT,
            static::OPTION_MESSAGES_AMOUNT_SHORTCUT,
            InputOption::VALUE_REQUIRED,
            'Amount of messages to be published.'
        );
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $this->getFacade()->publishMessages($input->getOption(static::OPTION_MESSAGES_AMOUNT));

        return 1;
    }
}
