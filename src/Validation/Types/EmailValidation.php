<?php

namespace Src\Validation\Types;

use Src\Validation\CoreValidatorInterface;

class EmailValidation implements CoreValidatorInterface
{
    public function validate(mixed $value, string $rule = null): bool
    {
        return filter_var(
            value: $value, filter: FILTER_VALIDATE_EMAIL
        );
    }
}