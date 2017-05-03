<?php
/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 4/4/17
 * Time: 8:16 PM
 */
require_once 'vendor/autoload.php';

$u = new \model\Usuario();
$u->setLogin("LALALA");
$u->setNome("LALALA");
$u->setPkUsuario("LALALA");
$dao = new \dao\UsuarioDAO($u);
$dao->retreave();