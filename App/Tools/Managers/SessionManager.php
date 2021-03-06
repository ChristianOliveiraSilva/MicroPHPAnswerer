<?php
namespace MicroPHPAnswerer\Tools\Managers;

/**
 * Classe responsavel por manipular a sessao
 */
class SessionManager
{

    /*
     * Inicia a sessão
     * @param string $key Chave da Sessão
     * @return bool
     */
    public static function initSession() :void
    {
        if (empty(session_id()))
            session_start();
    }

    /*
     * Verifica se existe na requisição
     * @param string $key Chave da Sessão
     * @return bool
     */
    public static function has(string $key) :bool
    {
        return isset($_SESSION[$key]);
    }

    /*
     * Pega o valor na Sessão
     * @param string $key Chave da Sessão
     * @return string
     */
    public static function get(string $key) :string
    {
        return $_SESSION[$key] ?? '';
    }

    /*
     * Seta o valor na sessão
     * @param string $key Chave da Sessão
     * @param string $value Valor da Sessão
     * @return void
     */
    public static function set(string $key, string $value) :void
    {
        $_SESSION[$key] = $value;
    }

    /*
     * Destroi um valor na sessão
     * @param string $key Chave da Sessão
     * @return void
     */
    public static function destroy(string $key) :void
    {
        unset($_SESSION[$key]);
    }

    /*
     * Destroi todos os valores na sessão
     * @return void
     */
    public static function destroyAll() :void
    {
        session_unset();
        session_destroy();
    }

}
