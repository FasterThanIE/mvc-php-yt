<?php

namespace App\Models;


use Src\Models\Model;

class User extends Model
{
    protected string $table = "users";

    protected array $fields = [
        'email', 'name', 'password'
    ];
}