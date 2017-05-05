<?php
namespace backstage\controller;
/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 4/4/17
 * Time: 8:13 PM
 */
use backstage\model\Usuario;
class UsuarioController
{


    /**
     * UsuarioController constructor.
     */
    public function __construct()
    {
        if(isset($_POST['action']) && $_POST['action'] == 'cadastrar'){
            $this->cadastrar();
        }
    }

    public function cadastrar(){
        $usuario = new Usuario();
    }
}