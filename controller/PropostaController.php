<?php
/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 4/25/17
 * Time: 9:56 PM
 */

namespace backstage\controller;

use backstage\model\Proposta;
use backstage\util\Message;

/**
 * Class PropostaController
 * @package backstage\controller
 */
class PropostaController
{

    /**
     * @var Proposta
     */
    private $proposta;

    /**
     * PropostaController constructor.
     */
    public function __construct($args, $requestmethod)
    {
        $this->proposta = new Proposta();

        if($requestmethod == 'POST'){
            $this->cadastrar($args);
        }

        if($requestmethod == 'PUT'){
            $this->alterar($args);
        }

        if($requestmethod == 'GET'){
            $this->listar($args);
        }

        if($requestmethod == 'DELETE'){
            $this->delete($args);
        }

    }
    public function cadastrar($values = null)
    {
        $values == null ? $values = $_POST : null;
            if ($values != null) {
                if(isset($values['titulo'])) $this->proposta->setTitulo($values['titulo']);
                if(isset($values['data'])) $this->proposta->setData($values['data']);

                if(isset($values['aprovado'])) $this->proposta->setAprovado($values['aprovado']);
                if(isset($values['descricao'])) $this->proposta->setDescricao($values['descricao']);
                if(isset($values['fk_usuario'])) $this->proposta->setFkUsuario($values['fk_usuario']);
                if(isset($values['pk_proposta'])) $this->proposta->setPkProposta($values['pk_proposta']);

                echo $this->proposta->cadastrar();
            }
        }



    public function alterar($values = null)
    {

        parse_str(file_get_contents('php://input'), $_PUT);
        $values == null ? $values = $_PUT : null;
            $this->proposta->setTitulo($values['titulo']);
            $this->proposta->setData($values['data']);

            $this->proposta->setAprovado($values['aprovado']);
            $this->proposta->setDescricao($values['descricao']);
            $this->proposta->setFkUsuario($values['fk_usuario']);
            $this->proposta->setPkProposta($values['pk_proposta']);
            if ($this->proposta->atualizar()) {
                $r = new Message(
                    "Proposta Alterada com sucesso!","sucesso", ["icone" => "check"]
                );
                echo $r->geraJsonMensagem();
            }



    }

    public function listar($values = null)
    {

            $this->proposta->setTitulo(isset($values['titulo']) ? $values['titulo'] : null);
            $this->proposta->setData(isset($values['data']) ? $values['data'] : null);

            $this->proposta->setAprovado(isset($values['aprovado']) ? $values['aprovado'] : null);
            $this->proposta->setDescricao(isset($values['descricao']) ? $values['descricao'] : null);
            $this->proposta->setFkUsuario(isset($values['fk_usuario']) ? $values['fk_usuario'] : null);
            $this->proposta->setPkProposta(isset($values['pk_proposta']) ? $values['pk_proposta'] : null);

        echo json_encode($this->proposta->retreaveAll());

    }

    public function retreavePorData(){
        json_encode($this->proposta->retreavePorData());
    }

    public function delete($values = null)
    {
        $values == null ? $values = $_GET : null;
        if ($values != null) {
            if (isset($values['pk_proposta'])) $this->proposta->setPkProposta($values['pk_proposta']);
        }
    }
}

