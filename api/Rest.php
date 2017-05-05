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


    public function __construct($class, $method, $args, $httpMethod)
    {
        $class = "\\backstage\\controller\\" . $class;
        $this->class = new $class();
        return $this->class->$method($args, $_SERVER['REQUEST_METHOD']);
    }
}