<?php

namespace Src\Validation;

abstract class RuleValidator
{
    protected array $allowedRules = [];

    protected function isValidRule(string $rule): bool
    {
        $rules = explode(separator: ':', string: $rule);
        return count($rules) === 2 && in_array(needle: $rules[0], haystack: $this->allowedRules);
    }
}