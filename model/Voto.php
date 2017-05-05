<?php
namespace backstage\model;

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



}