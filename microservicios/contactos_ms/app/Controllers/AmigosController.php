<?php

namespace App\Controllers;

use App\Models\Amigo;
use Exception;

class AmigosController
{
    function getAmigo(){
        return Amigo::all();
    }

    function guardarAmigo($data)
    {
        if (empty($data['nombre']) || empty($data['telefono'])) {
            throw new Exception("Falta el nombre o el telefono", 1);
        }
        $amigos = new Amigo();
        $amigos->nombre = $data['nombre'];
        $amigos->telefono = empty($data['apodo']) ? null : $data['apodo'];
        $amigos->email = $data['telefono'];
        $amigos->telefono = empty($data['email']) ? null : $data['email'];
        $amigos->save();
        return $amigos;
    }

    function getAmigo($id){
        $amigo = Amigo::find($id);
        if(empty($amigo)){
            throw new Exception("Contacto $id no exixte", 2);
        }
        return $amigo;
    }

    function modificarAmigos($id, $data){
        $amigos->nombre = $data['nombre'];
        $amigos->telefono = empty($data['apodo']) ? null : $data['apodo'];
        $amigos->email = $data['telefono'];
        $amigos->telefono = empty($data['email']) ? null : $data['email'];
        $amigos->save();
        return $amigos;
    }

    function borrarAmigo($id){
        $amigos = $this->getAmigo($id);
        $amigos->delete();
        return TRUE;
    }
}
