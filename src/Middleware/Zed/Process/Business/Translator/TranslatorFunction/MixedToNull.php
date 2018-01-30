<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\Process\Business\Translator\TranslatorFunction;

use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;

class MixedToNull extends AbstractTranslatorFunction
{
    /**
     * @param mixed $value
     *
     * @return array
     */
    public function translate($value)
    {
        return null;
    }
}
