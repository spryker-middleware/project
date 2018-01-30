<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\Process\Communication\Plugin\TranslatorFunction;

use Middleware\Zed\Process\Business\Translator\TranslatorFunction\MixedToNull;
use SprykerMiddleware\Zed\Process\Communication\Plugin\TranslatorFunction\AbstractTranslatorFunctionPlugin;

class MixedToNullTranslatorFunctionPlugin extends AbstractTranslatorFunctionPlugin
{
    const NAME = 'MixedToNull';

    /**
     * @return string
     */
    public function getName()
    {
        return static::NAME;
    }

    /**
     * @return string
     */
    public function getTranslatorFunctionClassName()
    {
        return MixedToNull::class;
    }
}
