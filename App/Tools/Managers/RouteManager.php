<?php
namespace MicroPHPAnswerer\Tools\Managers;

use MicroPHPAnswerer\Tools\Exceptions\ResponseNotValidException;

/**
 * Classe responsavel por Criar e Manipular as variaveis de ambiente
 */
class RouteManager
{
    static private array $routes = [];
    static private array $responseHTTPcode = [
        '404' => function() {
            echo '404';
        },
        '500' => function() {
            echo '500';
        }
    ];

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
    
    static public function registerResponseHTTPcode(string $code, $response) {
        self::$responseHTTPcode = [
            ...self::$responseHTTPcode, 
            $code => $response
        ];
    }
    
    static private function addRoute(array $newRoute): void {
        self::$routes = [...self::$routes, $newRoute];
    }

    static public function run() {
        $routes = self::$routes;
        $path = $_SERVER['PATH_INFO'] ?? '/';
        $method = strtolower($_SERVER['REQUEST_METHOD']) ?? 'get';
        $findRoute = false;
        $hasError = false;

        foreach ($routes as $route) {
            if ($path === $route['path'] && $method === $route['method']) {
                try {
                    self::takeAction($route['response']);
                } catch (\Throwable $th) {
                    $hasError = true;
                }

                $findRoute = true;
                break;
            }
        }

        if ($findRoute === false) {
            self::takeAction(self::$responseHTTPcode['404']);
        }

        if ($hasError === true) {
            self::takeAction(self::$responseHTTPcode['500']);
        }
    }

    static private function takeAction($action) {
        switch (gettype($action)) {
            case 'string':
                $responseClass = new $action;
                $responseClass();
                break;
            case 'array':
                $func = $action[1];
                $responseClass = new $action[0];
                $responseClass->$func();
                break;
            case 'object':
                $func = $action;
                $func();
                break;
            default:
                throw new ResponseNotValidException("The response is not valid", 1);
                break;
        }
    }

}