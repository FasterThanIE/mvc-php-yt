<?php

namespace Src\Validation;

use Src\Validation\Types\EmailValidation;
use Src\Validation\Types\LengthAwareValidation;

trait ShouldValidate
{
    protected array $validatorMap = [
        'min' => LengthAwareValidation::class,
        'max' => LengthAwareValidation::class,
        'email' => EmailValidation::class,
    ];

    public function validateFields(
        array $values,
        array $validationRules
    ): bool {

        /**
         * TODO: Mindf*** for wednesday:
         *  :: User passes for example ['name' => 'qwdqwdq'] but doesn't pass other fields, should we
         *      validate them or not? Do we make sure all fields are validated?
         *  So far it works that way that ALL fields must be passed
         *
         * Idea:: Pass fields n'd validation rules
         *      (told ya, it's a mindf***)
         *
         * TODO: I know.. But there's another one, "min:5" and "email" problem
         *      Currently we hacked it with str_contains, but in future refactor this to be 'min' => 5 etc,
         *      array approach (don't be a pleb)
         */

        foreach($validationRules as $field => $rules) {
            foreach ($rules as $rule) {

                $tempRule = $rule;


                // mind**** for 'min:X'
                if(str_contains(haystack: $rule, needle: 'min') || str_contains(haystack: $rule, needle: 'max')) {
                    $tempRule = explode(separator: ':', string: $rule)[0];
                }

                if(!array_key_exists(key: $tempRule, array: $this->validatorMap)) {
                    return false;
                }


                $validationClass = new $this->validatorMap[$tempRule];

                $response = $validationClass->validate($values[$field], $tempRule);

                /**
                 * Stopped worked at password min max rule
                 */
                if(!$response) {
                    var_dump($field, $tempRule); die();
                    return false;
                }
            }
        }

        return true;
    }
}