<?php

namespace Src\Routing;

use Src\Validation\CoreValidatorInterface;

class RouterRegistry {

    public function executeRoute(string $route): bool
    {
        $namespace = "App\\Controllers\\";
        $ignoredFiles = ['.', '..', 'Controller.php'];
        $controllers = scandir(directory: 'app/Controllers/');

        $filteredControllers = array_filter(array: $controllers, callback: function(string $file) use ($ignoredFiles) {
           return !in_array($file, $ignoredFiles);
        });

        foreach ($filteredControllers as $controller) {
            $controllerName = str_replace(search: '.php', replace: '', subject: $controller);
            $path = $namespace.$controllerName;

            $controller = new \ReflectionClass($path);

            foreach ($controller->getMethods() as $method) {
                $attribute = $method->getAttributes(name: Router::class);

                if(count($attribute) < 1) {
                    throw new \Exception(message: "Method $controllerName doesn't have a routing attribute.");
                }

                $arguments = $attribute[0]->getArguments();
                if($route === $arguments[0]) { // /test === /test

                    if(isset($arguments[1]) && count($arguments) >= 1) {
                        foreach ($arguments[1] as $validatorArgument) {

                            $reflectionValidator = new \ReflectionClass($validatorArgument);

                            if(!$reflectionValidator->implementsInterface(interface: CoreValidatorInterface::class)) {
                                throw new \Exception(message: "Validator must implement validator interface.");
                            }

                        }
                    }

                    return true;
                }
            }
        }

        return false;
    }

}