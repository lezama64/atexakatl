<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RESERVACIONES POR CONFIRMAR</title>
    
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

        /* ESTILOS PARA BOTONES */
        .acciones-container {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-confirmar {
            background-color: #28a745;
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

        .btn-confirmar:hover {
            background-color: #218838;
        }

        .btn-cancelar {
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

        .btn-cancelar:hover {
            background-color: #c82333;
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

        /* Modal de confirmación */
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

        .btn-confirmar-modal {
            background-color: #28a745;
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
            
            .acciones-container {
                flex-direction: column;
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
            <h1 class="titulo">RESERVACIONES POR CONFIRMAR</h1>
            
            <!-- Mostrar mensajes de éxito/error -->
            @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif
            
            @if(isset($reservasPendientes) && $reservasPendientes->count() > 0)
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
                            @foreach($reservasPendientes as $reserva)
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
                                    <div class="acciones-container">
                                        <!-- Botón Confirmar -->
                                        <button class="btn-confirmar" onclick="mostrarConfirmacion({{ $reserva->idReserva }}, 'confirmar')">
                                            <i class="fas fa-check"></i> Confirmar
                                        </button>
                                        
                                        <!-- Botón Cancelar -->
                                        <button class="btn-cancelar" onclick="mostrarConfirmacion({{ $reserva->idReserva }}, 'cancelar')">
                                            <i class="fas fa-times"></i> Cancelar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="resumen">
                        Mostrando {{ $reservasPendientes->count() }} de {{ $reservasPendientes->total() }} reservas pendientes
                    </div>
                </div>

                <!-- Paginación -->
                <div class="paginacion">
                    {{ $reservasPendientes->links() }}
                </div>

            @else
                <div class="sin-reservas">
                    <h3>No hay reservaciones pendientes</h3>
                    <p>Todas las reservas están confirmadas o no hay solicitudes pendientes.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal de confirmación -->
    <div id="modalConfirmacion" class="modal">
        <div class="modal-contenido">
            <h3 id="modalTitulo"><i class="fas fa-question-circle" style="color: #be3308;"></i> Confirmar Acción</h3>
            <p id="modalMensaje">¿Estás seguro de que deseas realizar esta acción?</p>
            <div class="modal-botones">
                <button class="btn-cancelar-modal" onclick="cerrarModal()">Cancelar</button>
                
                <!-- Formulario para Confirmar -->
                <form id="formConfirmarReserva" method="POST" style="display: none;">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="estado" value="confirmada">
                    <button type="submit" class="btn-confirmar-modal">
                        <i class="fas fa-check"></i> Sí, Confirmar
                    </button>
                </form>
                
                <!-- Formulario para Cancelar/Eliminar -->
                <form id="formCancelarReserva" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-eliminar-modal">
                        <i class="fas fa-trash"></i> Sí, Cancelar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')

    <script>
        let accionActual = '';
        let reservaIdActual = 0;

        function mostrarConfirmacion(reservaId, accion) {
            reservaIdActual = reservaId;
            accionActual = accion;
            
            const modal = document.getElementById('modalConfirmacion');
            const titulo = document.getElementById('modalTitulo');
            const mensaje = document.getElementById('modalMensaje');
            const formConfirmar = document.getElementById('formConfirmarReserva');
            const formCancelar = document.getElementById('formCancelarReserva');
            
            // Ocultar ambos formularios primero
            formConfirmar.style.display = 'none';
            formCancelar.style.display = 'none';
            
            if (accion === 'confirmar') {
                titulo.innerHTML = '<i class="fas fa-check-circle" style="color: #28a745;"></i> Confirmar Reserva';
                mensaje.textContent = '¿Estás seguro de que deseas CONFIRMAR esta reserva?';
                formConfirmar.action = `/reservas/${reservaId}/actualizar-estado`;
                formConfirmar.style.display = 'inline';
            } else if (accion === 'cancelar') {
                titulo.innerHTML = '<i class="fas fa-exclamation-triangle" style="color: #dc3545;"></i> Cancelar Reserva';
                mensaje.textContent = '¿Estás seguro de que deseas CANCELAR y ELIMINAR esta reserva?';
                formCancelar.action = `/reservas/${reservaId}`;
                formCancelar.style.display = 'inline';
            }
            
            modal.style.display = 'block';
        }

        function cerrarModal() {
            document.getElementById('modalConfirmacion').style.display = 'none';
        }

        // Cerrar modal si se hace clic fuera del contenido
        window.onclick = function(event) {
            const modal = document.getElementById('modalConfirmacion');
            if (event.target === modal) {
                cerrarModal();
            }
        }

        
        // Función para redirigir a la página de edición
function mostrarFormularioEditar(reservaId) {
    window.location.href = `/reservas/${reservaId}/edit`;
}

    </script>
</body>
</html>
