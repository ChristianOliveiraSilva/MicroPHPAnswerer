<?php
namespace MicroPHPAnswerer;

use MicroPHPAnswerer\Tools\Managers\RouteManager;

/**
 * Classe responsavel por inicalizar o system padrão
 */
class Start
{
    private string $routeFile;

    function __construct(string $routeFile = "") {
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

    public function get(string $path, $response) {
        RouteManager::get($path, $response);
    }
    
    public function post(string $path, $response) {
        RouteManager::post($path, $response);
    }
    
    public function put(string $path, $response) {
        RouteManager::put($path, $response);
    }
    
    public function head(string $path, $response) {
        RouteManager::head($path, $response);
    }
    
    public function delete(string $path, $response) {
        RouteManager::delete($path, $response);
    }
    
    public function patch(string $path, $response) {
        RouteManager::patch($path, $response);
    }
    
    public function options(string $path, $response) {
        RouteManager::options($path, $response);
    }

}
