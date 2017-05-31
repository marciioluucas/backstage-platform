<?php
date_default_timezone_set('America/Sao_Paulo');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT");

header("Content-Type: application/json; charset=utf-8");
include '../vendor/autoload.php';

$urlSemFiltro = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$arrayUrl = explode("/", $urlSemFiltro);
$apiBaseIndex = array_search('api', $arrayUrl);

$url = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
//if (!isset($url['query'])) {
//    $response = new \backstage\util\Message(
//        "Erro na API, requisição sem parâmetros",
//        "erro", ["icone" => "error"]
//    );
//    echo $response->geraJsonMensagem();
//} else {


if (isset($url['query'])) {

    $arrayArgsSemFiltro = explode('&', $url['query']);
    $args = [];
    foreach ($arrayArgsSemFiltro as $arg) {
        $x = explode('=', $arg);
        $args[urldecode($x[0])] = urldecode($x[1]);
    }
}else{
    $args = null;
}
//    $class = isset($args['classe']) ? ucfirst($args['classe']) . "Controller" : null;
$class = $arrayUrl[$apiBaseIndex + 1] ? ucfirst($arrayUrl[$apiBaseIndex + 1]) . "Controller" : null;
//$method = $arrayUrl[$apiBaseIndex + 2] ? $arrayUrl[$apiBaseIndex + 2] : null;

//if (!isset($method)) {
//    $response = new \backstage\util\Message(
//        "Erro na API, metodo nao especificado.",
//        "erro", ["icone" => "error"]
//    );
//    echo $response->geraJsonMensagem();
if (!isset($class)) {
    $response = new \backstage\util\Message(
        "Erro na API, classe especificada.",
        "erro", ["icone" => "error"]
    );
    echo $response->geraJsonMensagem();
} else {

    new \backstage\api\Rest($class, $args, $_SERVER['REQUEST_METHOD']);

//    }
}
