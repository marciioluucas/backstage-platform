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
        if ($this->usuario->getLogin() != null) {
            $restrictions[5] = $criteria->restrictions()
                ->like("login", $this->usuario->getLogin());
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

    function retreaveCondicaoLoginExistenteCadastrar()
    {

        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->usuario);

        $restriction = $criteria->restrictions()
            ->equals("login", $this->usuario->getLogin());

        $criteria->add($restriction);
        return $criteria->select();
    }

    function retreaveParaAlterar() {
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

    function retreaveCondicaoLoginExistenteAlterar()
    {

        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->usuario);

        $restriction1 = $criteria->restrictions()
            ->equals("login", $this->usuario->getLogin());

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
            ->equals("email", $this->usuario->getLogin());

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

        $restriction = $criteria->restrictions()
            ->equals("login", $this->usuario->getLogin());


        $restriction2 = $criteria->restrictions()
            ->equals("email", $this->usuario->getEmail());

        $restriction3 = $criteria->restrictions()
            ->equals("senha", $this->usuario->getSenha());

        $condOr = $criteria->restrictions()->either($restriction, $restriction2);
        $condAnd = $criteria->restrictions()->and($condOr, $restriction3);

        $criteria->add($condAnd);
        if (count($criteria->select()) > 0) {
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
        return $criteria->select();

    }
}
