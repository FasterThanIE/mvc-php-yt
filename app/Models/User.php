<?php

namespace App\Models;


use Src\Models\Model;
use Src\Validation\ShouldValidate;

class User extends Model
{

    use ShouldValidate;

    protected string $table = "users";

    protected array $fields = [
        'email', 'name', 'password'
    ];

    protected array $validationRules = [
        'email' => ['email'],
        'name' => [],
        'password' => ['min:5', 'max:50'],
    ];
}