<?php
namespace MicroPHPAnswerer\Tools\Traits\EndpointTraits;

use MicroPHPAnswerer\Tools\Managers\EnvironmentManager;
use MicroPHPAnswerer\Tools\Managers\ResponseManager;

trait UtilsTrait {

    /*
     * Verifica se o ambiente está rodando em modo DEV
     * @return boolean isDev
     */
    private function isDev() :bool
    {
        try {
            return EnvironmentManager::getConfiguration('isDev') === 'true';
        } catch (\Exception $e) {
            return false;
        }
    }
}