<?php
/**
 * Created by PhpStorm.
 * User: ifgoiano
 * Date: 04/05/2017
 * Time: 22:00
 */

namespace dao;


use phiber\Phiber;

class MembroDAO
{
    private $membro;

    function __construct($membro)
    {
        $this->membro = $membro;
    }

    function create(){
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->membro);
        if($criteria->create()){
            return true;
        }else{
            return false;
        }

    }

    function retreave(){
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->membro);
        $restrictions = [];

        if($this->membro->getFkusuario()){
            $restrictions[0] = $criteria->restrictions()->equals("fk_usuario", $this->getFkusuario());
        }

        if($this->membro->getNivel()){
            $restrictions[1] = $criteria->restrictions()->like("nivel", $this->getNivel());
        }
        if($this->membro->getFuncao()){
            $restrictions[2] = $criteria->restrictions()->like("funcao", $this->getFuncao());
        }

    }

    function update(){

        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->membro);
        $restrictionID = $criteria->restrictions()->equals("pk_membro", $this->getPkmembro());
        $criteria->add($restrictionID);
        if($criteria->update()){

            return true;
        }
            return false;


    }

    function delete(){
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->membro);
        $restrictionID = $criteria->restrictions()->equals("pk_membro", $this->membro->getPkmembro());
        $criteria->add($restrictionID);
        if ($criteria->delete()) {
            return true;
        }
            return false;

    }
}