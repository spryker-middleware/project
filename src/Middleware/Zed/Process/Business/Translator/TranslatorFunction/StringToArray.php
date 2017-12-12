<?php

namespace Middleware\Zed\Process\Business\Translator\TranslatorFunction;

use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionAbstract;

class StringToArray extends TranslatorFunctionAbstract
{
    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function translate($value)
    {
        return explode($this->options['delimiter'], $value);
    }
}
