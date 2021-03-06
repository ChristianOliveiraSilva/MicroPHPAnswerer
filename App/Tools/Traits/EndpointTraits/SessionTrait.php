<?php
namespace MicroPHPAnswerer\Tools\Traits\EndpointTraits;

use MicroPHPAnswerer\Tools\Managers\SessionManager;

trait SessionTrait {
   
    /*
     * Verifica se existe na sessao
     * @param string $key Chave da Sessão
     * @return bool
     */
    public function hasInSession(string $key) :bool
    {
        return SessionManager::has($key);
    }

    /*
     * Pega o valor na Sessão
     * @param string $key Chave da Sessão
     * @return string
     */
    public function getInSession(string $key) :string
    {
        return SessionManager::get($key);
    }

    /*
     * Seta o valor na sessão
     * @param string $key Chave da Sessão
     * @return void
     */
    public function setInSession(string $key, string $value) :void
    {
        SessionManager::set($key, $value);
    }

    /*
     * Destroi um valor na sessão
     * @param string $key Chave da Sessão
     * @return void
     */
    public function destroyInSession(string $key) :void
    {
        SessionManager::destroy($key);
    }

    /*
     * Destroi todos os valores na sessão
     * @return void
     */
    public function destroyAllSession() :void
    {
        SessionManager::destroyAll();
    }

}