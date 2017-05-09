<?php
/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 4/25/17
 * Time: 9:56 PM
 */
                                        /**Sadrak Fazendo..*/

namespace backstage\controller;


use backstage\model\Voto;

class VotoController
{

    private $voto;

    /**
     * VotoController constructor.
     * @param $voto
     */
    public function __construct($voto)
    {
        $this->voto = new Voto();
        if (isset($_POST['action'])&& $_POST['action'] == "cadastrar"){
            $this->cadastrar();
        }
    }


    public function cadastrar($values=null, $httpMethod = "GET"){
        if ($httpMethod == "POST"){
            $this->voto->setPkVoto($values['pk_voto']);
        }
    }


}