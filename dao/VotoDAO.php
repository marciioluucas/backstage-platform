<?php
/**
 * Created by PhpStorm.
 * User: João Victor Firmino
 * Date: 07/05/2017
 * Time: 18:30
 */

namespace backstage\dao;


use backstage\model\Voto;
use phiber\Phiber;

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

        if ($this->voto->getPkVoto() != null) {
            $restrictions[0] = $criteria->restrictions()->equals("pk_voto", $this->voto->getPkVoto());
        }
        if ($this->voto->getFkProposta() != null) {
            $restrictions[1] = $criteria->restrictions()->equals("fk_usuario", $this->voto->getFkUsuario());
        }
        if ($this->voto->getFkProposta() != null) {
            $restrictions[2] = $criteria->restrictions()->equals("fk_proposta", $this->voto->getFkProposta());
        }

        $restrictions = array_values($restrictions);
        if (count($restrictions) > 1) {
            for ($i = 0; $i < count($restrictions) - 1; $i++) {
                $criteria->add($criteria->restrictions()
                    ->and($restrictions[$i], $restrictions[$i + 1]));
            }
        } else {
            if (!empty($restrictions)) {
                $criteria->add($restrictions[0]);
            }
        }
        $criteria->returnArray(true);
        $r = $criteria->select();
        return $r;

    }

    function update()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->voto);
        $restrictionsID = $criteria->restrictions()->equals("pk_voto", $this->voto->getPkVoto());
        $criteria->add($restrictionsID);
        if ($criteria->update()) {
            return true;
        }
        return false;
    }

    function retreaveByFkUsuarioAndFkProposta()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->voto);

        $restriction1 = $criteria->restrictions()
            ->equals("fk_usuario", $this->voto->getFkUsuario());

        $restriction2 = $criteria->restrictions()
            ->equals("fk_proposta", $this->voto->getFkProposta());

        $condAnd = $criteria->restrictions()
            ->and($restriction1, $restriction2);
        $criteria->add($condAnd);
        return $criteria->select();
    }

    function retreaveByFkProposta()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->voto);
        $restriction = $criteria->restrictions()
            ->equals("fk_proposta", $this->voto->getFkProposta());
        $criteria->add($restriction);
        return $criteria->select();
    }
}