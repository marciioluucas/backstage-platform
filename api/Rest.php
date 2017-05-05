<?php
/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 5/4/17
 * Time: 8:53 PM
 */

namespace api;

use model\Usuario;

class Rest
{

    private $class, $args;

    public function __construct($class, $method, $args = [])
    {
        $class = ucfirst($class);
        $this->class = new $class();
        $this->args = $args;
        return $this->$$method();
    }

    function criar()
    {
        if ($this->args != []) {
            for ($i = 0; $i < count($this->args); $i++) {
                $metodoDaClasse = "set" . key($this->args[$i]);
                $this->class->$metodoDaClasse($this->args[$i]);
            }
        }

    }

    function alterar()
    {
        if ($this->args != []) {
            for ($i = 0; $i < count($this->args); $i++) {
                $metodoDaClasse = "set" . key($this->args[$i]);
                $this->class->$metodoDaClasse($this->args[$i]);
            }
        }

    }

    function excluir()
    {

    }

    function listar()
    {

    }

}

parse_str(file_get_contents('php://input'), $_PUT);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $_GET['args'] = explode(",", $_GET['args']);
    new Rest($_GET['class'], $_GET['$method'], $_GET['args']);

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_POST['args'] = explode(",", $_POST['args']);
    new Rest($_POST['class'], $_POST['$method'], $_POST['args']);

} else if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $_PUT['args'] = explode(",", $_PUT['args']);
    new Rest($_PUT['class'], $_PUT['$method'], $_PUT['args']);
}

// localhost/rest.php?usuario&criar&nome=marcio,email=marciioluucas@gmail.com