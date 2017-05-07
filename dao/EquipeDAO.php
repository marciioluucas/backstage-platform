<?php
/**
 * Created by PhpStorm.
 * User: João Victor Firmino
 * Date: 07/05/2017
 * Time: 18:07
 */

namespace dao;


use backstage\dao\IDAO;
use backstage\model\Equipe;

class EquipeDAO implements IDAO
{
    /**
     * @var Equipe
     */
    private $equipe;

    function __construct($equipe)
    {
        $this->equipe = $equipe;
    }

    function create()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->equipe);
        if ($criteria->create()) {
            return true;
        } else {
            return false;
        }
    }

    function retreave()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->equipe);
        $restrictions = [];
        if ($this->equipe->getNome() != null) {
            $restrictions[0] = $criteria->restrictions()
                ->like("nome", $this->equipe->getNome());
        }

        if ($this->equipe->getPkEquipe() != null) {
            $restrictions[2] = $criteria->restrictions()
                ->equals("pk_equipe", $this->equipe->getPkEquipe());

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
        $r = $criteria->select();
//        print_r($criteria->show());
        return $r;

    }

    function update()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->equipe);
        $restrictionID = $criteria->restrictions()->equals("pk_equipe", $this->equipe->getPkEquipe());
        $criteria->add($restrictionID);
        if ($criteria->update()) {
            return true;
        }
        return false;
    }

    function delete()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->proposta);
        $restrictionID = $criteria->restrictions()->equals("pk_equipe", $this->equipe->getPkEquipe());
        $criteria->add($restrictionID);
        if ($criteria->delete()) {
            return true;
        } else {
            return false;
        }
    }

}