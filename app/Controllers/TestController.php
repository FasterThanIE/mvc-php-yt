<?php

namespace App\Controllers;

use App\Validators\TestValidator;
use Src\Routing\Router;

class TestController {

    #[Router('/test', [TestValidator::class])]
    public function test(): void
    {

    }
}