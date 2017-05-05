<?php
/**
 * Created by PhpStorm.
 * User: ifgoiano
 * Date: 04/05/2017
 * Time: 20:45
 */

namespace backstage\dao;

include "../vendor/autoload.php";

use phiber\Phiber;

class PropostaDAO implements IDAO
{

    private $proposta;

    function __construct($proposta)
    {
        $this->proposta = $proposta;
    }

    function create()
    {
       $phiber = new Phiber();
       $criteria = $phiber->openPersist($this->proposta);
       if ($criteria->create()){


           return true;
       }
        print_r($criteria->show());
           return false;


    }

    function update()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->proposta);
        $restrictionID = $criteria->restrictions()->equals("pk_proposta", $this->proposta->getPkproposta());
        $criteria->add($restrictionID);
        if($criteria->update()){

            return true;
        }else{
            return false;
        }
    }

    function retreave()
    {
       $phiber = new Phiber();
       $criteria = $phiber->openPersist($this->proposta);
       $restrictions = [];

       if($this->proposta->getTitulo() != null){
           $restrictions[0] = $criteria->restrictions()->like("titulo", $this->getTitulo());
       }

        if($this->proposta->getFkusuario() != null){
            $restrictions[2] = $criteria->restrictions()->equals("fk_usuario", $this->getFkusuario());
        }

        if($this->proposta->getPkproposta() !=null){
            $restrictions[3] = $criteria->restrictions()->equals("pk_proposta", $this->getPkproposta());
        }
        if($this->proposta->getData() !=null){
            $restrictions[4] = $criteria->restrictions()->like("data", $this->getData());
        }

    }

    function delete()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->proposta);
        $restrictionID = $criteria->restrictions()->equals("pk_proposta", $this->proposta->getPkproposta());
        $criteria->add($restrictionID);
        if ($criteria->delete()) {
            return true;
        } else {
            return false;
        }


    }
}

use backstage\model\Proposta;
$proposta = new Proposta();

$proposta->setFkUsuario(1);
$proposta->setTitulo("FEiJAO");
$proposta->setDescricao("e ce come");

$DAO = new PropostaDAO($proposta);

$DAO->create();
