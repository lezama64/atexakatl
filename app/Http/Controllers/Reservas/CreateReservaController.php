<?php

namespace App\Http\Controllers\Reservas;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use App\Models\Ruta; // Si necesitas las rutas
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class CreateReservaController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Ruta $ruta): View
    {
        // Si necesitas cargar rutas para seleccionar
        $rutas = \App\Models\Ruta::all(); // Ajusta según tu modelo de rutas
        
        return view('reservas.create', compact('rutas'));
    }

    /**
     * Handle an incoming reservation request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validación similar a tu RegisteredUserController
        $request->validate([
            'fechaReserva' => ['required', 'date'],
            'noPersonas' => ['required', 'integer', 'min:1'],
            'whatsapp' => ['required', 'numeric', 'digits_between:10,20'],
            'comentarios' => ['nullable', 'string', 'max:255'],
            'rutasidRuta' => ['required', 'exists:rutas,idRuta'], // Ajusta según tu tabla de rutas
        ]);

                // Verificar autenticación
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Crear reserva similar a como creas usuarios
        $reserva = Reserva::create([
            'fechaReserva' => $request->fechaReserva,
            'estado' => 'pendiente', // Valor por defecto
            'noPersonas' => $request->noPersonas,
            'whatsapp' => $request->whatsapp,
            'comentarios' => $request->comentarios,
            'usuariosid' => Auth::id(), // Usuario autenticado
            'rutasidRuta' => $request->rutasidRuta,
        ]);

        // Opcional: evento de reserva creada (similar a Registered)
        // event(new ReservaCreada($reserva));

        return redirect()->route('rutas')
                        ->with('status', 'Reserva creada exitosamente!');
    }
}