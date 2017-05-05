<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
include '../vendor/autoload.php';
$url = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

if (!isset($url['query'])) {
    $response = new \backstage\util\Message(
        "Erro na API, requisição sem parâmetros",
        "erro", ["icone" => "error"]
    );
    echo $response->geraJsonMensagem();
} else {


    $arrayArgsSemFiltro = explode('&', $url['query']);
    $arrayArgsFiltrado = [];
    foreach ($arrayArgsSemFiltro as $arg) {
        $x = explode('=', $arg);
        $arrayArgsFiltrado[$x[0]] = $x[1];
    }


    if (!isset($method)) {
        $response = new \backstage\util\Message(
            "Erro na API, metodo especificado nao especificada.",
            "erro", ["icone" => "error"]
        );
        echo $response->geraJsonMensagem();
    } else if (!isset($class)) {
        $response = new \backstage\util\Message(
            "Erro na API, classe especificada especificada.",
            "erro", ["icone" => "error"]
        );
        echo $response->geraJsonMensagem();
    } else {
        $class = ucfirst($arrayArgsFiltrado['classe']) . "Controller";
        $method = $arrayArgsFiltrado['metodo'];

        unset($arrayArgsFiltrado['classe']);
        unset($arrayArgsFiltrado['metodo']);

        new \backstage\api\Rest($class, $method, $arrayArgsFiltrado, $_SERVER['REQUEST_METHOD']);

    }
}