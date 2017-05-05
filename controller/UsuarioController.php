<?php

namespace backstage\controller;

/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 4/4/17
 * Time: 8:13 PM
 */
use backstage\model\Usuario;
use backstage\util\Message;

/**
 * Class UsuarioController
 * @package backstage\controller
 */
class UsuarioController
{

    /**
     * @var Usuario
     */
    private $usuario;


    /**
     * UsuarioController constructor.
     */
    public function __construct()
    {
        $this->usuario = new Usuario();
//Para usar sem API;
        if (isset($_POST['action']) && $_POST['action'] == 'cadastrar') {
            $this->cadastrar();
        }

    }

    /**
     * @param array $values
     */
    public function cadastrar($values = [], $httpMethod = 'GET')
    {
        if ($httpMethod == "POST") {
            if ($values != []) {
                $this->usuario->setLogin($values['login']);
                $this->usuario->setEmail($values['email']);
                $this->usuario->setSenha($values['senha']);
                $this->usuario->setNome($values['nome']);
                $this->usuario->setMatricula($values['matricula']);
                if ($this->usuario->cadastrar()) {
                    $r = new Message(
                        "Usuario cadastrado com sucesso",
                        "sucesso",
                        ["icone" => "check"]
                    );
                    echo $r->geraJsonMensagem();
                }
            }
        }
    }

    public function alterar($values = [])
    {
        if ($values != []) {
            $this->usuario->setPkUsuario($values['pk_usuario']);
            $this->usuario->setLogin($values['login']);
            $this->usuario->setEmail($values['email']);
            $this->usuario->setSenha($values['senha']);
            $this->usuario->setNome($values['nome']);
            $this->usuario->setMatricula($values['matricula']);
            if ($this->usuario->atualizar()) {
                $r = new Message(
                    "Usuario cadastrado com sucesso",
                    "sucesso",
                    ["icone" => "check"]
                );
                echo $r->geraJsonMensagem();
            }
        }
    }

    public function delete($values = [])
    {

    }

    public function listar($values = [], $httpMethod = 'GET')
    {
        if ($httpMethod == "GET") {
            $this->usuario->setPkUsuario(isset($values['pk_usuario']) ? $values['pk_usuario'] : null);
            $this->usuario->setLogin(isset($values['login']) ? $values['login'] : null);
            $this->usuario->setEmail(isset($values['email']) ? $values['email'] : null);
            $this->usuario->setNome(isset($values['nome']) ? $values['nome'] : null);
            $this->usuario->setMatricula(isset($values['matricula']) ? $values['matricula'] : null);
        }
        echo json_encode($this->usuario->retraveAll());
    }
}

new UsuarioController();