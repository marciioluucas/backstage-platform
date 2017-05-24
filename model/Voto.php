<?php

namespace backstage\model;

use backstage\dao\VotoDAO;
use backstage\util\Message;

/**
 * Created by PhpStorm.
 * User: ifgoiano
 * Date: 25/04/2017
 * Time: 19:48
 */
class Voto
{

    /**
     * Varíavel id do voto.
     * @var
     */
    private $pk_voto;

    /**
     * Fk do usuário que fez o voto.
     * @var
     */
    private $fk_usuario;

    /**
     * Fk da proposta que recebe o voto.
     * @var
     */
    private $fk_proposta;

    /**
     * Voto constructor.
     * @param $fk_usuario
     * @param $fk_proposta
     */
    public function __construct($fk_proposta, $fk_usuario = null)
    {
        $this->fk_usuario = $fk_usuario;
        $this->fk_proposta = $fk_proposta;
    }




    /**
     * @return mixed
     */
    public function getPkVoto()
    {
        return $this->pk_voto;
    }

    /**
     * @param mixed $pk_voto
     */
    public function setPkVoto($pk_voto)
    {
        $this->pk_voto = $pk_voto;
    }

    /**
     * @return mixed
     */
    public function getFkUsuario()
    {
        return $this->fk_usuario;
    }

    /**
     * @param mixed $fk_usuario
     */
    public function setFkUsuario($fk_usuario)
    {
        $this->fk_usuario = $fk_usuario;
    }

    /**
     * @return mixed
     */
    public function getFkProposta()
    {
        return $this->fk_proposta;
    }

    /**
     * @param mixed $fk_proposta
     */
    public function setFkProposta($fk_proposta)
    {
        $this->fk_proposta = $fk_proposta;
    }

    public function cadastrar()
    {
        $dao = new VotoDAO($this);
        $r = new Message("Erro inesperado ao submeter voto", "erro", ["icone" => "error"]);

        if(count($dao->retreaveByFkUsuarioAndFkProposta()) > 0) {
            $r = new Message("Usuário com voto já submetido para esta proposta", "erro", ["icone" => "error"]);
            return $r->geraJsonMensagem();
        }

        if ($dao->create()) {
            $r = new Message("Voto submetido com sucesso!", "Sucesso", ["icone" => "check"]);
        }
        return $r->geraJsonMensagem();
    }

    public function contar() {
        $dao = new VotoDAO($this);
        return ["contagem" => $dao->contar()];
    }


}