<?php

use LDAP\Result;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->get('/suma', function(Request $request, Response $response){
    $parm = $request-> getQueryParams();
    $num1 = $parm['num1'];
     $num2 = $parm['num2'];
$suma = $num1 + $num2;
    $response->getBody()->write("la suma de $num1 + $num2 es igual a $suma");
    return $response;
});

$app->post('/suma', function(Request $request, Response $response){
   $body = $request ->getBody()->getContents();
   $data = json_decode($body, true); 
   $num1 = $data['num1'];
     $num2 = $data['num2'];
$suma = $num1 + $num2;
$result = [
'num1' => $num1,
'num2' => $num2,
'resultado' => $suma
];
    $response->getBody()->write(json_encode($result));
    return $response -> withHeader('Content-Type', 'application/json');
});

$app->run();
