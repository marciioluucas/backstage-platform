<?php
/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 4/25/17
 * Time: 9:55 PM
 */

namespace backstage\controller;

use backstage\model\Membro;
use backstage\util\Message;

/**
 * Class MembroController
 * @package backstage\controller
 */
class MembroController
{

    /**
     * @var
     */
    private $membro;

    /**
     * MembroController constructor.
     */
    public function __construct($args, $requestMethod)
    {
        $this->membro = new Membro();

        if ($requestMethod == 'POST') {
            $this->cadastrar($args);
        }
        if ($requestMethod == 'GET') {
            $this->listar($args);
        }
        if ($requestMethod == 'PUT') {
            $this->alterar($args);
        }
        if ($requestMethod == 'DELETE') {
            $this->delete($args);
        }
    }

    /**
     * @param null $values
     * @param string $httpMethod
     */
    public function cadastrar($values = null)
    {
        $values == null ? $values = $_POST : null;
        if ($values != null) {
            if (isset($values['pk_membro'])) $this->membro->setPkMembro($values['pk_membro']);
            if (isset($values['fk_equipe'])) $this->membro->setFkEquipe($values['fk_equipe']);
            if (isset($values['fk_usuario'])) $this->membro->setFkUsuario($values['fk_usuario']);
            if (isset($values['atuacao'])) $this->membro->setAtuacao($values['atuacao']);
            if (isset($values['funcao'])) $this->membro->setFuncao($values['funcao']);
            if (isset($values['ativado'])) $this->membro->setAtivado($values['ativado']);


            echo $this->membro->cadastrar();


        }

    }

    public function alterar($values = null)
    {


        parse_str(file_get_contents('php://input'), $_PUT);
        $values == null ? $values = $_PUT : null;
        $this->membro->setPkMembro($values['pk_membro']);
        $this->membro->setFkEquipe($values['fk_equipe']);
        $this->membro->setFkUsuario($values['fk_usuario']);
        $this->membro->setAtuacao($values['atuacao']);
        $this->membro->setFuncao($values['funcao']);
        $this->membro->setAtivado($values['ativado']);
        if ($this->membro->atualizar()) {
            $r = new Message("Membro Alterado com Sucesso!", "sucesso", ["icone" => "check"]);
            echo $r->geraJsonMensagem();
        }


    }

    public function listar($values = null)
    {

        $this->membro->setPkMembro(isset($values['pk_membro']) ? $values['pk_membro'] : null);
        $this->membro->setFkEquipe(isset($values['fk_equipe']) ? $values['fk_equipe'] : null);
        $this->membro->setFkUsuario(isset($values['fk_usuario']) ? $values['fk_usuario'] : null);
        $this->membro->setAtuacao(isset($values['atuacao']) ? $values['atuacao'] : null);
        $this->membro->setFuncao(isset($values['funcao']) ? $values['funcao'] : null);
        $this->membro->setAtivado(isset($values['ativado']) ? $values['ativado'] : null);


        echo json_encode($this->membro->retreaveAll());
    }

    public function delete($values = null)
    {
        echo "DELETE = PARAMS >>>>" . $_GET['pk_proposta'];
    }

}
