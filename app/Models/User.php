<?php

namespace App\Models;


use Src\Models\Model;

class User extends Model
{
    protected string $table = "users";

    protected array $fields = [
        'email', 'name', 'password'
    ];

    protected $validationRules = [
        'email' => ['email'],
        'name' => [],
        'password' => ['min:5', 'max:50'],
    ];
}