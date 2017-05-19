<?php

namespace backstage\model;

use backstage\dao\UsuarioDAO;
use backstage\dao\VotoDAO;
use backstage\util\Message;

/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 4/4/17
 * Time: 8:13 PM
 */
class Usuario
{
    private $pk_usuario;
    private $nome;
    private $matricula;
    private $login;
    private $email;
    private $ativado;
    private $senha;

    /**
     * @return mixed
     */
    public function getPkUsuario()
    {
        return $this->pk_usuario;
    }

    /**
     * @param mixed $pk_usuario
     */
    public function setPkUsuario($pk_usuario)
    {
        $this->pk_usuario = $pk_usuario;
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
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * @param mixed $matricula
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

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


    public function cadastrar()
    {

        if (empty($this->getNome())) {
            $msg = new Message("Nome deve ser preenchido", "erro", ["icone" => "error"]);
            return $msg->geraJsonMensagem();
        }

        if (empty($this->getEmail())) {
            $msg = new Message("Email deve ser preenchido", "erro", ["icone" => "error"]);
            return $msg->geraJsonMensagem();
        }

        if (empty($this->getSenha())) {
            $msg = new Message("Senha deve ser preenchida", "erro", ["icone" => "error"]);
            return $msg->geraJsonMensagem();
        }

        if (empty($this->getLogin())) {
            $msg = new Message("Login deve ser preenchida", "erro", ["icone" => "error"]);
            return $msg->geraJsonMensagem();
        }
        if (empty($this->getMatricula())) {
            $msg = new Message("Matricula deve ser preenchida", "erro", ["icone" => "error"]);
            return $msg->geraJsonMensagem();
        }

        $dao = new UsuarioDAO($this);

        if (count($dao->retreaveCondicaoLoginExistenteCadastrar()) != 0) {
            $msg = new Message("Login já utilizado, tente utilizar outro.", "erro", ["icone" => "error"]);
            return $msg->geraJsonMensagem();
        }
        $dao2 = new UsuarioDAO($this);
        if (count($dao2->retreaveCondicaoEmailExistenteCadastrar()) > 0) {

            $msg = new Message("Email já utilizado, tente utilizar outro.", "erro", ["icone" => "error"]);
            return $msg->geraJsonMensagem();
        }
        if($dao->create()){
        $r = new Message(
            "Usuario cadastrado com sucesso",
            "sucesso",
            ["icone" => "check"]
        );
        return $r->geraJsonMensagem();
    }
        else{

            $r = new Message(
                "Erro ao criar Usuario",
                "erro",
                ["icone" => "error"]
            );
            return $r->geraJsonMensagem();

    }
    }

    public function atualizar()
    {

        if (empty($this->getNome())) {
            $msg = new Message("Nome deve ser preenchido", "erro", ["icone" => "error"]);
            return $msg->geraJsonMensagem();
        }

        if (empty($this->getEmail())) {
            $msg = new Message("Email deve ser preenchido", "erro", ["icone" => "error"]);
            return $msg->geraJsonMensagem();
        }

        if (empty($this->getSenha())) {
            $msg = new Message("Senha deve ser preenchida", "erro", ["icone" => "error"]);
            return $msg->geraJsonMensagem();
        }

        if (empty($this->getLogin())) {
            $msg = new Message("Login deve ser preenchida", "erro", ["icone" => "error"]);
            return $msg->geraJsonMensagem();
        }
        if (empty($this->getMatricula())) {
            $msg = new Message("Matricula deve ser preenchida", "erro", ["icone" => "error"]);
            return $msg->geraJsonMensagem();
        }
//
        $dao = new UsuarioDAO($this);
        if (count($dao->retreaveCondicaoLoginExistenteAlterar()) > 0) {
            $msg = new Message("Login já utilizado, tente utilizar outro.", "erro", ["icone" => "error"]);
            return $msg->geraJsonMensagem();
        }
        $dao2 = new UsuarioDAO($this);
        if (count($dao2->retreaveCondicaoEmailExistenteAlterar()) > 0) {

            $msg = new Message("Email já utilizado, tente utilizar outro.", "erro", ["icone" => "error"]);
            return $msg->geraJsonMensagem();
        }
        if($dao->update()){
        $r = new Message(
            "Usuario alterado com sucesso",
            "sucesso",
            ["icone" => "check"]
        );
        return $r->geraJsonMensagem();}
        else{
            $r = new Message(
                "Erro ao Alterar Usuario",
                "erro",
                ["icone" => "error"]
            );
            return $r->geraJsonMensagem();
        }
    }

    public function retreave()
    {
        $dao = new UsuarioDAO($this);
        return $dao->retreave();
    }

    public function delete()
    {
        $this->ativado = 0;
        $dao = new UsuarioDAO($this);
        $rSuccess = new Message(
            "Usuario excluido com sucesso",
            "sucesso",
            ["icone" => "check"]
        );
        $rFailure = new Message(
            "Ocorreu um erro ao tentar excluir o usuário",
            "erro",
            ["icone" => "error"]
        );
        $return = $rFailure;
        if ($dao->update()) {
            $return = $rSuccess;
        }
        return $return->geraJsonMensagem();

    }

    public function logar()
    {
        $dao = new UsuarioDAO($this);
        if ($dao->logar()) {
            return json_encode(["isPermitido" => true]);
        }
        return json_encode(["isPermitido" => false]);
    }
}