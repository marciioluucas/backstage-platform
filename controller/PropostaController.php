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
    public function __construct()
    {
        $this->proposta = new Proposta();
        if(isset($_POST['action']) && $_POST['action'] == "cadastrar"){
            $this->cadastrar();
        }

    }
    public function cadastrar($values = null, $httpMethod = 'GET')
    {
        if ($httpMethod == 'POST') {
            if ($values != null) {
                $this->proposta->setTitulo($values['titulo']);
                $this->proposta->setData($values['data']);
                $this->proposta->setContagem($values['contagem']);
                $this->proposta->setDescricao($values['descricao']);
                $this->proposta->setFkUsuario($values['fk_usuario']);
                $this->proposta->setPkProposta($values['pk_proposta']);
                if ($this->proposta->cadastrar()) {
                    $r = new Message(
                        "Proposta cadastrada com sucesso!", ["icone" => "check"]
                    );
                    echo $r->geraJsonMensagem();
                }
            }
        }

    }

    public function alterar($values = null)
    {

        if ($values != null) {
            $this->proposta->setTitulo($values['titulo']);
            $this->proposta->setData($values['data']);
            $this->proposta->setContagem($values['contagem']);
            $this->proposta->setDescricao($values['descricao']);
            $this->proposta->setFkUsuario($values['fk_usuario']);
            $this->proposta->setPkProposta($values['pk_proposta']);
            if ($this->proposta->atualizar()) {
                $r = new Message(
                    "Proposta Alterada com sucesso!", ["icone" => "check"]
                );
                echo $r->geraJsonMensagem();
            }
        }


    }

    public function listar($values = null, $httpMethod = "GET")
    {
        if ($httpMethod == "POST") {
            $this->proposta->setTitulo(isset($values['titulo']) ? $values['titulo'] : null);
            $this->proposta->setData(isset($values['data']) ? $values['data'] : null);
            $this->proposta->setContagem(isset($values['contagem']) ? $values['contagem'] : null);
            $this->proposta->setDescricao(isset($values['descricao']) ? $values['descricao'] : null);
            $this->proposta->setFkUsuario(isset($values['fk_usuario']) ? $values['fk_usuario'] : null);
            $this->proposta->setPkProposta(isset($values['pk_proposta']) ? $values['pk_proposta'] : null);
        }
        echo json_encode($this->proposta->retreaveAll());

    }
}

new PropostaController();