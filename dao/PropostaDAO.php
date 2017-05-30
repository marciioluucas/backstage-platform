<?php
/**
 * Created by PhpStorm.
 * User: ifgoiano
 * Date: 04/05/2017
 * Time: 20:45
 */

namespace backstage\dao;

use backstage\model\Voto;
use backstage\util\Message;
use phiber\Phiber;
use backstage\model\Proposta;
use backstage\model\Usuario;
use backstage\dao\VotoDAO;


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
        $restrictions[0] = $criteria->restrictions()->equals("ativado", 1);

        if ($this->proposta->getTitulo() != null) {
            $restrictions[1] = $criteria->restrictions()->like("titulo", $this->proposta->getTitulo());
        }

        if ($this->proposta->getAprovado() != null) {
            $restrictions[2] = $criteria->restrictions()->like("aprovado", $this->proposta->getAprovado());
        }

        if ($this->proposta->getFkUsuario() != null) {
            $restrictions[3] = $criteria->restrictions()->equals("fk_usuario", $this->proposta->getFkUsuario());
        }

        if ($this->proposta->getPkProposta() != null) {
            $restrictions[4] = $criteria->restrictions()->equals("pk_proposta", $this->proposta->getPkProposta());
        }
        if ($this->proposta->getData() != null) {
            $restrictions[5] = $criteria->restrictions()->like("data", $this->proposta->getData());
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


    function retreavePorTitulo()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->proposta);
        $restrictions = $criteria->restrictions()->like("titulo", $this->proposta->getTitulo());
        $criteria->add($restrictions);
        return $criteria->select();
    }

    function retreaveCondicaoCadastrar($campo, $campoValor)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->proposta);
        $restriction = $criteria->restrictions()->equals($campo, $campoValor);
        $criteria->add($restriction);
        return $criteria->select();
    }

    function retreavePorUsuario()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->proposta);
        $restrictions = [];
        $restrictions[0] = $criteria->restrictions()->equals("ativado", 1);

        if ($this->proposta->getFkUsuario() != null) {
            $restrictions[1] = $criteria->restrictions()->equals("fk_usuario", $this->proposta->getFkUsuario());
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

    function retreavePorData()
    {
        $restrictions = [];
        $selects = [];
        for ($a = 1; $a == 7; $a++) {
            $phiber = new Phiber();
            $criteria = $phiber->openPersist($this->proposta);
            $criteria->returnArray(true);


            $mes = date('m', strtotime('-' . $a . 'month'));
            $restrictions[$a - 1] = $criteria->restrictions()->equals("data", $mes);

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
            $selects[$a] = $criteria->select();

        }
        return $selects;
    }

    public function listarPorVoto()
    {
        $this->proposta->setAtivado(1);
        $selectPropostas = $this->retreave();
        $propostasComVotos = [];
        $cont = [];
        for ($i = 0; $i < count($selectPropostas); $i++) {
            $voto = new Voto($selectPropostas[$i]['pk_proposta']);
            $propostasComVotos[$i] = $selectPropostas[$i];
            $propostasComVotos[$i]['contagem'] = $voto->contar();
        }

//        arsort($propostasComVotos);
//        $propostasFinal = [];
//        for ($j = 0; $j < 10; $j++) {
//            $propostasFinal[$j] = $propostasComVotos[$j];
//        }
        return $propostasComVotos;
    }

    public function delete()
    {

        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->proposta);
        $restrictionsID = $criteria->restrictions()->equals('pk_proposta', $this->proposta->getPkProposta());
        $criteria->add($restrictionsID);
        if ($this->proposta->setAprovado("'0'")) {
            return true;
        }
        return false;

    }


}