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
            if(isset($args['method']) and $args['method'] == 'retreaveGraphUsuarioAtivo'){
                $this->retreaveGraphUsuarioAtivo();
            }

            if(isset($args['method']) and $args['method'] == 'retreaveGraphUsuarioInativo'){
                $this->retreaveGraphUsuarioInativo();
            }

            if(!isset($args['method'])){
                $this->listar($args);
            }
        }

        if ($requestMethod == 'PUT') {
            $this->alterar($args);
        }

        if ($requestMethod == 'DELETE') {
            $this->delete($args);
        }
    }

    /**
     * @param array $values
     */
    public function cadastrar($values = null)
    {
        $values == null ? $values = $_POST : null;
        if ($values != null) {
            if(isset($values['login'])) $this->usuario->setLogin($values['login']);
            if(isset($values['email'])) $this->usuario->setEmail($values['email']);
            if(isset($values['senha'])) $this->usuario->setSenha($values['senha']);
            if(isset($values['nome'])) $this->usuario->setNome($values['nome']);
            if(isset($values['matricula'])) $this->usuario->setMatricula($values['matricula']);
//            echo $values['email'];
            echo $this->usuario->cadastrar();
        }
    }

    public function alterar($values = null)
    {
        parse_str(file_get_contents('php://input'), $_PUT);
        $values == null ? $values = $_PUT : null;
        if ($values != null) {

            if (isset($values['pk_usuario'])) $this->usuario->setPkUsuario($values['pk_usuario']);
            if (isset($values['login'])) $this->usuario->setLogin($values['login']);
            if (isset($values['email'])) $this->usuario->setEmail($values['email']);
            if (isset($values['senha'])) $this->usuario->setSenha($values['senha']);
            if (isset($values['nome'])) $this->usuario->setNome($values['nome']);
            if (isset($values['matricula'])) $this->usuario->setMatricula($values['matricula']);
            echo $this->usuario->atualizar();
        }
    }

    public function delete($values = null)
    {
        $values == null ? $values = $_GET : null;
        if ($values != null) {
            if (isset($values['pk_usuario'])) $this->usuario->setPkUsuario($values['pk_usuario']);
        }
        echo $this->usuario->delete();
    }

    public function listar($values = null)
    {

        $this->usuario->setPkUsuario(isset($values['pk_usuario']) ? $values['pk_usuario'] : null);
        $this->usuario->setLogin(isset($values['login']) ? $values['login'] : null);
        $this->usuario->setEmail(isset($values['email']) ? $values['email'] : null);
        $this->usuario->setNome(isset($values['nome']) ? $values['nome'] : null);
        $this->usuario->setMatricula(isset($values['matricula']) ? $values['matricula'] : null);
        echo json_encode($this->usuario->retreave());
    }

    public function retreaveGraphUsuarioAtivo(){
        echo json_encode($this->usuario->retreaveGraphUsuarioAtivo());
    }

    public function retreaveGraphUsuarioInativo(){
        echo json_encode($this->usuario->retreaveGraphUsuarioInativo());
    }
}
