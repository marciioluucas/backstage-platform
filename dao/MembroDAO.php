<?php
/**
 * Created by PhpStorm.
 * User: ifgoiano
 * Date: 04/05/2017
 * Time: 22:00
 */

namespace dao;


use backstage\dao\IDAO;
use phiber\Phiber;
use backstage\model\Membro;

class MembroDAO implements IDAO
{

    /**
     * @var Membro;
     */
    private $membro;

    function __construct($membro)
    {
        $this->membro = $membro;
    }

    function create()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->membro);
        if ($criteria->create()) {
            return true;
        } else {
            return false;
        }

    }

    function retreave()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->membro);
        $restrictions = [];

        if ($this->membro->getFkUsuario()) {
            $restrictions[0] = $criteria->restrictions()->equals("fk_usuario", $this->membro->getFkUsuario());
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
//        print_r($criteria->show());
        return $r;


    }

    function retreaveCondicaoCadastrar($campo, $campoValor)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->membro);
        $restriction = $criteria->restrictions()->equals($campo, $campoValor);
        $criteria->add($restriction);
        return $criteria->select();
    }

    function update()
    {

        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->membro);
        $restrictionID = $criteria->restrictions()->equals("pk_membro", $this->membro->getPkMembro());
        $criteria->add($restrictionID);
        if ($criteria->update()) {

            return true;
        }
        return false;


    }


}