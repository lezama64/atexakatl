<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mis Reservas - Laravel</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        @vite(['resources/css/custom.css'])
        @vite(['resources/js/custom.js'])
        
        <style>
        /*diseño de vista de mis-reservas.blade.php*/

                    .tabla-reservas {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                background: white;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
            
            .tabla-reservas th,
            .tabla-reservas td {
                padding: 12px 15px;
                text-align: left;
                border-bottom: 1px solid #e0e0e0;
            }
            
            .tabla-reservas th {
                background-color: #f8f9fa;
                font-weight: 600;
                color: #333;
            }
            
            .tabla-reservas tr:hover {
                background-color: #f5f5f5;
            }
            
            .estado-pendiente {
                background-color: #fff3cd;
                color: #856404;
                padding: 4px 8px;
                border-radius: 4px;
                font-size: 0.85em;
            }
            
            .estado-confirmado {
                background-color: #d1edff;
                color: #0c5460;
                padding: 4px 8px;
                border-radius: 4px;
                font-size: 0.85em;
            }

            .estado-cancelada {
                background-color: #f8d7da;
                color: #721c24;
                padding: 4px 8px;
                border-radius: 4px;
                font-size: 0.85em;
            }
            
            .btn-eliminar {
                background-color: #dc3545;
                color: white;
                border: none;
                padding: 6px 12px;
                border-radius: 4px;
                cursor: pointer;
                font-size: 0.85em;
                transition: background-color 0.3s;
            }
            
            .btn-eliminar:hover {
                background-color: #c82333;
            }
            
            .btn-eliminar:disabled {
                background-color: #6c757d;
                cursor: not-allowed;
            }
            
            .sin-reservas {
                text-align: center;
                padding: 40px;
                color: #666;
                background: white;
                border-radius: 8px;
                margin: 20px 0;
            }
            
            .paginacion {
                display: flex;
                justify-content: center;
                margin-top: 20px;
            }
            
            .paginacion .pagination {
                list-style: none;
                display: flex;
                gap: 5px;
            }
            
            .paginacion .page-item {
                margin: 0;
            }
            
            .paginacion .page-link {
                padding: 8px 12px;
                border: 1px solid #ddd;
                border-radius: 4px;
                text-decoration: none;
                color: #007bff;
            }
            
            .paginacion .page-item.active .page-link {
                background-color: #007bff;
                color: white;
                border-color: #007bff;
            }

            .alert {
                padding: 12px 15px;
                border-radius: 4px;
                margin-bottom: 20px;
            }
            
            .alert-success {
                background-color: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
            }
            
            .alert-error {
                background-color: #f8d7da;
                color: #721c24;
                border: 1px solid #f5c6cb;
            }


 
        </style>
    </head>
    <body>
        <div class="contenedor-principal">
            <!-- HEADER -->
            @include('layouts.header')

            <main class="cuerpo">
                <div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
                    <h1 style="margin-bottom: 30px; color: #333;">Mis Reservas</h1>

                    <!-- Mensajes de éxito/error -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-error">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    @if($reservas->count() > 0)
                        <table class="tabla-reservas">
                            <thead>
                                <tr>
                                    <th>Fecha Reserva</th>
                                    <th>Ruta</th>
                                    <th>N° Personas</th>
                                    <th>WhatsApp</th>
                                    <th>Estado</th>
                                    <th>Comentarios</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservas as $reserva)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($reserva->fechaReserva)->format('d/m/Y') }}</td>
                                    <td>
                                        @if($reserva->ruta)
                                            {{ $reserva->ruta->nombre ?? 'Ruta no disponible' }}
                                        @else
                                            Ruta no disponible
                                        @endif
                                    </td>
                                    <td>{{ $reserva->noPersonas }}</td>
                                    <td>{{ $reserva->whatsapp }}</td>
                                    <td>
                                        <span class="estado-{{ $reserva->estado }}">
                                            {{ ucfirst($reserva->estado) }}
                                        </span>
                                    </td>
                                    <td>{{ $reserva->comentarios ?? 'Sin comentarios' }}</td>
                                    <td>
                                        <form action="{{ route('reservas.destroy', $reserva->idReserva) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta reserva?');">
                                            @csrf
                                            @method('DELETE')
                                                <!-- Botón Editar -->
    <button class="btn-editar" onclick="mostrarFormularioEditar({{ $reserva->idReserva }})" style="background-color: #28a745; color: white; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer; font-size: 0.8em; margin-right: 5px; display: inline-flex; align-items: center; gap: 5px;">
        <i class="fas fa-edit"></i> Editar
    </button>


                                            <button type="submit" class="btn-eliminar" 
                                                    {{ $reserva->estado == 'confirmada' ? 'disabled' : '' }}
                                                    title="{{ $reserva->estado == 'confirmada' ? 'No se pueden eliminar reservas confirmadas' : 'Eliminar reserva' }}">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- PAGINACIÓN -->
                        <div class="paginacion">
                            {{ $reservas->links() }}
                        </div>
                    @else
                        <div class="sin-reservas">
                            <i class="fas fa-calendar-times" style="font-size: 48px; margin-bottom: 15px; color: #ccc;"></i>
                            <h3>No tienes reservas aún</h3>
                            <p>¡Comienza explorando nuestras rutas y haz tu primera reserva!</p>
                            <a href="{{ route('rutas') }}" style="display: inline-block; margin-top: 15px; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px;">
                                Ver Rutas Disponibles
                            </a>
                        </div>
                    @endif
                </div>
            </main>

            <!-- FOOTER -->
            @include('layouts.footer')
        </div>

        <script>
            // Confirmación adicional para eliminar
            document.addEventListener('DOMContentLoaded', function() {
                const deleteForms = document.querySelectorAll('form[onsubmit]');
                
                deleteForms.forEach(form => {
                    form.addEventListener('submit', function(e) {
                        const button = this.querySelector('button[type="submit"]');
                        if (button.disabled) {
                            e.preventDefault();
                            return false;
                        }
                    });
                });
            });

            
        // Función para redirigir a la página de edición
function mostrarFormularioEditar(reservaId) {
    window.location.href = `/reservas/${reservaId}/edit`;
}
        </script>
    </body>
</html>