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
    public function cadastrar($values = [])
    {
        if ($values != []) {
            $this->usuario->setLogin($values['login']);
            $this->usuario->setEmail($values['email']);
            $this->usuario->setSenha($values['senha']);
            $this->usuario->setNome($values['nome']);
            $this->usuario->setMatricula($values['matricula']);
            if ($this->usuario->cadastrar()) {
            }
            echo json_encode(new Message(
                "Usuario cadastrado com sucesso",
                "sucesso",
                ["icone" => "check"]
            ));
        }

    }

    public function alterar($values = [])
    {

    }

    public function delete($values = [])
    {

    }

    public function listar($values = [])
    {

    }
}

new UsuarioController();