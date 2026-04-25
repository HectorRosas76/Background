<?php

namespace App\Controllers;

use App\Models\Contacto;
use Exception;

class ContactosController
{
    function getContactos(){
        return Contacto::all();
    }

    function guardarContacto($data)
    {
        if (empty($data['nombre']) || empty($data['email'])) {
            throw new Exception("Falta el nombre o el email", 1);
        }
        $conctato = new Contacto();
        $conctato->nombre = $data['nombre'];
        $conctato->email = $data['email'];
        $conctato->telefono = empty($data['telefono']) ? null : $data['telefono'];
        $conctato->save();
        return $conctato;
    }

    function getContacto($id){
        $conctato = Contacto::find($id);
        if(empty($conctato)){
            throw new Exception("Contacto $id no exixte", 2);
        }
        return $conctato;
    }

    function modificarContacto($id, $data){
        $conctato = $this->getContacto($id);
        $conctato->nombre = $data['nombre'];
        $conctato->email = $data['email'];
        $conctato->telefono = empty($data['telefono']) ? null : $data['telefono'];
        $conctato->save();
        return $conctato;
    }

    function borrarContacto($id){
        $conctato = $this->getContacto($id);
        $conctato->delete();
        return TRUE;
    }
}
