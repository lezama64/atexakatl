<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservaciones Confirmadas</title>
    
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

/*diseño de vista reservaciones confirmadas*/

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .contenedor-principal {
            flex: 1;
            padding: 20px;
        }

        .titulo {
            color: #be3308;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #be3308;
        }

        .tabla-contenedor {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .tabla-reservas {
            width: 100%;
            border-collapse: collapse;
        }
        
        .tabla-reservas thead {
            background: #be3308;
        }
        
        .tabla-reservas th {
            padding: 15px 12px;
            text-align: left;
            color: white;
            font-weight: 600;
            font-size: 0.9em;
        }
        
        .tabla-reservas td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
            color: #333;
        }
        
        .tabla-reservas tbody tr:hover {
            background-color: #f8f9fa;
        }
        
        .tabla-reservas tbody tr:last-child td {
            border-bottom: none;
        }

        .badge-estado {
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.8em;
            font-weight: 600;
        }
        
        .badge-pendiente {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .badge-confirmada {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-cancelada {
            background-color: #f8d7da;
            color: #721c24;
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
            padding: 15px;
            background: white;
            border-radius: 8px;
        }

        .resumen {
            padding: 12px 15px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            color: #666;
            font-size: 0.9em;
        }

        .numero-personas {
            background: #e3f2fd;
            padding: 4px 8px;
            border-radius: 10px;
            font-weight: 600;
            display: inline-block;
        }

        /* Botones de acción */
        .btn-eliminar {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.8em;
            transition: background-color 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .btn-eliminar:hover {
            background-color: #c82333;
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

        /* Modal de confirmación - NUEVO */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-contenido {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            max-width: 90%;
            text-align: center;
        }

        .modal-botones {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-cancelar-modal {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-eliminar-modal {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .contenedor-principal {
                padding: 10px;
            }
            
            .tabla-contenedor {
                overflow-x: auto;
            }
            
            .tabla-reservas {
                min-width: 900px;
            }
        }


    </style>
</head>
<body>
    <!-- Header -->
    @include('layouts.header')

    <!-- Contenido Principal -->
    <div class="contenedor-principal">
        <div style="max-width: 1400px; margin: 0 auto;">
            <h1 class="titulo">Reservaciones confirmadas</h1>

            <!-- Mensajes de éxito/error -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif
            
            @if(isset($reservasConfirmadas) && $reservasConfirmadas->count() > 0)
                <div class="tabla-contenedor">
                    <table class="tabla-reservas">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Ruta</th>
                                <th>Fecha Reserva</th>
                                <th>Personas</th>
                                <th>WhatsApp</th>
                                <th>Comentarios</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservasConfirmadas as $reserva)
                            <tr>
                                <td><strong>#{{ $reserva->idReserva }}</strong></td>
                                <td>{{ $reserva->usuario->name ?? 'N/A' }}</td>
                                <td>{{ $reserva->ruta->nombre ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($reserva->fechaReserva)->format('d/m/Y') }}</td>
                                <td>
                                    <span class="numero-personas">
                                        {{ $reserva->noPersonas }}
                                    </span>
                                </td>
                                <td>{{ $reserva->whatsapp }}</td>
                                <td>{{ $reserva->comentarios ?? 'Sin comentarios' }}</td>
                                <td>
                                    <span class="badge-estado badge-{{ $reserva->estado }}">
                                        {{ ucfirst($reserva->estado) }}
                                    </span>
                                </td>
                                <td>
                                    <!-- Botón Eliminar con modal -->
                                    <button class="btn-eliminar" onclick="mostrarConfirmacionEliminar({{ $reserva->idReserva }})">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </td>
                                <td>
    <!-- Botón Editar -->
    <button class="btn-editar" onclick="mostrarFormularioEditar({{ $reserva->idReserva }})" style="background-color: #28a745; color: white; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer; font-size: 0.8em; margin-right: 5px; display: inline-flex; align-items: center; gap: 5px;">
        <i class="fas fa-edit"></i> Editar
    </button>

</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="resumen">
                        Mostrando {{ $reservasConfirmadas->count() }} de {{ $reservasConfirmadas->total() }} reservas confirmadas
                    </div>
                </div>

                <!-- Paginación -->
                <div class="paginacion">
                    {{ $reservasConfirmadas->links() }}
                </div>

            @else
                <div class="sin-reservas">
                    <h3>No hay reservaciones confirmadas</h3>
                    <p>No hay reservas confirmadas en este momento.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal de confirmación para eliminar -->
    <div id="modalConfirmacionEliminar" class="modal">
        <div class="modal-contenido">
            <h3><i class="fas fa-exclamation-triangle" style="color: #dc3545;"></i> Eliminar Reserva Confirmada</h3>
            <p id="modalMensajeEliminar">¿Estás seguro de que deseas ELIMINAR esta reserva confirmada?</p>
            <div class="modal-botones">
                <button class="btn-cancelar-modal" onclick="cerrarModalEliminar()">Cancelar</button>
                
                <!-- Formulario para Eliminar -->
                <form id="formEliminarReserva" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-eliminar-modal">
                        <i class="fas fa-trash"></i> Sí, Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')

    <script>
        let reservaIdActual = 0;

        function mostrarConfirmacionEliminar(reservaId) {
            reservaIdActual = reservaId;
            
            const modal = document.getElementById('modalConfirmacionEliminar');
            const formEliminar = document.getElementById('formEliminarReserva');
            
            // Configurar el formulario con la URL correcta
            formEliminar.action = `/reservas/${reservaId}`;
            
            // Mostrar el modal
            modal.style.display = 'block';
        }

        function cerrarModalEliminar() {
            document.getElementById('modalConfirmacionEliminar').style.display = 'none';
        }

        // Cerrar modal si se hace clic fuera del contenido
        window.onclick = function(event) {
            const modal = document.getElementById('modalConfirmacionEliminar');
            if (event.target === modal) {
                cerrarModalEliminar();
            }
        }

        // Cerrar modal con tecla ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                cerrarModalEliminar();
            }
        });

        // Función para redirigir a la página de edición
function mostrarFormularioEditar(reservaId) {
    window.location.href = `/reservas/${reservaId}/edit`;
}
    </script>
</body>
</html>