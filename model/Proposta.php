<?php

/**
 * Created by PhpStorm.
 * User: juane
 * Date: 18/04/2017
 * Time: 22:21
 */
class Proposta
{

    private $pk_proposta;
    private $fk_usuario;
    private $titulo;
    private $descricao;
    private $data;

    /**
     * @return mixed
     */
    public function getPkProposta()
    {
        return $this->pk_proposta;
    }

    /**
     * @param mixed $pk_proposta
     */
    public function setPkProposta($pk_proposta)
    {
        $this->pk_proposta = $pk_proposta;
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
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }



}