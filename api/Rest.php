<?php

namespace backstage\api;
use backstage\util\Message;

class Rest
{


    public function __construct($class, $args = [], $httpMethod)
    {
        $class = "\\backstage\\controller\\" . $class;
        if (!class_exists($class)) {
            $r =new Message("Classe nao encontrada, favor passar uma classe valida pelo parametro",
                "erro", ["icone" => "error"]);
        echo $r->geraJsonMensagem();
        return false;
        }
//        if(!method_exists($class,$method)) {
//            $r =new Message("Metodo nao encontrado, favor passar um metodo valido pelo parametro",
//                "erro", ["icone" => "error"]);
//            echo $r->geraJsonMensagem();
//            return false;
//        }
        return new $class($args, $_SERVER['REQUEST_METHOD']);
    }
}