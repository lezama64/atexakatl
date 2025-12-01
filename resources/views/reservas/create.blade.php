@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Crear Nueva Reserva</h1>

    <form action="{{ route('reservas.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="fechaReserva" class="block text-sm font-medium text-gray-700">Fecha Reserva</label>
                <input type="date" name="fechaReserva" id="fechaReserva" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>

            <div>
                <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                <select name="estado" id="estado" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="pendiente">Pendiente</option>
                    <option value="confirmada">Confirmada</option>
                    <option value="cancelada">Cancelada</option>
                    <option value="completada">Completada</option>
                </select>
            </div>

            <div>
                <label for="noPersonas" class="block text-sm font-medium text-gray-700">Número de Personas</label>
                <input type="number" name="noPersonas" id="noPersonas" min="1" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>

            <div>
                <label for="whatsapp" class="block text-sm font-medium text-gray-700">WhatsApp</label>
                <input type="number" name="whatsapp" id="whatsapp" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>

            <div>
                <label for="usuariosid" class="block text-sm font-medium text-gray-700">Usuario</label>
                <select name="usuariosid" id="usuariosid"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="">Seleccionar Usuario</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="rutasidRuta" class="block text-sm font-medium text-gray-700">Ruta</label>
                <select name="rutasidRuta" id="rutasidRuta"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="">Seleccionar Ruta</option>
                    @foreach($rutas as $ruta)
                        <option value="{{ $ruta->idRuta }}">{{ $ruta->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-4">
            <label for="comentarios" class="block text-sm font-medium text-gray-700">Comentarios</label>
            <textarea name="comentarios" id="comentarios" rows="3" maxlength="255"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                placeholder="Comentarios adicionales..."></textarea>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('reservas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Crear Reserva
            </button>
        </div>
    </form>
</div>
@endsection