<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use App\Models\Ruta; // Si necesitas las rutas
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{

        public function index(): View
    {
        // Obtener solo las reservas del usuario autenticado
        $reservas = Reserva::with('ruta') // Cargar la relación con ruta
                        ->where('usuariosid', Auth::id())
                        ->orderBy('fechaReserva', 'desc')
                        ->paginate(10);

        return view('mis-reservas', compact('reservas'));
    }




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



public function pendientes(): View
    {
        // Obtener todas las reservas con estado 'pendiente'
        $reservasPendientes = Reserva::with('ruta', 'usuario')
                                    ->where('estado', 'pendiente')
                                    ->orderBy('fechaReserva', 'asc')
                                    ->paginate(15);
        return view('reservaciones-por-confirmar', compact('reservasPendientes'));
    }

    /**
     * Actualizar el estado de una reserva
     */
    public function actualizarEstado(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'estado' => ['required', 'in:pendiente,confirmada,cancelada']
        ]);

        $reserva = Reserva::findOrFail($id);
        $reserva->update([
            'estado' => $request->estado
        ]);

        return redirect()->route('reservaciones-por-confirmar')
                        ->with('success', 'Estado de reserva actualizado correctamente.');
    }

    /**
     * Obtener reservas confirmadas (opcional - si necesitas esta funcionalidad)
     */
    public function confirmadas(): View
    {
        $reservasConfirmadas = Reserva::with('ruta', 'usuario')
                                    ->where('estado', 'confirmada')
                                    ->orderBy('fechaReserva', 'asc')
                                    ->paginate(15);

        return view('reservaciones-confirmadas', compact('reservasConfirmadas'));
    }

        /**
     * Eliminar una reserva
     */
public function destroy($id): RedirectResponse
{
    try {
        $reserva = Reserva::findOrFail($id);
        
        // VERIFICACIÓN CORREGIDA: Usa la misma lógica que tu middleware
        if ($reserva->usuariosid != Auth::id() && Auth::user()->rol !== 'admin') {
            abort(403, 'No tienes permisos para eliminar esta reserva.');
        }
        
        $reserva->delete();
        
        // ✅ REDIRIGIR A LA VISTA ACTUAL EN LUGAR DE UNA ESPECÍFICA
        return redirect()->back()
                        ->with('success', 'Reserva #' . $reserva->idReserva . ' eliminada correctamente.');
                            
    } catch (\Exception $e) {
        return redirect()->back()
                        ->with('error', 'Error al eliminar la reserva: ' . $e->getMessage());
    }
}


    /**
     * Mostrar formulario para editar reserva
     */
    public function edit($id): View
    {
        $reserva = Reserva::findOrFail($id);
        
        // Verificar permisos
        if ($reserva->usuariosid != Auth::id() && Auth::user()->rol !== 'admin') {
            abort(403, 'No tienes permisos para editar esta reserva.');
        }

        $rutas = Ruta::all(); // Para mostrar en el select si es necesario
        
        return view('reservas.edit', compact('reserva', 'rutas'));
    }


    /**
     * Actualizar una reserva existente
     */
    public function update(Request $request, $id): RedirectResponse
    {   
        $reserva = Reserva::findOrFail($id);
        
        // Verificar permisos
        if ($reserva->usuariosid != Auth::id() && Auth::user()->rol !== 'admin') {
            abort(403, 'No tienes permisos para editar esta reserva.');
        }

        $request->validate([
            'fechaReserva' => ['required', 'date'],
            'noPersonas' => ['required', 'integer', 'min:1'],
            'whatsapp' => ['required', 'numeric', 'digits_between:10,20'],
            'comentarios' => ['nullable', 'string', 'max:255'],
            'rutasidRuta' => ['required', 'exists:rutas,idRuta'],
        ]);

        // Actualizar la reserva y cambiar estado a 'pendiente'
        $reserva->update([
            'fechaReserva' => $request->fechaReserva,
            'noPersonas' => $request->noPersonas,
            'whatsapp' => $request->whatsapp,
            'comentarios' => $request->comentarios,
            'rutasidRuta' => $request->rutasidRuta,
            'estado' => 'pendiente' // Estado vuelve a pendiente al editar
        ]);

        // Redirigir según el tipo de usuario
        if (Auth::user()->rol === 'admin') {
            return redirect()->route('reservaciones-confirmadas')
                            ->with('success', 'Reserva actualizada y estado cambiado a pendiente.');
        }

        return redirect()->route('mis-reservas')
                        ->with('success', 'Reserva actualizada exitosamente. Estado: pendiente');
    }


}



