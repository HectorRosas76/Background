<?php

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->get('/suma', function (Request $request, Response $response) {
    $parm = $request->getQueryParams();
    $num1 = $parm['num1'];
    $num2 = $parm['num2'];
    $suma = $num1 + $num2;
    $response->getBody()->write("la suma de $num1 + $num2 es igual a $suma");
    return $response;
});

$app->post('/suma', function (Request $request, Response $response) {
    $body = $request->getBody()->getContents();
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
    return $response->withHeader('Content-Type', 'application/json');
});
//$endpoints = require __DIR__.'/../app/Presentation/Routers/endpoints.php';

$app->post('/multiplicar', function (Request $request, Response $response) {
    $body = $request->getBody()->getContents();
    $data = json_decode($body, true);
    $num1 = $data['num1'];
    $num2 = $data['num2'];
    $result = [
        'num1' => $num1,
        'num2' => $num2,
        'resultado' => $num1 * $num2
    ];
    $response->getBody()->write(json_encode($result));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/dividir', function (Request $request, Response $response) {
    $body = $request->getBody()->getContents();
    $data = json_decode($body, true);
    $num1 = $data['num1'];
    $num2 = $data['num2'];
    if ($num2 == 0){
        $response->getBody()->write("NO se puede dividir por 0");
    return $response->withStatus(400);
    }
    $result = [
        'num1' => $num1,
        'num2' => $num2,
        'resultado' => $num1 / $num2
    ];
    $response->getBody()->write(json_encode($result));
    return $response->withHeader('Content-Type', 'application/json');
});

};