<?php
namespace MicroPHPAnswerer\Tools\Managers;

/**
 * Classe responsavel por Criar e Manipular as variaveis de ambiente
 */
class RouteManager
{
    static public array $routes;

    static public function get(string $path, string $class) {
        RouteManager::addRoute([
            'path' => $path,
            'class' => $class,
            'method' => 'get',
        ]);
    }
    
    static public function post(string $path, string $class) {
        RouteManager::addRoute([
            'path' => $path,
            'class' => $class,
            'method' => 'post',
        ]);
    }
    
    static public function put(string $path, string $class) {
        RouteManager::addRoute([
            'path' => $path,
            'class' => $class,
            'method' => 'put',
        ]);
    }
    
    static public function head(string $path, string $class) {
        RouteManager::addRoute([
            'path' => $path,
            'class' => $class,
            'method' => 'head',
        ]);
    }
    
    static public function delete(string $path, string $class) {
        RouteManager::addRoute([
            'path' => $path,
            'class' => $class,
            'method' => 'delete',
        ]);
    }
    
    static public function patch(string $path, string $class) {
        RouteManager::addRoute([
            'path' => $path,
            'class' => $class,
            'method' => 'patch',
        ]);
    }
    
    static public function options(string $path, string $class) {
        RouteManager::addRoute([
            'path' => $path,
            'class' => $class,
            'method' => 'options',
        ]);
    }
    
    static private function addRoute(array $newRoute): void {
        RouteManager::$routes = [...RouteManager::$routes, $newRoute];
    }

    static public function run() {
        $routes = RouteManager::$routes;
        $path = $_SERVER['PATH_INFO'];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($routes as $route) {
            if ($path == $route['path'] && $method == $route['method']) {
                new $route['class'];
                break;
            }
        }
    }

}