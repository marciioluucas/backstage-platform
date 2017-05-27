<?php
/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 4/25/17
 * Time: 8:47 PM
 */

namespace backstage\model;

use backstage\util\Message;
use dao\MembroDAO;

class Membro
{
    private $pk_membro;
    private $atuacao;
    private $fk_equipe;
    private $funcao;
    private $fk_usuario;
    private $is_ocupado;
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
    public function getPkMembro()
    {
        return $this->pk_membro;
    }

    /**
     * @param mixed $pk_membro
     */
    public function setPkMembro($pk_membro)
    {
        $this->pk_membro = $pk_membro;
    }

    /**
     * @return mixed
     */
    public function getAtuacao()
    {
        return $this->atuacao;
    }

    /**
     * @param mixed $atuacao
     */
    public function setAtuacao($atuacao)
    {
        $this->atuacao = $atuacao;
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
    public function getFuncao()
    {
        return $this->funcao;
    }

    /**
     * @param mixed $funcao
     */
    public function setFuncao($funcao)
    {
        $this->funcao = $funcao;
    }

    /**
     * @return mixed
     */
    public function getFkUsuario()
    {
        return $this->fk_usuario;
    }

    /**
     * @param mixed $fk_usuario
     */
    public function setFkUsuario($fk_usuario)
    {
        $this->fk_usuario = $fk_usuario;
    }

    /**
     * @return mixed
     */
    public function getIsOcupado()
    {
        return $this->is_ocupado;
    }

    /**
     * @param mixed $is_ocupado
     */
    public function setIsOcupado($is_ocupado)
    {
        $this->is_ocupado = $is_ocupado;
    }

    //métodos do controller

    public function cadastrar()
    {

        if(empty($this->getAtuacao())){
            $msg = new Message("Defina uma atuação para o membro!", "erro", ["icone" => "clear"]);
            return $msg->geraJsonMensagem();
        }

        if(empty($this->getFuncao())){
            $msg = new Message("Defina uma Função para o membro!", "erro", ["icone" => "clear"]);
            return $msg->geraJsonMensagem();
        }

        $dao = new MembroDAO(($this));
        if ($dao->create()){
            $r = new Message("Membro Alterado com sucesso!", "Sucesso", ["icone" => "check"]);
            return $r->geraJsonMensagem();
        }
        else{
            $r = new Message("Erro inesperado ao alterar Membro", "erro",["icone" => "error"]);
            return $r->geraJsonMensagem();
        }
    }

    public function atualizar()
    {
        if(empty($this->getAtuacao())){
            $msg = new Message("Defina uma atuação para o membro!", "erro", ["icone" => "clear"]);
            return $msg->geraJsonMensagem();
        }

        if(empty($this->getFuncao())){
            $msg = new Message("Defina uma Função para o membro!", "erro", ["icone" => "clear"]);
            return $msg->geraJsonMensagem();
        }

        $dao = new MembroDAO(($this));
        if ($dao->update()){
            $r = new Message("Membro Alterado com sucesso!", "Sucesso", ["icone" => "check"]);
            return $r->geraJsonMensagem();}
        else{
            $r = new Message("Erro inesperado ao alterar Membro", "erro",["icone" => "error"]);
            return $r->geraJsonMensagem();
        }
    }

    public function retreaveAll()
    {
        $dao = new MembroDAO(($this));
        return $dao->retreave();

    }

    public function delete()
    {
        $this->ativado = 0;
        $dao = new MembroDAO($this);
        return $dao->update();
    }
}