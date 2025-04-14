<?php

namespace Src\Validation\Types;


use Src\Validation\CoreValidatorInterface;
use Src\Validation\RuleValidator;

class LengthAwareValidation extends RuleValidator implements CoreValidatorInterface
{
    protected array $allowedRules = ['min', 'max'];

    public function validate(mixed $value, string $rule = null): bool
    {

        if(!$this->isValidRule(rule: $rule)) {
            return false;
        }

        list($ruleType, $ruleLength) = explode(separator: ':', string: $rule);

        if(!is_numeric(value: $ruleLength) || $ruleLength < 1) {
            return false;
        }

        $valueLength = strlen(string: $value);

        return !(
            ($ruleType === 'min' && $ruleLength > $valueLength) ||
            ($ruleType === 'max' && $ruleLength < $valueLength)
        );

    }

}