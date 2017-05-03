<?php
/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 4/4/17
 * Time: 8:16 PM
 */
require_once 'vendor/autoload.php';

$u = new \model\Usuario();
$u->setNome("Marcio");
//$u->setPkUsuario(5);
$dao = new \dao\UsuarioDAO($u);

foreach ($dao->retreave() as $usuario){
    echo "Nome: ". $usuario['nome'] . " Email: " . $usuario['email'] . "\n";
}