<?php
namespace MicroPHPAnswerer\Tools\Traits\EndpointTraits;

use MicroPHPAnswerer\Tools\Connection;

trait ConnectionTrait {
    
    /*
     * Setter de Connection
     * @param $connection
     * @return void
     */
    public function setConnection(Connection $connection) :void
    {
        $this->connection = $connection;
    }

    /*
     * Getter de Connection
     * @return Connection
     */
    public function getConnection() :Connection
    {
        return $this->connection;
    }

    /*
     * Executar sql
     * @return PDOStatement
     */
    public function execute(string $sql, array $bind = []) :\PDOStatement
    {
        return $this->getConnection()->execute($sql, $bind);
    }

}