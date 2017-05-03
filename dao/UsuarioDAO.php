<?php

/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 4/25/17
 * Time: 10:35 PM
 */

namespace dao;


use model\Usuario;
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
            $restrictions[1] = $criteria->restrictions()
                ->equals("pk_usuario", $this->usuario->getLogin());

        }

        $restrictions = array_values($restrictions);
        if (count($restrictions) > 1) {
            for ($i = 0; $i < count($restrictions) - 1; $i++) {
                $criteria->add($criteria->restrictions()
                    ->and($restrictions[$i], $restrictions[$i + 1]));
            }
        } else {
            $criteria->add($restrictions[0]);
        }

        $criteria->select();
        print_r($criteria->show());


    }

    function update()
    {
        // TODO: Implement update() method.
    }

    function delete()
    {
        // TODO: Implement delete() method.
    }
}
