<?php
/**
 * Created by PhpStorm.
 * User: João Victor Firmino
 * Date: 07/05/2017
 * Time: 18:30
 */

namespace dao;


use backstage\dao\IDAO;
use backstage\model\Voto;

class VotoDAO implements IDAO
{
    /**
     * @var Voto;
     */
    private $voto;

    function __construct($voto)
    {
        $this->voto = $voto;
    }

    function create()
    {

        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->voto);
        if ($criteria->create()) {
            return true;
        }
        return false;

    }

    function retreave()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->voto);
        $restrictions = [];

        if($this->voto->getPkVoto() !=null){
            $restrictions[0] = $criteria->restrictions()->equals("pk_voto", $this->voto->getPkVoto());
        }
        if($this->voto->getFkProposta() !=null){
            $restrictions[2] = $criteria->restrictions()->equals("fk_usuario", $this->voto->getFkUsuario());
        }
        if($this->voto->getFkProposta() !=null){
            $restrictions[3] = $criteria->restrictions()->equals("fk_proposta", $this->projeto->getFkProposta());
        }
    }

    function update()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->voto);
        $restrictionsID = $criteria->restrictions()->equals("pk_voto", $this->projeto->getPkVoto());
        $criteria->add($restrictionsID);
        if($criteria->update()){
            return true;
        }
        return false;
    }

    function delete()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->voto);
        $restrictionsID = $criteria->restrictions()->equals("pk_voto", $this->voto->getPkVoto());
        $criteria->add($restrictionsID);
        if($criteria->delete()){
            return true;
        }
        return false;

    }

}