<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class ActividadController extends Controller
{
 
    public function create()
    {
        return view('actividades.create');
    }

    public function store(Request $request)
    {
        return 'ÉXITO: El usuario está autenticado como ' . auth()->user()->usuario_nombre;
    }
}