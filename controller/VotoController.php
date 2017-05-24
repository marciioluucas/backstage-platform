<?php
/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 4/25/17
 * Time: 9:56 PM
 */


namespace backstage\controller;


use backstage\model\Voto;
use backstage\util\Message;

class VotoController
{

    private $voto;

    /**
     * VotoController constructor.
     * @param $voto
     */
    public function __construct($args, $requestedMethod)
    {
        $this->voto = new Voto($args['fk_proposta']);
        if(isset($args['fk_usuario'])){
            $this->voto = new Voto($args['fk_proposta'], $args['fk_usuario']);
        }

        if ($requestedMethod == 'POST') {
            $this->cadastrar($args);
        }

        if ($requestedMethod == 'GET') {
            if(isset($args['method']) and $args['method'] == 'contaVoto') {
                $this->contaVoto($args);
            }

        }



        if ($requestedMethod == 'DELETE') {
            $this->delete();
        }

    }


    public function cadastrar($values = null)
    {

        $values == null ? $values = $_POST : null;
        if ($values != null) {
            if (isset($values['pk_voto'])) $this->voto->setPkVoto($values['pk_voto']);
            if (isset($values['fk_usuario'])) $this->voto->setFkUsuario($values['fk_usuario']);
            if (isset($values['fk_proposta'])) $this->voto->setFkProposta($values['fk_proposta']);

            echo $this->voto->cadastrar();
        }
    }

    public function delete($values = null)
    {
        echo "DELETE = PARAMS >>>>" . $_GET['pk_proposta'];
    }


    public function contaVoto($values = null)
    {

        $this->voto->setFkProposta(isset($values['fk_proposta']) ? $values['fk_proposta'] : null);
        echo json_encode($this->voto->contar());

    }

}

