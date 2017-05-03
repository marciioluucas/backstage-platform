<?php
/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 4/4/17
 * Time: 8:16 PM
 */
require_once 'vendor/autoload.php';

$u = new \model\Usuario();
//$u->setPkUsuario(3);
$u->setNome("Marcio");
$dao = new \dao\UsuarioDAO($u);

foreach ($dao->retreave() as $usuario) {
    echo "ID: " . $usuario['pk_usuario'] . " Nome: " . $usuario['nome'] . " Email: " . $usuario['email'] . "\n";
}