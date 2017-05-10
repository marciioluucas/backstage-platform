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
    public function __construct($args, $requestMethod)
    {
        $this->usuario = new Usuario();
//Para usar sem API;
        if ($requestMethod == 'POST') {
            $this->cadastrar($args);
        }

        if ($requestMethod == 'GET') {
            $this->listar($args);
        }

        if ($requestMethod == 'PUT') {
            $this->alterar($args);
        }

        if ($requestMethod == 'DELETE') {
            $this->alterar($args);
        }
    }

    /**
     * @param array $values
     */
    public function cadastrar($values = null)
    {
        $values == null ? $values = $_POST : null;
        if ($values != null) {
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

    public function alterar($values = null)
    {
        parse_str(file_get_contents('php://input'), $_PUT);
        $values == null ? $values = $_PUT : null;
        $this->usuario->setPkUsuario($values['pk_usuario']);
        $this->usuario->setLogin($values['login']);
        $this->usuario->setEmail($values['email']);
        $this->usuario->setSenha($values['senha']);
        $this->usuario->setNome($values['nome']);
        $this->usuario->setMatricula($values['matricula']);
        if ($this->usuario->atualizar()) {
            $r = new Message(
                "Usuario alterado com sucesso",
                "sucesso",
                ["icone" => "check"]
            );
            echo $r->geraJsonMensagem();
        }
    }

    public function delete($values = null)
    {
        echo "DELETE = PARAMS >>>>" . $_GET['pk_usuario'];
    }

    public function listar($values = null)
    {
        $this->usuario->setPkUsuario(isset($values['pk_usuario']) ? $values['pk_usuario'] : null);
        $this->usuario->setLogin(isset($values['login']) ? $values['login'] : null);
        $this->usuario->setEmail(isset($values['email']) ? $values['email'] : null);
        $this->usuario->setNome(isset($values['nome']) ? $values['nome'] : null);
        $this->usuario->setMatricula(isset($values['matricula']) ? $values['matricula'] : null);
        echo json_encode($this->usuario->retrave());

    }
}
