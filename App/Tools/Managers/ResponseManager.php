<?php
namespace MicroPHPAnswerer\Tools\Managers;

/**
 * Classe responsavel por definir uma resposta a requisição
 */
class ResponseManager
{
    /*
     * Array com as respostas
     * @var
     */
    private static $response = [];

    /*
     * Metodo resposanvel por transformar o array em string
     * No caso, a regra de negocio é json
     * @return string
     */
    public static function answer() :string
    {
        return json_encode(ResponseManager::getResponse());
    }

    /*
     * Metodo resposanvel por matar a requisição com message de erro
     * No caso, a regra de negocio é json
     * @return string
     */
    public static function killRequest(string $msg, int $code = 500) :void
    {
        ResponseManager::setResponse(['errorMsg' => $msg, 'status' => $code]);
        http_response_code($code);
        exit();
    }

    /*
     * Setter de $response
     * @param $response
     * @return void
     */
    public static function setResponse(array $response) :void
    {
        ResponseManager::$response = $response;
    }

    /*
     * Getter de ResponseManager
     * @return array
     */
    public static function getResponse() :array
    {
        if (empty(ResponseManager::$response)) {
            ResponseManager::$response = ['status' => '200'];
        }

        return ResponseManager::$response;
    }

    /*
     *  Metodo resposanvel por adicionar respostas a requisição
     * @param string $key
     * @param string | array $value
     * @return void
     */
    public static function addItem(string $key, $value) :void
    {
        ResponseManager::setResponse(array_merge(ResponseManager::getResponse(), [$key => $value]));
    }
}
