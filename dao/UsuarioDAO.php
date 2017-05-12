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
        if ($this->usuario->getNome() != null) {
            $restrictions[0] = $criteria->restrictions()
                ->like("nome", $this->usuario->getNome());
        }

        if ($this->usuario->getLogin() != null) {
            $restrictions[1] = $criteria->restrictions()
                ->equals("login", $this->usuario->getLogin());
        }

        if ($this->usuario->getPkUsuario() != null) {
            $restrictions[2] = $criteria->restrictions()
                ->equals("pk_usuario", $this->usuario->getPkUsuario());
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

    function retreaveCondicaoLoginExistente()
    {

        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->usuario);
        $restriction = $criteria->restrictions()
            ->equals("login", $this->usuario->getLogin());
        $criteria->add($restriction);
        return $criteria->select();
    }

    function retreaveCondicaoEmailExistente()
    {

        $phiber = new Phiber();
        $criteria = $phiber->openPersist($this->usuario);
        $restriction = $criteria->restrictions()
            ->equals("email", $this->usuario->getEmail());
        $criteria->add($restriction);
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

    function delete()
    {
        // TODO: Implement delete() method.
    }
}
