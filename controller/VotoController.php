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
use backstage\util\Message;

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
            $this->voto->setFkUsuario($values['fk_usuario']);
            $this->voto->setFkProposta($values['fk_proposta']);
                $r= new Message("Voto cadastrado com sucesso!", "sucesso", ["icone"=>"check"]);
                echo $r->geraJsonMensagem();
        }
    }
//aaaaa

    public function alterar ($values = null){
        if($values != null){
            $this->voto->setPkVoto($values['pk_voto']);
            $this->voto->setFkUsuario($values['fk_usuario']);
            $this->voto->setFkProposta($values['fk_proposta']);
            if ($this->voto->atualizar()){
                $r= new Message("Voto alterado com sucesso!","sucesso", ["icone" => "check"]);
                echo $r->geraJsonMensagem();

            }
        }
    }

    public function listar($values = null, $httpMethod = "GET"){
        if ($httpMethod = "POST"){
            $this->voto->setPkVoto(isset($values['pk_voto']) ? $values['pk_voto'] : null);
            $this->voto->setFkUsuario(isset($values['fk_usuario']) ? $values ['fk_usuario'] : null);
            $this->voto->setFkProposta(isset($values['fk_proposta']) ? $values ['fk_proposta'] : null);
        }
        echo json_encode($this->voto->retreaveAll());
    }
}
new VotoController();