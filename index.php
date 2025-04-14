<?php

use Dotenv\Dotenv;

require 'vendor/autoload.php';

function dd(mixed $data): never {var_dump($data); die();}

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$model = new \App\Models\User();

$model->create([
    'email' => "test@gmail.com",
    'password' => 'test@gmail.com',
    'name' => 'Toma'
]);