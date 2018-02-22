<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\Process\Communication\Plugin\TranslatorFunction;

use Middleware\Zed\Process\Business\Translator\TranslatorFunction\MixedToNull;
use SprykerMiddleware\Zed\Process\Communication\Plugin\TranslatorFunction\AbstractGenericTranslatorFunctionPlugin;

class MixedToNullTranslatorFunctionPlugin extends AbstractGenericTranslatorFunctionPlugin
{
    const NAME = 'MixedToNull';

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }

    /**
     * @return string
     */
    public function getTranslatorFunctionClassName(): string
    {
        return MixedToNull::class;
    }
}
