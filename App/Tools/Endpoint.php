<?php
namespace MicroPHPAnswerer\Tools;

use MicroPHPAnswerer\Tools\Connection;
use MicroPHPAnswerer\Tools\Managers\ResponseManager;
use MicroPHPAnswerer\Tools\Managers\JWTManager;
use MicroPHPAnswerer\Tools\Managers\SessionManager;
use MicroPHPAnswerer\Tools\Managers\EnvironmentManager;
use MicroPHPAnswerer\Tools\Traits\EndpointTraits\UtilsTrait;
use MicroPHPAnswerer\Tools\Traits\EndpointTraits\SessionTrait;
use MicroPHPAnswerer\Tools\Traits\EndpointTraits\ParamCleanerTrait;
use MicroPHPAnswerer\Tools\Traits\EndpointTraits\ResponseTrait;
use MicroPHPAnswerer\Tools\Traits\EndpointTraits\ConnectionTrait;
use MicroPHPAnswerer\Tools\Traits\EndpointTraits\JWTTrait;

/**
 * Classe responsavel por criar os endpoints
 */
class Endpoint
{
    use UtilsTrait;
    use SessionTrait;
    use ParamCleanerTrait;
    use ResponseTrait;
    use ConnectionTrait;
    use JWTTrait;

    /*
     * Objeto responsavel por criar a resposta da requisição
     * @var connection
     */
    private $connection;

    /*
     * Construtor
     * @param bool $validateJWT Validar o JWT da requisição
     */
    function __construct( $validateJWT = false) {
        SessionManager::initSession();
        register_shutdown_function(array($this, 'answerRequest'));

        $this->ignoreRequestMethodIfNotPost();
        if ($validateJWT)
            $this->validateJWTOrDie();

        // $this->setConnection(new Connection);
        
    }
}
