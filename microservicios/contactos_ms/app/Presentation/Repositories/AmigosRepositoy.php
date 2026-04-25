<?php

namespace App\Presentation\Repositories;

use App\Controllers\AmigosController;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ContactosRepository
{
    function list(Request $request, Response $response)
    {
        $controller = new AmigosController();
        $amigos = $controller->getAmigo();
        $dataJson = $amigos->toJson();
        $response->getBody()->write($dataJson);
        return $response
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json');
    }

    function create(Request $request, Response $response)
    {
        try {
            $body = $request->getBody()->getContents();
            $data = json_decode($body, true);
            $controller = new AmigosController();
            $amigos = $controller->guardarAmigo($data);
            $dataJson = $amigos->toJson();
            $response->getBody()->write($dataJson);
            return $response
                ->withStatus(201)
                ->withHeader('Content-Type', 'application/json');
        } catch (Exception $ex) {
            $code = 400;
            if ($ex->getCode() == 1) {
                $code = 406;
                $response->getBody()->write(json_encode(['msg' => 'Datos erroneos']));
            } else {
                $response->getBody()->write(json_encode(['msg' => 'Error en el servicio']));
            }
            return $response
                ->withStatus($code)
                ->withHeader('Content-Type', 'application/json');
        }
    }

    function update(Request $request, Response $response, $args)
    {
        $id = $args['id'];
        $body = $request->getBody()->getContents();
        $data = json_decode($body, true);
        $controller = new AmigosController();
        $usuario = $controller->modificarAmigos($id, $data);
        $dataResponse = $usuario->toJson();
        $response->getBody()->write($dataResponse);
        return $response
            ->withStatus(200)
            ->withHeader("Content-Type", 'application/json');
    }

    function delete(Request $request, Response $response, $args){
        $id = $args['id'];
        $controller = new AmigosController();
        $estado = $controller->borrarAmigo($id);
        $dataResponse = json_encode(['msg'=>'Contacto borrado']);
        $response->getBody()->write($dataResponse);
        return $response
            ->withStatus(200)
            ->withHeader("Content-Type", 'application/json');
    }

    function detail(Request $request, Response $response, $args){
        $id = $args['id'];
        $controller = new AmigosController();
        $amigos = $controller->getAmigo($id);
        $dataResponse = $amigos->toJson();
        $response->getBody()->write($dataResponse);
        return $response
            ->withStatus(200)
            ->withHeader("Content-Type", 'application/json');
    }
}
