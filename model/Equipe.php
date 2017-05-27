<?php
namespace backstage\model;

use backstage\dao\EquipeDAO;
use backstage\util\Message;
use backstage\model\Proposta;

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


    public function cadastrar()
    {

        if (empty($this->nome)) {
            $msg = new Message("Defina um nome para a equipe!", "error", ["icone" => "clear"]);
            $msg->geraJsonMensagem();
        }

        $dao = new EquipeDAO(($this));
        if (count($dao->retreaveCondicaoCadastrar("nome", $this->nome)) > 0) {
            $msg = new Message("Nome de equipe já existente, tente outro.", "error", ["icone" => "clear"]);
            $msg->geraJsonMensagem();
        }


        $dao = new EquipeDAO(($this));
        if ($dao->create()){
            $r = new Message("Equipe cadastrada com sucesso para o Projeto!", "Sucesso", ["icone" => "check"]);

            $proposta = new Proposta();
            $proposta->aprovar();

            return $r->geraJsonMensagem();
        }
        else{
            $r = new Message("Erro inesperado ao alterar Equipe", "erro",["icone" => "error"]);
            return $r->geraJsonMensagem();
        }
    }

    public function atualizar()
    {
        if (empty($this->nome)) {
            $msg = new Message("Defina um nome para a equipe!", "error", ["icone" => "clear"]);
            $msg->geraJsonMensagem();
        }

        $dao = new EquipeDAO(($this));
        if (count($dao->retreaveCondicaoCadastrar("nome", $this->nome)) > 0) {
            $msg = new Message("Nome de equipe já existente, tente outro.", "error", ["icone" => "clear"]);
            $msg->geraJsonMensagem();
        }


        $dao = new EquipeDAO(($this));
        if ($dao->update()){
            $r = new Message("Projeto alterado com sucesso!", "Sucesso", ["icone" => "check"]);
            return $r->geraJsonMensagem();}
        else{
            $r = new Message("Erro inesperado ao alterado Projeto", "erro",["icone" => "error"]);
            return $r->geraJsonMensagem();
        }
    }

    public function retreave()
    {
        $dao = new EquipeDAO(($this));
        return $dao->retreave();
    }

    public function delete()
    {
        $this->ativado = 0;
        $dao = new EquipeDAO($this);
        return $dao->update();
    }

}