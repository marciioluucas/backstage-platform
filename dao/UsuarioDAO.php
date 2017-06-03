<?php

/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 4/25/17
 * Time: 10:35 PM
 */

namespace backstage\dao;


use backstage\model\Usuario;
use phiber\Phiber;

class UsuarioDAO implements IDAO
{


    /**
     * @var Usuario
     */
    private $usuario;

    function __construct($usuario)
    {
        $this->usuario = $usuario;
    }

    function create()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->usuario);
        if ($criteria->create()) {
            return true;
        } else {
            return false;
        }
    }

    function retreave()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->usuario);
        $restrictions = [];

        $restrictions[0] = $criteria->restrictions()
            ->equals("ativado", '1');

        if ($this->usuario->getPkUsuario() != null) {
            $restrictions[1] = $criteria->restrictions()
                ->equals("pk_usuario", $this->usuario->getPkUsuario());
        }
        if ($this->usuario->getNome() != null) {
            $restrictions[2] = $criteria->restrictions()
                ->like("nome", $this->usuario->getNome());
        }
        if ($this->usuario->getEmail() != null) {
            $restrictions[3] = $criteria->restrictions()
                ->like("email", $this->usuario->getEmail());
        }
        if ($this->usuario->getMatricula() != null) {
            $restrictions[4] = $criteria->restrictions()
                ->like("matricula", $this->usuario->getMatricula());
        }

        if ($this->usuario->getNivel() != null) {
            $restrictions[6] = $criteria->restrictions()
                ->like("nivel", $this->usuario->getNivel());
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
        $slct = $criteria->select();
        if ($criteria->rowCount() == 1) {
            return [$slct];
        }
        return $slct;

    }

    function retreaveCondicaoMatriculaExistenteCadastrar()
    {

        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->usuario);

        $restriction = $criteria->restrictions()
            ->equals("matricula", $this->usuario->getMatricula());

        $criteria->add($restriction);
        return $criteria->select();
    }

    function retreaveByPk()
    {

        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->usuario);

        $restriction = $criteria->restrictions()
            ->equals("pk_usuario", $this->usuario->getPkUsuario());

        $criteria->add($restriction);
        return $criteria->select();
    }

    function retreaveBy($campo, $valor)
    {

        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->usuario);

        $restriction = $criteria->restrictions()
            ->equals($campo, $valor);

        $criteria->add($restriction);
        return $criteria->select();
    }

    function retreaveParaAlterar()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->usuario);

        $restriction = $criteria->restrictions()
            ->equals("pk_usuario", $this->usuario->getPkUsuario());

        $criteria->add($restriction);
        return $criteria->select();
    }

    function retreaveCondicaoEmailExistenteCadastrar()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->usuario);
        $restriction = $criteria->restrictions()
            ->equals("email", $this->usuario->getEmail());
        $criteria->add($restriction);
        return $criteria->select();
    }

    function retreaveCondicaoMatriculaExistenteAlterar()
    {

        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->usuario);

        $restriction1 = $criteria->restrictions()
            ->equals("matricula", $this->usuario->getMatricula());

        $restriction2 = $criteria->restrictions()
            ->different("pk_usuario", $this->usuario->getPkUsuario());

        $condAnd = $criteria->restrictions()
            ->and($restriction1, $restriction2);
        $criteria->add($condAnd);
        return $criteria->select();
    }

    function retreaveCondicaoEmailExistenteAlterar()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->usuario);

        $restriction1 = $criteria->restrictions()
            ->equals("email", $this->usuario->getEmail());

        $restriction2 = $criteria->restrictions()
            ->different("pk_usuario", $this->usuario->getPkUsuario());

        $condAnd = $criteria->restrictions()
            ->and($restriction1, $restriction2);
        $criteria->add($condAnd);
        return $criteria->select();
    }


    function update()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->usuario);
        $restrictionID = $criteria->restrictions()->equals("pk_usuario", $this->usuario->getPkUsuario());
        $criteria->add($restrictionID);
        if ($criteria->update()) {
            return true;
        }
        return false;
    }

    function logar()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->usuario);


        $restrictionSenha = $criteria->restrictions()
            ->equals("senha", $this->usuario->getSenha());


        $restriction = $criteria->restrictions()
            ->equals("email", $this->usuario->getEmail());


        $cond = $criteria->restrictions()->and($restriction, $restrictionSenha);

        $criteria->add($cond);
        $criteria->select();
        if ($criteria->rowCount() > 0) {
            return true;
        }
        return false;
    }

    function retreaveUsuarioForGraph()
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->usuario);
        $restriction = $criteria->restrictions()
            ->equals("ativado", $this->usuario->getAtivado());

        $criteria->add($criteria->restrictions()->fields(["pk_usuario"]));
        $criteria->add($restriction);

        $criteria->returnArray(true);
        $slct = $criteria->select();
        $qntReg = count($slct);
        if ($qntReg == 1) {
            return [$slct];
        }
        return $slct;

    }
}
