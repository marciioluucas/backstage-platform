<?php
/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 5/4/17
 * Time: 8:53 PM
 */

namespace backstage\api;


use backstage\util\Message;

class Rest
{


    public function __construct($class, $method, $args, $httpMethod)
    {
        $class = "\\backstage\\controller\\" . $class;
        if (!class_exists($class)) {
            $r =new Message("Classe nao encontrada, favor passar uma classe valida pelo parametro",
                "erro", ["icone" => "error"]);
        echo $r->geraJsonMensagem();
        return false;
        }
        $class = new $class();
        if(!method_exists($class,$method)) {
            $r =new Message("Metodo nao encontrado, favor passar um metodo valido pelo parametro",
                "erro", ["icone" => "error"]);
            echo $r->geraJsonMensagem();
            return false;
        }
        return $class->$method($args, $_SERVER['REQUEST_METHOD']);
    }
}