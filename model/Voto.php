<?php
namespace model;

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

}