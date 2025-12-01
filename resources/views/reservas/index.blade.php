<x-app-layout>
    <x-slot name="content">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Lista de Reservas</h1>
                <a href="{{ route('reservas.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Nueva Reserva
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Fecha</th>
                            <th class="px-4 py-2 text-left">Estado</th>
                            <th class="px-4 py-2 text-left">Personas</th>
                            <th class="px-4 py-2 text-left">WhatsApp</th>
                            <th class="px-4 py-2 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservas as $reserva)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $reserva->idReserva }}</td>
                            <td class="px-4 py-2">{{ $reserva->fechaReserva->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded text-xs font-medium 
                                    @if($reserva->estado == 'confirmada') bg-green-100 text-green-800
                                    @elseif($reserva->estado == 'pendiente') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($reserva->estado) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">{{ $reserva->noPersonas }}</td>
                            <td class="px-4 py-2">{{ $reserva->whatsapp }}</td>
                            <td class="px-4 py-2">
                                <div class="flex space-x-2">
                                    <a href="{{ route('reservas.edit', $reserva) }}" class="text-green-600 hover:text-green-900">Editar</a>
                                    <form action="{{ route('reservas.destroy', $reserva) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" 
                                                onclick="return confirm('¿Estás seguro de eliminar esta reserva?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $reservas->links() }}
            </div>
        </div>
    </x-slot>
</x-app-layout>