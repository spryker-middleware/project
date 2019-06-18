<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\RabbitMqProcess\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Middleware\Zed\RabbitMqProcess\Business\RabbitMqProcessBusinessFactory getFactory()
 */
class RabbitMqProcessFacade extends AbstractFacade implements RabbitMqProcessFacadeInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param int $messagesAmount
     *
     * @return void
     */
    public function publishMessages(int $messagesAmount): void
    {
        $this->getFactory()->createMessagePublisher()->publishMessages($messagesAmount);
    }
}
