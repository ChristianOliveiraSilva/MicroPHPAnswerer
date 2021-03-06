<?php
namespace MicroPHPAnswerer\Tools\Traits\EndpointTraits;

use MicroPHPAnswerer\Tools\Managers\EnvironmentManager;

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

    /*
     * Mata a execução se não for POST
     * @param $paramCleaner
     * @return void
     */
    private function ignoreRequestMethodIfNotPost() :void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' && !$this->isDev()) {
            echo json_encode(['alert' => 'REQUEST METHOD is not POST']);
            exit();
        }
    }
}