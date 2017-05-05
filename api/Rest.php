<?php
/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 5/4/17
 * Time: 8:53 PM
 */

namespace backstage\api;


class Rest
{

    /**
     * @var <T>
     */
    /**
     * @var
     */
    private $class, $args;

    public function __construct($url)
    {


        $arrayArgsSemFiltro = explode('&', $url['query']);
        $arrayArgsFiltrado = [];
        foreach ($arrayArgsSemFiltro as $arg) {
            $x = explode('=', $arg);
            $arrayArgsFiltrado[$x[0]] = $x[1];
        }


        $class = ucfirst($arrayArgsFiltrado['classe']) . "Controller";
        require_once '../controller/' . $class . '.php';
        $method = $arrayArgsFiltrado['metodo'];
        unset($arrayArgsFiltrado['classe']);
        unset($arrayArgsFiltrado['metodo']);
        $class = "\backstage\controller\\" . $class;
        $this->class = new $class();
        $this->args = $arrayArgsFiltrado;
        return $this->$method();
    }

    /**
     *
     */
    function criar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->class->cadastrar($this->args);
        }
    }

    function alterar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $this->class->alterar($this->args);
        }
    }

    function excluir()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $this->class->delete($this->args);
        }
    }

    function listar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->class->listar($this->args);
        }
    }

}


// localhost/rest.php?usuario&criar&nome=marcio,email=marciioluucas@gmail.com