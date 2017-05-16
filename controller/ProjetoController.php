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
    public function __construct($args, $requestmethod)
    {
        $this->projeto = new Projeto();

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
                if(isset($values['pk_projeto'])) $this->projeto->setPkProjeto($values['pk_projeto']);
                if(isset($values['fk_equipe'])) $this->projeto->setFkEquipe($values['fk_equipe']);
                if(isset($values['fk_proposta'])) $this->projeto->setFkProposta($values['fk_proposta']);
                if(isset($values['status'])) $this->projeto->setStatus($values['status']);
                echo $this->projeto->cadastrar();

        }

    }


    public function alterar($values = null)
    {

        parse_str(file_get_contents('php://input'), $_PUT);
        $values == null ? $values = $_PUT : null;
            $this->projeto->setPkProjeto($values['pk_projeto']);
            $this->projeto->setFkEquipe($values['fk_equipe']);
            $this->projeto->setFkProposta($values['fk_proposta']);
            $this->projeto->setStatus($values['status']);
            if ($this->projeto->atualizar()) {
                $r = new Message("Projeto Cadastrado com sucesso!","sucesso", ["icone" => "check"]);
                echo $r->geraJsonMensagem();

        }

    }

    public function listar($values = null)
    {

            $this->projeto->setPkProjeto(isset($values['pk_projeto']) ? $values['pk_projeto'] : null);
            $this->projeto->setFkEquipe(isset($values['fk_equipe']) ? $values['fk_equipe'] : null);
            $this->projeto->setFkProposta(isset($values['fk_proposta']) ? $values['fk_proposta'] : null);
            $this->projeto->setStatus(isset($values['status']) ? $values['status'] : null);

        echo json_encode($this->projeto->retreaveAll());
    }

    public function delete($values = null)
    {
        echo "DELETE = PARAMS >>>>" . $_GET['pk_projeto'];
    }
}


