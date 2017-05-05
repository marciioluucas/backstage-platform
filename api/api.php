<?php
header("Content-Type: application/json; charset=utf-8");

include '../vendor/autoload.php';
include '../controller/' . $_GET['classe'] . 'Controller.php';
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//echo $url;
new \backstage\api\Rest(parse_url($url));

