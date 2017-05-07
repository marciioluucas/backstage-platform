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
    public function __construct()
    {
        $this->membro = new Membro();

        if(isset($_POST['action']) && $_POST['action'] == "cadastrar"){
            $this->cadastrar();
        }
    }

    /**
     * @param null $values
     * @param string $httpMethod
     */
    public function cadastrar($values = null, $httpMethod = "GET")
    {
        if($httpMethod == "POST"){
            if($values !=null){
                $this->membro->setPkMembro($values['pk_membro']);
                $this->membro->setFkEquipe($values['fk_equipe']);
                $this->membro->setFkUsuario($values['fk_usuario']);
                $this->membro->setAtuacao($values['atuacao']);
                $this->membro->setCarga($values['carga']);
                $this->membro->setFuncao($values['funcao']);
                $this->membro->setNivel($values['nivel']);
                if($this->membro->cadastrar()){
                    $r = new Message("Membro cadastrado com Sucesso!", ["icone" => "check"]);
                    echo $r->geraJsonMensagem();
                }


            }
        }
    }

    public function alterar($values = null){
        if($values !=null){
            $this->membro->setPkMembro($values['pk_membro']);
            $this->membro->setFkEquipe($values['fk_equipe']);
            $this->membro->setFkUsuario($values['fk_usuario']);
            $this->membro->setAtuacao($values['atuacao']);
            $this->membro->setCarga($values['carga']);
            $this->membro->setFuncao($values['funcao']);
            $this->membro->setNivel($values['nivel']);
            if($this->membro->atualizar()){
                $r = new Message("Membro Alterado com Sucesso!", ["icone" => "check"]);
                echo $r->geraJsonMensagem();
            }


        }
    }

    public function listar($values = null, $httpMethod = "GET")
    {
        if($httpMethod = "POST"){
            $this->membro->setPkMembro(isset($values['pk_membro']) ? $values['pk_membro'] : null);
            $this->membro->setFkEquipe(isset($values['fk_equipe']) ? $values['fk_equipe'] : null);
            $this->membro->setFkUsuario(isset($values['fk_usuario']) ? $values['fk_usuario'] : null);
            $this->membro->setAtuacao(isset($values['atuacao']) ? $values['atuacao'] : null);
            $this->membro->setCarga(isset($values['carga']) ? $values['carga'] : null);
            $this->membro->setFuncao(isset($values['funcao']) ? $values['funcao'] : null);
            $this->membro->setNivel(isset($values['nivel']) ? $values['nivel'] : null);

        }
        echo json_encode($this->membro->retreaveAll());
    }

}
new MembroController();