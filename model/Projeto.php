<?php
namespace backstage\model;
/**
 * Created by PhpStorm.
 * User: juane
 * Date: 18/04/2017
 * Time: 22:23
 */
class Projeto
{
    private $pk_projeto;
    private $fk_equipe;
    private $fk_proposta;
    private $status;

    /**
     * @return mixed
     */
    public function getPkProjeto()
    {
        return $this->pk_projeto;
    }

    /**
     * @param mixed $pk_projeto
     */
    public function setPkProjeto($pk_projeto)
    {
        $this->pk_projeto = $pk_projeto;
    }

    /**
     * @return mixed
     */
    public function getFkEquipe()
    {
        return $this->fk_equipe;
    }

    /**
     * @param mixed $fk_equipe
     */
    public function setFkEquipe($fk_equipe)
    {
        $this->fk_equipe = $fk_equipe;
    }

    /**
     * @return mixed
     */
    public function getFkProposta()
    {
        return $this->fk_proposta;
    }

    /**
     * @param mixed $fk_proposta
     */
    public function setFkProposta($fk_proposta)
    {
        $this->fk_proposta = $fk_proposta;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

}