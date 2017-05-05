<?php
/**
 * Created by PhpStorm.
 * User: juane
 * Date: 05/05/2017
 * Time: 00:58
 */

namespace backstage\dao;

use phiber\Phiber;
use backstage\model\Projeto;


class ProjetoDAO
{

    /**
     * @var Projeto;
     */
    private $projeto;

    function __construct($projeto)
    {
        $this->projeto = $projeto;
    }

    function create()
    {

        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->projeto);
        if ($criteria->create()) {
            return true;
        }
        return false;

    }

    function retreave()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->projeto);
        $restrictions = [];

        if($this->projeto->getPkProjeto() !=null){
            $restrictions[0] = $criteria->restrictions()->equals("pk_projeto", $this->projeto->getPkProjeto());
        }
        if($this->projeto->getFkEquipe() !=null){
            $restrictions[2] = $criteria->restrictions()->equals("fk_equipe", $this->projeto->getFkEquipe());
        }
        if($this->projeto->getFkProposta() !=null){
            $restrictions[3] = $criteria->restrictions()->equals("fk_proposta", $this->projeto->getFkProposta());
        }
    }

    function update()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->projeto);
        $restrictionsID = $criteria->restrictions()->equals("pk_projeto", $this->projeto->getPkProjeto());
        $criteria->add($restrictionsID);
        if($criteria->update()){
            return true;
        }
        return false;
    }

    function delete()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->projeto);
        $restrictionsID = $criteria->restrictions()->equals("pk_projeto", $this->projeto->getPkProjeto());
        $criteria->add($restrictionsID);
        if($criteria->delete()){
            return true;
        }
        return false;

    }

}