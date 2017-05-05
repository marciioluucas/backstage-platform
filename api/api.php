<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
include '../vendor/autoload.php';
$url = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
//var_dump($url);
if (!isset($url['query'])) {
    $response = new \backstage\util\Message(
        "Erro na API, requisição sem parâmetros",
        "erro", ["icone" => "error"]
    );
    echo $response->geraJsonMensagem();
}else {
    new \backstage\api\Rest($url,$_SERVER['REQUEST_METHOD']);
}