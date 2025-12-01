@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Detalles de Reserva #{{ $reserva->idReserva }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div>
            <label class="block text-sm font-medium text-gray-700">ID Reserva:</label>
            <p class="mt-1 text-lg">{{ $reserva->idReserva }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Fecha Reserva:</label>
            <p class="mt-1 text-lg">{{ $reserva->fechaReserva->format('d/m/Y') }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Estado:</label>
            <span class="mt-1 px-3 py-1 rounded-full text-sm font-medium 
                @if($reserva->estado == 'confirmada') bg-green-100 text-green-800
                @elseif($reserva->estado == 'pendiente') bg-yellow-100 text-yellow-800
                @elseif($reserva->estado == 'completada') bg-blue-100 text-blue-800
                @else bg-red-100 text-red-800 @endif">
                {{ ucfirst($reserva->estado) }}
            </span>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Número de Personas:</label>
            <p class="mt-1 text-lg">{{ $reserva->noPersonas }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">WhatsApp:</label>
            <p class="mt-1 text-lg">{{ $reserva->whatsapp }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Usuario:</label>
            <p class="mt-1 text-lg">{{ $reserva->usuario->nombre ?? 'No asignado' }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Ruta:</label>
            <p class="mt-1 text-lg">{{ $reserva->ruta->nombre ?? 'No asignada' }}</p>
        </div>
    </div>

    @if($reserva->comentarios)
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700">Comentarios:</label>
        <p class="mt-1 p-3 bg-gray-50 rounded border">{{ $reserva->comentarios }}</p>
    </div>
    @endif

    <div class="flex justify-end space-x-3">
        <a href="{{ route('reservas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Volver a la Lista
        </a>
        <a href="{{ route('reservas.edit', $reserva) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Editar Reserva
        </a>
    </div>
</div>
@endsection