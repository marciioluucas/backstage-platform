<?php
/**
 * Created by PhpStorm.
 * User: lukee
 * Date: 4/4/17
 * Time: 8:16 PM
 */
require_once 'vendor/autoload.php';

//$u = new \model\Usuario();
//
//$u->setPkUsuario(2);
//$u->setNome("Lucas");
//$u->setEmail("lucas@gmail.com");
//$u->setMatricula("1234");
//$u->setLogin("lukinhalokao");
//$u->setSenha("1111");
//
//$dao = new \dao\UsuarioDAO($u);
//$dao->update();
//
//$u2 = new \model\Usuario();
////$u2->setNome("Ju");
//$dao2 = new \dao\UsuarioDAO($u2);
//
//foreach ($dao2->retreave() as $usuario) {
//    echo "ID: " . $usuario['pk_usuario'] . " Nome: " . $usuario['nome'] . " Email: " . $usuario['email'] . "\n";
//}

use model\Proposta;
use dao\PropostaDAO;
include "vendor/autoload.php";
$proposta = new Proposta();

$proposta->setTitulo("Arroiz");
$proposta->setDescricao("e ce come");

$DAO = new PropostaDAO($proposta);

$DAO->create();
