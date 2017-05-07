<?php
/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 4/25/17
 * Time: 9:54 PM
 */

namespace backstage\controller;

use backstage\dao\PropostaDAO;
use backstage\model\Projeto;
use backstage\util\Message;

/**
 * Class ProjetoController
 * @package backstage\controller
 */
class ProjetoController
{

    /**
     * @var Projeto
     */
    private $projeto;


    /**
     * ProjetoController constructor.
     */
    public function __construct()
    {
        $this->projeto = new Projeto();

        if (isset($_POST['action']) && $_POST['action'] == "cadastrar") {
            $this->cadastrar();
        }
    }

    public function cadastrar($values = null, $httpMethod = "GET")
    {
        if ($httpMethod == "POST") {
            if ($values != null) {
                $this->projeto->setPkProjeto($values['pk_projeto']);
                $this->projeto->setFkEquipe($values['fk_equipe']);
                $this->projeto->setFkProposta($values['fk_proposta']);
                $this->projeto->setStatus($values['status']);
                if ($this->projeto->cadastrar()) {
                    $r = new Message("Projeto Cadastrado com sucesso!", ["icone" => "check"]);
                    echo $r->geraJsonMensagem();
                }
            }
        }

    }


    public function alterar($values = null)
    {

        if ($values != null) {
            $this->projeto->setPkProjeto($values['pk_projeto']);
            $this->projeto->setFkEquipe($values['fk_equipe']);
            $this->projeto->setFkProposta($values['fk_proposta']);
            $this->projeto->setStatus($values['status']);
            if ($this->projeto->atualizar()) {
                $r = new Message("Projeto Cadastrado com sucesso!", ["icone" => "check"]);
                echo $r->geraJsonMensagem();
            }
        }

    }

    public function listar($values = null, $httpMethod = "GET")
    {
        if($httpMethod = "POST"){
            $this->projeto->setPkProjeto(isset($values['pk_projeto']) ? $values['pk_projeto'] : null);
            $this->projeto->setFkEquipe(isset($values['fk_equipe']) ? $values['fk_equipe'] : null);
            $this->projeto->setFkProposta(isset($values['fk_proposta']) ? $values['fk_proposta'] : null);
            $this->projeto->setStatus(isset($values['status']) ? $values['status'] : null);
        }
        echo json_encode($this->projeto->retreaveAll());
    }
}
new PropostaDAO();

