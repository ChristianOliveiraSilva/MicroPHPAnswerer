<?php
namespace MicroPHPAnswerer\Tools\Managers;

use MicroPHPAnswerer\Tools\Exceptions\ResponseNotValidException;

/**
 * Classe responsavel por Criar e Manipular as variaveis de ambiente
 */
class RouteManager
{
    static private array $routes = [];

    static public function get(string $path, $response) {
        self::addRoute([
            'path' => $path,
            'response' => $response,
            'method' => 'get',
        ]);
    }
    
    static public function post(string $path, $response) {
        self::addRoute([
            'path' => $path,
            'response' => $response,
            'method' => 'post',
        ]);
    }
    
    static public function put(string $path, $response) {
        self::addRoute([
            'path' => $path,
            'response' => $response,
            'method' => 'put',
        ]);
    }
    
    static public function head(string $path, $response) {
        self::addRoute([
            'path' => $path,
            'response' => $response,
            'method' => 'head',
        ]);
    }
    
    static public function delete(string $path, $response) {
        self::addRoute([
            'path' => $path,
            'response' => $response,
            'method' => 'delete',
        ]);
    }
    
    static public function patch(string $path, $response) {
        self::addRoute([
            'path' => $path,
            'response' => $response,
            'method' => 'patch',
        ]);
    }
    
    static public function options(string $path, $response) {
        self::addRoute([
            'path' => $path,
            'response' => $response,
            'method' => 'options',
        ]);
    }
    
    static private function addRoute(array $newRoute): void {
        self::$routes = [...self::$routes, $newRoute];
    }

    static public function run() {
        $routes = self::$routes;
        $path = $_SERVER['PATH_INFO'] ?? '/';
        $method = strtolower($_SERVER['REQUEST_METHOD']) ?? 'get';
        $findRoute = false;

        foreach ($routes as $route) {
            if ($path === $route['path'] && $method === $route['method']) {

                switch (gettype($route['response'])) {
                    case 'string':
                        $responseClass = new $route['response'];
                        $responseClass();
                        break;
                    case 'array':
                        $func = $route['response'][1];
                        $responseClass = new $route['response'][0];
                        $responseClass->$func();
                        break;
                    case 'object':
                        $func = $route['response'];
                        $func();
                        break;
                    default:
                        throw new ResponseNotValidException("The response is not valid", 1);
                        break;
                }

                $findRoute = true;
                break;
            }
        }

        if ($findRoute === false) {
            http_response_code(404);
        }
    }

}