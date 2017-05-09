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
    public function __construct($equipe)
    {
        $this->equipe = new Equipe();
        if (isset($_POST['action']) && $_POST['action'] == "cadastrar"){
            $this->cadastrar();
        }
    }

    public function cadastrar($values = null, $httpMethod = "GET"){
        if ($httpMethod == "POST"){
            $this->equipe->setPkEquipe($values['pk_equipe']);
            $this->equipe->setNome($values['nome']);
                $r = new Message("Equipe Cadastrada com sucesso!", "sucesso", ["icone"=>"check"]);
                echo $r->geraJsonMensagem();
        }
    }

    public function alterar($values = null){
        if ($values != null){
            $this->equipe->setPkEquipe($values['pk_equipe']);
            $this->equipe->setNome($values['nome']);
                $r = new Message("Equipe alterada com sucesso!", "sucesso", ["icone" => "check" ]);
                echo $r->geraJsonMensagem();
        }
    }

    public function listar($values = null, $httpMethod = "GET"){
        if ($httpMethod = "POST"){
            $this->equipe(isset($values['pk_equipe']) ? $values['pk_equipe'] : null);
            $this->equipe(isset($values['nome']) ? $values['nome'] : null);
        }
        echo json_encode($this->equipe->retreaveAll());
    }
}
new EquipeController();