<?php

namespace config;

use Response\ResponseFactory;


class Router
{
    private static array $routes = [];

    public static function addRoute(string $route, string $handler, string $method): void
    {
        self::$routes[$route] = [$handler, $method];
    }

    public static function handleRequest(string $requestUri, array $request): void
    {
        $handler = self::$routes[$requestUri] ?? null;
        if ($handler) {
            $responseFactory = new ResponseFactory();

            (new $handler[0]($responseFactory))->{$handler[1]}($request);
        } else {
            header('HTTP/1.0 404 Not Found');
            echo json_encode(['error' => '404 Not Found']);
        }
    }

}