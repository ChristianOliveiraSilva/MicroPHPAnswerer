<?php
namespace MicroPHPAnswerer\Tools;

/**
 * Classe responsavel por criar conexao com  banco de dados
 */
class Connection
{
    private $conn;

    /*
     * Construtor
     */
    function __construct(string $host, string $database, string $user, string $password)
    {
        $this->connect($host, $database, $user, $password);
    }

    /*
     * Funcao para fazer a conexao
     * @param string $host host do banco de dados
     * @param string $user usuario do banco de dados
     * @param string $password senha do banco de dados
     * @return ParamCleaner
     */
    public function connect(string $host, string $database, string $user, string $password) :void
    {
        try {
            $this->conn = new \PDO("pgsql:host=$host dbname=$database user=$user password=$password");
        } catch (\PDOException $e) {
            echo $e->getMessage();
            http_response_code(500);
            exit();
        }
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
