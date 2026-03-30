<?php

class Router
{
    private array $routes = [];

    public function add(string $method, string $path, array $handler): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH);
        $method = strtoupper($method);

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                [$controllerClass, $action] = $route['handler'];

                if (class_exists($controllerClass)) {
                    $controller = new $controllerClass();
                    if (method_exists($controller, $action)) {
                        $controller->$action();
                        return;
                    }
                }
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}