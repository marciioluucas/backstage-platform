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
        $this->voto = new Voto();

        if ($requestedMethod = 'POST') {
            $this->cadastrar();
        }

        if ($requestedMethod = 'GET') {
            $this->listar();
        }

        if ($requestedMethod = 'PUT') {
            $this->alterar();
        }

        if ($requestedMethod = 'DELETE') {
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

//aaaaa

    public function alterar($values = null)
    {

        parse_str(file_get_contents('php://input'), $_PUT);
        $values == null ? $values = $_PUT : null;
        $this->voto->setPkVoto($values['pk_voto']);
        $this->voto->setFkUsuario($values['fk_usuario']);
        $this->voto->setFkProposta($values['fk_proposta']);
        if ($this->voto->atualizar()) {
            $r = new Message("Voto alterado com sucesso!", "sucesso", ["icone" => "check"]);
            echo $r->geraJsonMensagem();


        }
    }

    public function listar($values = null)
    {

        $this->voto->setPkVoto(isset($values['pk_voto']) ? $values['pk_voto'] : null);
        $this->voto->setFkUsuario(isset($values['fk_usuario']) ? $values ['fk_usuario'] : null);
        $this->voto->setFkProposta(isset($values['fk_proposta']) ? $values ['fk_proposta'] : null);

        echo json_encode($this->voto->retreaveAll());
    }

    public function delete($values = null)
    {
        echo "DELETE = PARAMS >>>>" . $_GET['pk_proposta'];
    }
}

