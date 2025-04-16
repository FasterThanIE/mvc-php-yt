<?php

use Dotenv\Dotenv;

require 'vendor/autoload.php';

function dd(mixed $data): never {var_dump($data); die();}

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$r = new \App\Models\User();

$r->create([
    'name' => 'a',
    'email' => 'b@b.com',
    'password' => 'qweqwe',
]);

