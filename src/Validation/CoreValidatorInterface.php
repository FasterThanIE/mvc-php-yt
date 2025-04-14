<?php

namespace Src\Validation;

interface CoreValidatorInterface
{
    public function validate(
        mixed $value, string $rule = null
    ): bool;
}