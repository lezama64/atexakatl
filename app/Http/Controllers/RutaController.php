<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use Illuminate\Http\Request;

class RutaController extends Controller
{

    //proposito mostrar una lista de todas las rutas
    public function index()
    {
        $rutas = Ruta::all();
        return view('rutas', compact('rutas'));
    }

    //mostrar los detalles de una ruta especifica
    public function show($id)
    {
    $ruta = Ruta::findOrFail($id);
    return view('ruta-detalle', compact('ruta'));
    }
}