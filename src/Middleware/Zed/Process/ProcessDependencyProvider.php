<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\Process;

use Middleware\Zed\RabbitMqProcess\Communication\Plugin\ProcessConfiguration\RabbitMqProcessConfigurationPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Configuration\DefaultConfigurationProfilePlugin;
use SprykerMiddleware\Zed\Process\ProcessDependencyProvider as SprykerMiddlewareProcessDependencyProvider;

class ProcessDependencyProvider extends SprykerMiddlewareProcessDependencyProvider
{
    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ConfigurationProfilePluginInterface[]
     */
    protected function getConfigurationProfilePluginsStack(): array
    {
        return [
            new DefaultConfigurationProfilePlugin(),
        ];
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ProcessConfigurationPluginInterface[]
     */
    public function getProcessesPluginsStack(): array
    {
        return [
            new RabbitMqProcessConfigurationPlugin(),
        ];
    }
}
