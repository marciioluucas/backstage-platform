<?php
/**
 * Created by PhpStorm.
 * User: ifgoiano
 * Date: 04/05/2017
 * Time: 20:45
 */

namespace backstage\dao;

use phiber\Phiber;
use backstage\model\Proposta;

class PropostaDAO implements IDAO
{


    /**
     * @var Proposta;
     */
    private $proposta;

    function __construct($proposta)
    {
        $this->proposta = $proposta;
    }

    function create()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->proposta);
        if ($criteria->create()) {


            return true;
        }

        return false;


    }

    function update()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->proposta);
        $restrictionID = $criteria->restrictions()->equals("pk_proposta", $this->proposta->getPkProposta());
        $criteria->add($restrictionID);
        if ($criteria->update()) {

            return true;
        } else {
            return false;
        }
    }

    function retreave()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->proposta);
        $restrictions = [];

        if ($this->proposta->getTitulo() != null) {
            $restrictions[0] = $criteria->restrictions()->like("titulo", $this->proposta->getTitulo());
        }

        if ($this->proposta->getAprovado() != null) {
            $restrictions[1] = $criteria->restrictions()->like("aprovado", $this->proposta->getAprovado());
        }

        if ($this->proposta->getFkusuario() != null) {
            $restrictions[2] = $criteria->restrictions()->equals("fk_usuario", $this->proposta->getFkusuario());
        }

        if ($this->proposta->getPkproposta() != null) {
            $restrictions[3] = $criteria->restrictions()->equals("pk_proposta", $this->proposta->getPkproposta());
        }
        if ($this->proposta->getData() != null) {
            $restrictions[4] = $criteria->restrictions()->like("data", $this->proposta->getData());
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
        $criteria = $phiber->openPersist($this->proposta);
        $restriction = $criteria->restrictions()->equals($campo, $campoValor);
        $criteria->add($restriction);
        return $criteria->select();
    }


}