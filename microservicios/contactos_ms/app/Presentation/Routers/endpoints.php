<?php

use App\Presentation\Repositories\ContactosRepository;
use App\Presentation\Repositories\TestRepository;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->get('/', [TestRepository::class, 'default']);
    $app->get('/suma', [TestRepository::class, 'sumar1']);
    $app->post('/suma', [TestRepository::class, 'sumar2']);
    $app->post('/dividir', [TestRepository::class, 'dividir']);

    $app->get('/contactos', [ContactosRepository::class, 'list']);
    $app->post('/contacto', [ContactosRepository::class, 'create']);
    $app->put('/contacto/{id}', [ContactosRepository::class, 'update']);
    $app->delete('/contacto/{id}', [ContactosRepository::class, 'delete']);
    $app->get('/contacto/{id}', [ContactosRepository::class, 'detail']);

    $app->group('/contactos-v2', function(RouteCollectorProxy $group){
        $group->get('', [ContactosRepository::class, 'list']);
        $group->get('/{id}', [ContactosRepository::class, 'detail']);
        $group->post('', [ContactosRepository::class, 'create']);
        $group->put('/{id}', [ContactosRepository::class, 'update']);
        $group->delete('/{id}', [ContactosRepository::class, 'delete']);
    });
};
