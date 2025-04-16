<?php

use Dotenv\Dotenv;
use Src\Routing\RouterRegistry;

require 'vendor/autoload.php';

function dd(mixed $data): never {var_dump($data); die();}

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$routeRegistry = new RouterRegistry();
$routeResponse = $routeRegistry->executeRoute(route: '/test');

if(!$routeResponse) {
    throw new Exception(message: "Route not found");
}