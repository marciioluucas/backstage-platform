<?php
namespace model;
/**
 * Created by PhpStorm.
 * User: juanes
 * Date: 18/04/2017
 * Time: 22:17
 */
class Equipe
{
    private $nome;
    private $pk_equipe;

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getPkEquipe()
    {
        return $this->pk_equipe;
    }

    /**
     * @param mixed $pk_equipe
     */
    public function setPkEquipe($pk_equipe)
    {
        $this->pk_equipe = $pk_equipe;
    }


}