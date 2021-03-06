<?php
namespace MicroPHPAnswerer\Tools;

use MicroPHPAnswerer\Tools\Managers\EnvironmentManager;

/**
 * Classe responsavel por criar conexao com  banco de dados
 */
class Connection
{
    private $conn;

    /*
     * Construtor
     */
    function __construct()
    {
        try {
            $sgbd = EnvironmentManager::getConfiguration('sgbd');
            $host = EnvironmentManager::getConfiguration('host');
            $database = EnvironmentManager::getConfiguration('database');
            $user = EnvironmentManager::getConfiguration('user');
            $password = EnvironmentManager::getConfiguration('password');
            
            $this->connect($sgbd, $host, $database, $user, $password);
        } catch (\Exception $e) {
            echo $e->getMessage();
            http_response_code(500);
            exit();
        }
    }

    /*
     * Funcao para fazer a conexao
     * @param string $host host do banco de dados
     * @param string $user usuario do banco de dados
     * @param string $password senha do banco de dados
     * @return void
     */
    public function connect(string $sgbd, string $host, string $database, string $user, string $password) :void
    {
        $this->conn = new \PDO("$sgbd:host=$host dbname=$database user=$user password=$password");
    }

    /*
     * Funcao para fazer execução de sql
     * @param string $sql sql a ser executado
     * @param array $bind bind variables
     * @return \PDOStatement
     */
    public function execute(string $sql, array $bind = []) :\PDOStatement
    {
        try {
            $stmt = $this->conn->prepare($sql);

            if (!empty($bind))
                foreach ($bind as $key => $value)
                    $stmt->bindValue(':'.$key, $value);

            $stmt->execute();
            return $stmt;
        } catch(\PDOException $e) {
            echo $e->getMessage();
            http_response_code(500);
            exit();
        }
    }

}
