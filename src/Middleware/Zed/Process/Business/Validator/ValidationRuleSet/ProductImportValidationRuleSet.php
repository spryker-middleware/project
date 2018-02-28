<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Middleware\Zed\Process\Business\Validator\ValidationRuleSet;

use SprykerMiddleware\Zed\Process\Business\Validator\ValidationRuleSet\AbstractValidationRuleSet;

class ProductImportValidationRuleSet extends AbstractValidationRuleSet
{
    /**
     * @return array
     */
    protected function getRules(): array
    {
        return [
            'identifier' => [
                'Required',
                'NotBlank',
                [
                    'Regex',
                    'options' => [
                        'pattern' => '/^\d{6}$/'
                    ],
                ],
            ],
            'created' => [
                'Required',
            ],
            'values' => [
                'NotBlank',
            ],
        ];
    }
}