<?php
namespace MicroPHPAnswerer\Tools\Traits\EndpointTraits;

use MicroPHPAnswerer\Tools\Managers\JWTManager;

trait JWTTrait {
   
    /*
     * Valida o JWT e mata caso não exista
     * @return void
     */
    private function validateJWTOrDie() :void
    {
        if ($this->hasInSession('JWT') && JWTManager::isValid($_SESSION['JWT'])) {
            echo json_encode(['alert' => 'JWT was not sent']);
            exit();
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

        $this->addResponse('Error', 'User is not logged');
        $this->addResponse('status', 403);
        http_response_code(403);
        exit();
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