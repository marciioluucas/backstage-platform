<?php
/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 4/25/17
 * Time: 9:54 PM                           Sadrak Fazendo..
 */
/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 4/25/17
 * Time: 9:54 PM
 */
namespace backstage\controller;


use backstage\model\Equipe;
use backstage\util\Message;

class EquipeController
{
    private $equipe;

    /**
     * EquipeController constructor.
     * @param $equipe
     */
    public function __construct($args, $requestmethod)
    {
        $this->equipe = new Equipe();

        if ($requestmethod == 'POST') {
            $this->cadastrar($args);
        }

        if ($requestmethod == 'PUT') {
            $this->alterar($args);
        }

        if ($requestmethod == 'GET') {
            $this->listar($args);
        }

        if ($requestmethod == 'DELETE') {
            $this->delete($args);
        }

    }

    public function cadastrar($values = null)
    {
        $values == null ? $values = $_POST : null;

        if ($values != null) {
            if (isset($values['pk_equipe'])) $this->equipe->setPkEquipe($values['pk_equipe']);
            if (isset($values['nome'])) $this->equipe->setNome($values['nome']);

            echo $this->equipe->cadastrar();
        }
    }

    public function alterar($values = null)
    {
        parse_str(file_get_contents('php://input'), $_PUT);
        $values == null ? $values = $_PUT : null;

        $this->equipe->setPkEquipe($values['pk_equipe']);
        $this->equipe->setNome($values['nome']);
        if ($this->equipe->atualizar()) {
            $r = new Message("Equipe alterada com sucesso!", "sucesso", ["icone" => "check"]);
            echo $r->geraJsonMensagem();
        }
    }

    public function listar($values = null)
    {

        $this->equipe->setPkEquipe(isset($values['pk_equipe']) ? $values['pk_equipe'] : null);
        $this->equipe->setNome(isset($values['nome']) ? $values['nome'] : null);

        echo json_encode($this->equipe->retreave());
    }

    public function delete($values = null)
    {
        echo "DELETE = PARAMS >>>>" . $_GET['pk_proposta'];
    }
}
