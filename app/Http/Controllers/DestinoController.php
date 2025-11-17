<?php

namespace App\Http\Controllers;

use App\Models\Destino;
use Illuminate\Http\Request;

class DestinoController extends Controller
{

    //proposito mostrar una lista de todas las rutas
    public function index()
    {
        $destinos = Destino::all();
        return view('destinos', compact('destinos'));
    }

    //mostrar los detalles de una ruta especifica
    public function show($id)
    {
    $destino = Destino::findOrFail($id);
    return view('destino-detalle', compact('destino'));
    }
}