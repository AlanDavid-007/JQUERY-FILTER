<?php
//Ponte do sistema com o banco de dados//
namespace App\Db;

use Exception; //Tratamento de exceções//
use \PDO; //Classe de comunicação com o banco de dados//
use PDOException; //Classe de tratamento de exceções do banco de dados//
use PDOStatement; //Classe de comunicação com métodos do banco de dados//

class Database
{
    /** 
     * Host de conexão com o banco de dados
     * @var string
     */
    const HOST = 'localhost'; //127.0.0.1(localhost)

    /** 
     * Nome do Banco de dados
     * @var string
     */
    const NAME = 'primeirocrud'; //Mesmo nome do banco de dados criado

    /** 
     * Usuário do Banco de dados
     * @var string
     */
    const USER = 'root'; //User

    /** 
     * Senha de acesso do Banco de dados
     * @var string
     */
    const PASS = ''; //Password

    /** 
     * Nome da tabela a ser manipulada
     * @var string
     */
    private $table; //Varíavel privada

    /** 
     * Instância PDO para conexão com o banco de dados
     * @var PDO
     */
    private $connection; //Varíavel privada

    /** 
     * Define a tabela e instância a conexão
     * @param string $table
     */
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }
    /** 
     * Método responsável por criar uma conexão com o banco de dados
     * @param string $table
     */
    private function setConnection()
    {
        try {
            //PDO é a classe que recebe os parametros para devolver um objeto de conexão com o banco de dados
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    /** 
     * Método responsável por executar querys no banco de dados (útil para querys de consulta)
     * @params string query
     * @param array $values [field => value]
     * @return PDOStatement
     */
    public function executar($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);

            return $statement;
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }
    /** 
     * Método responsável por inserir registros no banco
     * @param array $values [field => value]
     * @return Id inserido
     */
    /** 
     * Método responsável por inserir registros no banco
     * @param array $values [field => value]
     * @return Id inserido
     */
    public function insert($values)
    {
        // $query = 'INSERT INTO vagas (titulo, descricao, data, status) VALUES (?,?,?,?)';
        // ? = O PDO usa esse formato para validar e verificar a proteção contra SQLInjection
        // echo "<pre>"; print_r($values); echo "</pre>"; exit;

        //Dados da query
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');

        // echo "<pre>"; print_r($fields); echo "</pre>"; exit;
        // echo "<pre>"; print_r($binds); echo "</pre>"; exit;

        //Monta a query
        //implode transporma um array em uma string
        $query = 'INSERT INTO ' . $this->table . ' (' . implode(",", $fields) . ') VALUES (' . implode(",", $binds) . ')';
        // echo "<pre>"; print_r($query); echo "</pre>"; exit;
        // echo "<pre>"; print_r(array_values($values)); echo "</pre>"; exit;

        //Executa o insert
        $this->executar($query, array_values($values));

        return $this->connection->lastInsertId();
    }
    /**
    
     * Método responsável por executar uma consulta no banco de dados 
    
     *@params string $where
     *@params string $order
     *@params string $limit
     * @return PDOStatement
    
     */

    /** 
     * Método responsável por executar uma consulta no banco de dados
     * @params string $where
     * @params string $order
     * @params string $limit
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        //Dados da query
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';
        // echo "<pre>"; print_r($where); echo "</pre>"; exit;

        //Monta query
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . ' ' . $limit;
        // echo "<pre>"; print_r($query); echo "</pre>"; exit;

        return $this->executar($query);
    }

    /** 
     * Método responsável por executar exclusões no banco de dados
     * @params string $where
     * @return boolean
     */

    public function delete($where)
    {
        //Monta query
        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;
        // echo "<pre>"; print_r($where); echo "</pre>"; exit;

        //Executar query
        $this->executar($query);
        return true;
    }

    /** 
     * Método responsável por executar atualizações no banco de dados
     * @params string $where
     * @param array $values [field => value]
     * return boolean
     */

    public function update($where, $values)
    {
        //Dados da query
        $fields  = array_keys($values);
        $values  = array_values($values);

        // echo "<pre>"; print_r($values); echo "</pre>"; exit;

        //Monta query
        $query = 'UPDATE ' . $this->table . ' SET ' . implode("=?,", $fields) . '=? WHERE ' . $where;

        //Executar a query
        $this->executar($query, array_values($values));
        return true;
    }
}
