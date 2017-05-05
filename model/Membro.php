<?php
/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 4/25/17
 * Time: 8:47 PM
 */

namespace backstage\model;

class Membro
{
    private $pk_membro;
    private $atuacao;
    private $nivel;
    private $fk_equipe;
    private $funcao;
    private $fk_usuario;
    private $carga;

    /**
     * @return mixed
     */
    public function getPkMembro()
    {
        return $this->pk_membro;
    }

    /**
     * @param mixed $pk_membro
     */
    public function setPkMembro($pk_membro)
    {
        $this->pk_membro = $pk_membro;
    }

    /**
     * @return mixed
     */
    public function getAtuacao()
    {
        return $this->atuacao;
    }

    /**
     * @param mixed $atuacao
     */
    public function setAtuacao($atuacao)
    {
        $this->atuacao = $atuacao;
    }

    /**
     * @return mixed
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * @param mixed $nivel
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
    }

    /**
     * @return mixed
     */
    public function getFkEquipe()
    {
        return $this->fk_equipe;
    }

    /**
     * @param mixed $fk_equipe
     */
    public function setFkEquipe($fk_equipe)
    {
        $this->fk_equipe = $fk_equipe;
    }

    /**
     * @return mixed
     */
    public function getFuncao()
    {
        return $this->funcao;
    }

    /**
     * @param mixed $funcao
     */
    public function setFuncao($funcao)
    {
        $this->funcao = $funcao;
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
    public function getCarga()
    {
        return $this->carga;
    }

    /**
     * @param mixed $carga
     */
    public function setCarga($carga)
    {
        $this->carga = $carga;
    }

}