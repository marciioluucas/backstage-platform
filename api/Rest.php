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
     * @var
     */
    /**
     * @var
     */
    private $class, $args;

    public function __construct($url,$httpMethod)
    {


        $arrayArgsSemFiltro = explode('&', $url['query']);
        $arrayArgsFiltrado = [];
        foreach ($arrayArgsSemFiltro as $arg) {
            $x = explode('=', $arg);
            $arrayArgsFiltrado[$x[0]] = $x[1];
        }


        $class = ucfirst($arrayArgsFiltrado['classe']) . "Controller";
//        require_once '../controller/' . $class . '.php';
        $method = $arrayArgsFiltrado['metodo'];
        unset($arrayArgsFiltrado['classe']);
        unset($arrayArgsFiltrado['metodo']);
        $class = "\backstage\controller\\" . $class;
        $this->class = new $class();
        $this->args = $arrayArgsFiltrado;
        return $this->class->$method($this->args, $_SERVER['REQUEST_METHOD']);
    }
}


// localhost/rest.php?usuario&criar&nome=marcio,email=marciioluucas@gmail.com