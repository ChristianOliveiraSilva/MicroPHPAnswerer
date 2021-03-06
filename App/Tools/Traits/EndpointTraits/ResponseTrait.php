<?php
namespace MicroPHPAnswerer\Tools\Traits\EndpointTraits;

use MicroPHPAnswerer\Tools\Managers\ResponseManager;

trait ResponseTrait {
 
    /*
     * Adicionar Resposta a requisição
     * @param $key Chave do Item a ser inserido
     * @param $value Valor Item a ser inserido
     * @return void
     */
    public function addResponse(string $key, $value) :void
    {
        ResponseManager::addItem($key, $value);
    }

    /*
     * Ser executado no final da executação como Resposta a requisição
     * @return void
     */
    public function answerRequest() :void
    {
        header("Content-type: application/json");
        echo ResponseManager::answer();
    }

}