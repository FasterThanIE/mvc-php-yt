<?php

namespace App\Validators;


use Src\Validation\CoreValidatorInterface;

class TestValidator implements CoreValidatorInterface {

    public function validate(mixed $value, string $rule = null): bool
    {
        return true;
    }
}