<?php
namespace MicroPHPAnswerer\Tools\Traits\EndpointTraits;

use MicroPHPAnswerer\Tools\Managers\JWTManager;
use MicroPHPAnswerer\Tools\Managers\ResponseManager;

trait JWTTrait {
   
    /*
     * Valida o JWT e mata caso não exista
     * @return void
     */
    private function validateJWTOrDie() :void
    {
        if (!$this->hasInSession('JWT') || !JWTManager::isValid($_SESSION['JWT'])) {
            ResponseManager::killRequest('JWT was not sent', 400);
        }
    }

    /*
     * Retorna o id do usuário
     * @return int|null
     */
    public function getIdLoggedUser() :?int
    {
        $values = $this->getValuesInJWT();
        return $values['id'] ?? null;
    }

    /*
     * Retorna o id do usuário ou morre
     * @return int|null
     */
    public function getIdLoggedUserOrDie() :?int
    {
        $values = $this->getValuesInJWT();

        if (isset($values['id'])) {
            return $values['id'];
        }

        ResponseManager::killRequest('User is not logged', 401);
    }

    /*
     * Função para criação de token e salva na sessao
     * @params array $payloadInfo array para ser mergiado com o payload
     * @params int $expiration Tempo a ser esperido o JWT
     * @return void
     */
    public function createJWTAndSetInSession(array $payloadInfo, int $expiration = 3600) :void
    {
        $this->setInSession('JWT', JWTManager::createJWT($payloadInfo, $expiration));
    }

    /*
     * Função para recuperar array do JWT
     * @params string $jwt JWT a ser validado
     * @return array
     */
    public function getValuesInJWT() :array
    {
        if ($this->hasInSession('JWT')) {
            return JWTManager::unmountJWT($_SESSION['JWT']);
        } else {
            return [];
        }
    }

}