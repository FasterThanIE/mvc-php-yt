<?php

namespace Src\Models\Traits;

trait CheckFillableFields
{
    protected function checkFillableFields(
        array $fields, array $fillableFields
    ): bool
    {
        foreach ($fields as $field) {
            if (!in_array($field, $fillableFields)) {
                return false;
            }
        }
        return true;
    }
}