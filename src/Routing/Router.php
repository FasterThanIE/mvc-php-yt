<?php

namespace Src\Routing;

#[\Attribute]
class Router {

    public function __construct(
        private readonly string $route,
        private readonly ?array $validators,
    ) {}
}
