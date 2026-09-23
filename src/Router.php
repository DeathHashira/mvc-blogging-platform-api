<?php

namespace Src;

/**
 * Route manager for binding handlers for
 * each path
 */
class Router
{
    public static $routes = [
        "get" => [],
        "post" => []
    ];

    static function get(string $path, callable $func): void
    {
        Router::$routes['get'][$path] = $func;
    }

    static function post(string $path, callable $func): void
    {
        Router::$routes['post'][$path] = $func;
    }

    static function getPath(): string
    {
        return parse_url($_SERVER["REQUEST_URI"])["path"];
    }

    static function getMethod(): string
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    static function run(): void
    {
        $func = Router::$routes[Router::getMethod()][Router::getPath()] ?? null;

        if (is_callable($func)) {
            $func();
        } else {
            header("HTTP/1.1 404 page not found");
        }
    }
}