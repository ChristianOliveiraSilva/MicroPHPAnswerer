<?php
namespace MicroPHPAnswerer\Tools\Helpers;

/**
 * Classe responsavel por tratar os parametros da requisição
 */
class ParamCleanerHelper
{
    /*
     * Função que valida os dados
     * @param string $request
     * @param string $flag
     * @return bool
     */
    public static function validate(string $request, string $flag) :bool
    {
        return empty(trim($request));
    }

    /*
     * Função que limpa os dados
     * @param $request
     * @param $flag
     * @return string
     */
    public static function sanitalize(string $request, string $flag = 'FILTER_SANITIZE_STRING') :string
    {
        return $request;
    }
}
