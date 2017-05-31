<?php
namespace backstage\model;


use backstage\dao\PropostaDAO;
use backstage\util\Message;

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
    private $ativado;

    /**
     * @return mixed
     */
    public function getAtivado()
    {
        return $this->ativado;
    }

    /**
     * @param mixed $ativado
     */
    public function setAtivado($ativado)
    {
        $this->ativado = $ativado;
    }
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

    //métodos do controller

    public function cadastrar(){
        $dao = new PropostaDAO(($this));
        if ($dao->create()){
            $r = new Message("Projeto cadastrado com sucesso!", "Sucesso", ["icone" => "check"]);
            return $r->geraJsonMensagem();}
        else{
            $r = new Message("Erro inesperado ao cadastrar Projeto", "erro",["icone" => "error"]);
            return $r->geraJsonMensagem();
        }

    }

    public function atualizar(){
        $dao = new PropostaDAO(($this));
        if ($dao->update()){
            $r = new Message("Projeto Alterado com sucesso!", "Sucesso", ["icone" => "check"]);
            return $r->geraJsonMensagem();}
        else{
            $r = new Message("Erro inesperado ao alterar Projeto", "erro",["icone" => "error"]);
            return $r->geraJsonMensagem();
        }
    }

    public function retreaveAll(){
        $dao = new PropostaDAO(($this));
        return $dao->retreave();
    }

    public function listaAprovados(){
        $dao = new PropostaDAO(($this));
        return $dao->retreaveCondicaoCadastrar('ativado', "1");
    }

    public function delete()
    {
        $this->ativado = 0;
        $dao = new PropostaDAO($this);
        return $dao->update();
    }

}