<?php

namespace backstage\model;

use backstage\dao\UsuarioDAO;
use backstage\util\JWTWrapper;
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
    private $email;
    private $ativado;
    private $senha;
    private $nivel;


    /**
     * @return mixed
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * @param mixed $nivel
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
    }

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

        $dao = new UsuarioDAO($this);

        if (count($dao->retreaveCondicaoMatriculaExistenteCadastrar()) != 0) {
            $msg = new Message("Matrícula já utilizada, tente utilizar outra.", "erro", ["icone" => "error"]);
            return $msg->geraJsonMensagem();
        }
        $dao2 = new UsuarioDAO($this);
        if (count($dao2->retreaveCondicaoEmailExistenteCadastrar()) > 0) {

            $msg = new Message("Email já utilizado, tente utilizar outro.", "erro", ["icone" => "error"]);
            return $msg->geraJsonMensagem();
        }
        if ($dao->create()) {
            $r = new Message(
                "Usuario cadastrado com sucesso",
                "sucesso",
                ["icone" => "check"]
            );
            return $r->geraJsonMensagem();
        } else {

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

//
        $dao = new UsuarioDAO($this);
        if (count($dao->retreaveCondicaoMatriculaExistenteAlterar()) > 0) {
            $msg = new Message("Matrícula já utilizado, tente utilizar outro.", "erro", ["icone" => "error"]);
            return $msg->geraJsonMensagem();
        }
        $dao2 = new UsuarioDAO($this);
        if (count($dao2->retreaveCondicaoEmailExistenteAlterar()) > 0) {

            $msg = new Message("Email já utilizado, tente utilizar outro.", "erro", ["icone" => "error"]);
            return $msg->geraJsonMensagem();
        }
        if ($dao->update()) {
            $r = new Message(
                "Usuario alterado com sucesso",
                "sucesso",
                ["icone" => "check"]
            );
            return $r->geraJsonMensagem();
        } else {
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

    public function retreaveByPk()
    {
        $dao = new UsuarioDAO($this);
        return $dao->retreaveByPk();
    }

    public function delete()
    {
        $this->ativado = "'0'";
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
        $dao2 = new UsuarioDAO($this);
        $select = "";
        if ($dao->logar()) {
            if (!empty($this->email)) {
                $select = $dao2->retreaveBy("email", $this->email);
            }

            $jwt = JWTWrapper::encode([
                'expiracao' => 15,
                'dominio' => 'localhost',
                'dados' => [
                    'pk_usuario' => $select['pk_usuario'],
                    'nome' => $select['nome'],
                    'nivel' => $select['nivel']
                ]
            ]);
            return
                [
                    'atenticado' => true,
                    'token' => $jwt
                ];

        }
        return (new Message(
            "Email, matrícula ou senha errados",
            "erro", ["icone" => 'error']))->geraJsonMensagem();
    }

    public function retreaveGraphUsuarioAtivo()
    {
        $this->setAtivado('1');
        $dao = new UsuarioDAO($this);

        return $dao->retreaveUsuarioForGraph();
    }

    public function retreaveGraphUsuarioInativo()
    {
        $this->setAtivado("'0'");
        $dao = new UsuarioDAO($this);

        return $dao->retreaveUsuarioForGraph();
    }

    public function retreaveParaAlterar()
    {

        $dao = new UsuarioDAO($this);

        return $dao->retreaveParaAlterar();
    }
}