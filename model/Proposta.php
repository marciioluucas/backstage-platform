<?php
namespace backstage\model;

use backstage\dao\PropostaDAO;
use backstage\dao\VotoDAO;
use backstage\util\Message;

/**
 * Created by PhpStorm.
 * User: juane
 * Date: 18/04/2017
 * Time: 22:21
 */
class Proposta
{

    /**
     * Variável do id da proposta.
     * @var
     */
    private $pk_proposta;
    /**
     * Fk do id do Usuário que submeteu a proposta.
     * @var
     */
    private $fk_usuario;
    /**
     * Variável que armazena o nome/título da proposta submetida.
     * @var
     */
    private $titulo;
    /**
     * Variável que armazena a descrição detalhada da proposta submetida.
     * @var
     */
    private $descricao;
    /**
     * Variável que armazena a data de submissão da proposta.
     * @var
     */
    private $data;
    /**
     * Variável que armazena o balanço de votos positivos/negativos recebidos pela proposta submetida.
     * @var
     */

    private $fk_equipe;

    private $aprovado;

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
    public function getAprovado()
    {
        return $this->aprovado;
    }

    /**
     * @param mixed $aprovado
     */
    public function setAprovado($aprovado)
    {
        $this->aprovado = $aprovado;
    }


    /**
     * @return mixed
     */
    public function getPkProposta()
    {
        return $this->pk_proposta;
    }

    /**
     * @return mixed
     */


    /**
     * @param mixed $pk_proposta
     */
    public function setPkProposta($pk_proposta)
    {
        $this->pk_proposta = $pk_proposta;
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
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }


    //métodos controller

    public function cadastrar()
    {


        if (empty($this->getTitulo())) {
            $msg = new Message("Preencha um Título para sua proposta!", "erro", ["icone" => "clean"]);
            return $msg->geraJsonMensagem();
        }

        if (empty($this->getDescricao())) {
            $msg = new Message("Defina uma descrição explicativa da sua proposta!", "erro", ["icone" => "clean"]);
            return $msg->geraJsonMensagem();
        }

        $dao = new PropostaDAO(($this));

        if (count($dao->retreaveCondicaoCadastrar("titulo", $this->titulo)) > 0) {
            $msg = new Message("Titulo de proposta já usado, Tente utilzar outro.", "erro", ["icone" => "clean"]);
            return $msg->geraJsonMensagem();
        }


        $dao = new PropostaDAO(($this));

        if ($dao->create()) {
            $r = new Message("Proposta Criada com sucesso!", "Sucesso", ["icone" => "check"]);
            return $r->geraJsonMensagem();
        } else {
            $r = new Message("Erro inesperado ao alterar Proposta", "erro", ["icone" => "error"]);
            return $r->geraJsonMensagem();
        }
    }

    public function atualizar()
    {

        if (empty($this->getTitulo())) {
            $msg = new Message("Preencha um Título para sua proposta!", "erro", ["icone" => "clean"]);
            return $msg->geraJsonMensagem();
        }

        if (empty($this->getDescricao())) {
            $msg = new Message("Defina uma descrição explicativa da sua proposta!", "erro", ["icone" => "clean"]);
            return $msg->geraJsonMensagem();
        }

        $dao = new PropostaDAO(($this));

        if (count($dao->retreaveCondicaoCadastrar("titulo", $this->titulo)) > 0) {
            $msg = new Message("Titulo de proposta já usado, Tente utilzar outro.", "erro", ["icone" => "clean"]);
            return $msg->geraJsonMensagem();
        }


        $dao = new PropostaDAO(($this));
        if ($dao->update()) {
            $r = new Message("Projeto Alterado com sucesso!", "Sucesso", ["icone" => "check"]);
            return $r->geraJsonMensagem();
        } else {
            $r = new Message("Erro inesperado ao alterar Projeto", "erro", ["icone" => "error"]);
            return $r->geraJsonMensagem();
        }
    }

    public function retreaveAll()
    {
        $dao = new PropostaDAO(($this));
        return $dao->retreave();
    }

    public function delete()
    {
        $this->ativado = 0;
        $dao = new PropostaDAO($this);
        return $dao->delete();
    }

    public function retreavePorData()
    {

        $dao = new PropostaDAO(($this));
        return $dao->retreavePorData();
    }

    public function retreavePorUsuario(){
        $dao = new PropostaDAO(($this));
        return $dao->retreavePorUsuario();
    }

    public function retreavePorTitulo(){
        $dao = new PropostaDAO(($this));
        return $dao->retreavePorTitulo();
    }

    public function contaVoto()
    {
        $dao = new Voto($this->fk_usuario, $this->pk_proposta);
        return $dao->contar();
    }

    public function listarPorVoto(){
        $dao = new PropostaDAO(($this));
        return $dao->listarPorVoto();
    }

    public function aprovar(){
        $this->setAprovado("'1'");
        $dao = new PropostaDAO(($this));
        $rSuccess = new Message(
            "Projeto iniciado com sucesso!",
            "sucesso",
            ["icone" => "check"]
        );
        $rFailure = new Message(
            "Ocorreu um erro ao tentar Aprovar projeto..",
            "erro",
            ["icone" => "error"]
        );
        $return = $rFailure;
        if ($dao->update()) {
            $return = $rSuccess;

        }
        return $return->geraJsonMensagem();

    }



}