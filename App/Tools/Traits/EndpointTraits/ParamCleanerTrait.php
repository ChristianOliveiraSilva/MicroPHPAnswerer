<?php
namespace MicroPHPAnswerer\Tools\Traits\EndpointTraits;

use MicroPHPAnswerer\Tools\Helpers\ParamCleanerHelper;

trait ParamCleanerTrait {
   

    /*
     * Verifica se um valor é valido
     * @param $Itemresponse Chave do Item a ser inserido
     * @param $response Valor Item a ser inserido
     * @return string
     */
    public function isValid(string $request, string $flag) :bool
    {
        return ParamCleanerHelper::validate($request, $flag);
    }

    /*
     * Retorna um valor da request valido
     * @param string $Itemresponse Chave do Item a ser inserido
     * @param string $response Valor Item a ser inserido
     * @param boolean $isExit Se o valor não existir, matar a request
     * @return ResponseManager
     */
    public function getSanitalizedResquest(string $request, string $flag = 'FILTER_SANITIZE_STRING', bool $isExit = true) :string
    {
        if (!isset($_REQUEST[$request])) {
            if ($isExit) {
                $this->addResponse('status', 400);
                http_response_code(400);
                exit();
            } else {
                return "";
            }
        }

        return ParamCleanerHelper::sanitalize($_REQUEST[$request], $flag);
    }

    /*
     * Retorna um valor da sanitalizado
     * @param $Itemresponse Chave do Item a ser inserido
     * @param $response Valor Item a ser inserido
     * @return ResponseManager
     */
    public function getSanitalizedValue(string $request, string $flag = 'FILTER_SANITIZE_STRING') :string
    {
        return ParamCleanerHelper::sanitalize($request, $flag);
    }


}