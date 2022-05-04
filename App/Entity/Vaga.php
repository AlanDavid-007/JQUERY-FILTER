<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Vaga
{
    /** 
     * Identificador único da vaga
     * @var integer
     */
    public $id;

    /** 
     * Título da vaga
     * @var string
     */
    public $titulo;

    /** 
     * Descrição da vaga (pode conter html)
     * @var string
     */
    public $descricao;

    /** 
     * Define se a vaga está ativa (s or n)
     * @var string
     */
    public $status;

    /** 
     * Data da publicação da vaga
     * @var timestamp
     */
    public $data;

    /** 
     * Função para cadastrar a vaga no banco
     * @var boolean
     */

    public function cadastrar()
    {
        //Definir data
        $this->data = date('Y-m-d H:i:s');
        // echo "<pre>"; print_r($this); echo "</pre>"; exit;

        //Inserir a vaga no banco e retornar o ID
        $objDatabase = new Database('vagas');
        $this->id = $objDatabase->insert([
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'status' => $this->status,
            'data' => $this->data
        ]);
        //echo "<pre>"; print_r($this); echo "</pre>"; exit;

        //Retornar sucesso
        return true;
    }

    /**
     * Método responsável por obter as vagas do banco de dados

     *@params string $where 
     *@params string $order
     *@params string $limit 
     *@return array
     */

    public static function getVagas($where = null, $order = null, $limit = null)
    {
        $objDatabase = new Database('vagas');

        return  ($objDatabase)->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);


        // echo "<pre>"; print_r($result); echo "</pre>"; exit;

    
    }

    /**
     * Método responsável por obter as vagas do banco de dados

     *@params int $id
     *@return Vaga
     */

    public static function getVaga($id)
    {

        $objDatabase = new Database('vagas');

        return ($objDatabase)->select('id = ' . $id)->fetchObject(self::class);
    }

    /**
     * Função para excluir vagas no banco
     *@return boolean
     */

    public function excluir()
    {
        $objDatabase = new Database('vagas');

        return ($objDatabase)->delete('id =' . $this->id);
    }

    /** 
     * Função para atualizar a vaga no banco 
     * @return boolean
     */
    public function atualizar()
    {
        //Definir a data
        $this->data = date('Y-m-d H:i:s');

        $objDatabase = new Database('vagas');

        return ($objDatabase)->update('id = ' . $this->id, [
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'status' => $this->status,
            'data' => $this->data
        ]);
    }
}
