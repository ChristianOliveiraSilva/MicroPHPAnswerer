<?php
namespace MicroPHPAnswerer;

use MicroPHPAnswerer\Tools\Managers\RouteManager;

/**
 * Classe responsavel por inicalizar o system padrão
 */
class Start
{
    private string $routeFile;

    function __construct(string $routeFile) {
        $this->routeFile = $routeFile;
        $this->mountRoutes();
    }

    private function mountRoutes(): void {
        if ($this->routeFile) {
            require_once $this->routeFile;
        }
    }

    public function run(): void {
        RouteManager::run();
    }

    public function get(string $path, string $class) {
        RouteManager::get($path, $class);
    }
    
    public function post(string $path, string $class) {
        RouteManager::post($path, $class);
    }
    
    public function put(string $path, string $class) {
        RouteManager::put($path, $class);
    }
    
    public function head(string $path, string $class) {
        RouteManager::head($path, $class);
    }
    
    public function delete(string $path, string $class) {
        RouteManager::delete($path, $class);
    }
    
    public function patch(string $path, string $class) {
        RouteManager::patch($path, $class);
    }
    
    public function options(string $path, string $class) {
        RouteManager::options($path, $class);
    }

}
