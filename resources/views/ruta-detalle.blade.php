<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $ruta->nombre }} - Laravel</title>

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
            /* Estilos para el modal */
            .modal-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1000;
                justify-content: center;
                align-items: center;
            }

            .modal-content {
                background: white;
                padding: 2rem;
                border-radius: 10px;
                width: 90%;
                max-width: 500px;
                max-height: 90vh;
                overflow-y: auto;
                position: relative;
            }

            .modal-close {
                position: absolute;
                top: 1rem;
                right: 1rem;
                background: none;
                border: none;
                font-size: 1.5rem;
                cursor: pointer;
                color: #666;
            }

            .modal-close:hover {
                color: #333;
            }

            .btn-reservar {
                background: #10B981;
                color: white;
                padding: 12px 24px;
                border: none;
                border-radius: 8px;
                font-size: 1.1rem;
                cursor: pointer;
                margin-top: 1rem;
                transition: background 0.3s;
            }

            .btn-reservar:hover {
                background: #059669;
            }

            .form-group {
                margin-bottom: 1rem;
            }

            .form-label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 600;
            }

            .form-input {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #d1d5db;
                border-radius: 6px;
                font-size: 1rem;
            }

            .form-input:focus {
                outline: none;
                border-color: #10B981;
                box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
            }

            .btn-submit {
                background: #10B981;
                color: white;
                padding: 12px 24px;
                border: none;
                border-radius: 8px;
                font-size: 1rem;
                cursor: pointer;
                width: 100%;
                margin-top: 1rem;
            }

            .btn-submit:hover {
                background: #059669;
            }

            .btn-cancel {
                background: #6b7280;
                color: white;
                padding: 12px 24px;
                border: none;
                border-radius: 8px;
                font-size: 1rem;
                cursor: pointer;
                width: 100%;
                margin-top: 0.5rem;
            }

            .btn-cancel:hover {
                background: #4b5563;
            }

            .alert-success {
                background: #d1fae5;
                border: 1px solid #10B981;
                color: #065f46;
                padding: 1rem;
                border-radius: 6px;
                margin-bottom: 1rem;
            }

            .alert-error {
                background: #fee2e2;
                border: 1px solid #ef4444;
                color: #b91c1c;
                padding: 1rem;
                border-radius: 6px;
                margin-bottom: 1rem;
            }
        </style>
    </head>
    <body>
        <div class="contenedor-principal">
            <!-- Header -->
            @include('layouts.header')
            
            <main class="cuerpo">
                <!-- Mensajes de éxito/error -->
                @if(session('success'))
                    <div class="alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert-error">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <a href="{{ route('rutas') }}" class="volver">← Volver a todas las rutas</a>
                
                <div class="ruta-header">
                    <h1>{{ $ruta->nombre }}</h1>
                    <span class="dificultad dificultad-{{ strtolower($ruta->dificultad) }}">
                        {{ $ruta->dificultad }}
                    </span>
                    <div class="precio">${{ number_format($ruta->precio, 0) }}</div>
                </div>

                <div class="ruta-info">
                    <h3>Descripción</h3>
                    <p>{{ $ruta->descripcion }}</p>

                    <h3>¿Qué incluye?</h3>
                    <p>{{ $ruta->incluye }}</p>

                    <h3>¿Qué debes llevar?</h3>
                    <p>{{ $ruta->llevar }}</p>

                    <h3>Duración</h3>
                    <p>{{ $ruta->duracion }}</p>
                </div>

                <!-- Botón para abrir modal de reserva -->
                @auth
                    <button class="btn-reservar" onclick="openReservaModal()">
                        <i class="fas fa-calendar-check"></i> Reservar Esta Ruta
                    </button>
                @else
                    <a href="{{ route('login') }}" class="btn-reservar" style="text-decoration: none; display: inline-block;">
                        <i class="fas fa-sign-in-alt"></i> Iniciar Sesión para Reservar
                    </a>
                @endauth
            </main>

            <!-- Footer -->
            @include('layouts.footer')
        </div>

        <!-- Modal de Reserva -->
        <div id="reservaModal" class="modal-overlay">
            <div class="modal-content">
                <button class="modal-close" onclick="closeReservaModal()">&times;</button>
                
                <h2 style="margin-bottom: 1.5rem;">Reservar: {{ $ruta->nombre }}</h2>
                
                <form method="POST" action="{{ route('reservas.store') }}" id="reservaForm">
                    @csrf
                    
                    <!-- Campo OCULTO para la ruta -->
                    <input type="hidden" name="rutasidRuta" value="{{ $ruta->idRuta }}">

                    <!-- Fecha de Reserva -->
                    <div class="form-group">
                        <label class="form-label" for="fechaReserva">Fecha de Reserva *</label>
                        <input type="date" 
                               id="fechaReserva" 
                               name="fechaReserva" 
                               class="form-input" 
                               value="{{ old('fechaReserva') }}" 
                               min="{{ date('Y-m-d') }}" 
                               required>
                    </div>

                    <!-- Número de Personas -->
                    <div class="form-group">
                        <label class="form-label" for="noPersonas">Número de Personas *</label>
                        <input type="number" 
                               id="noPersonas" 
                               name="noPersonas" 
                               class="form-input" 
                               value="{{ old('noPersonas') }}" 
                               min="1" 
                               max="20" 
                               required>
                    </div>

                    <!-- WhatsApp -->
                    <div class="form-group">
                        <label class="form-label" for="whatsapp">Número de WhatsApp *</label>
                        <input type="tel" 
                               id="whatsapp" 
                               name="whatsapp" 
                               class="form-input" 
                               value="{{ old('whatsapp', Auth::user()->numeroTelefono ?? '') }}" 
                               placeholder="Ej: 1234567890" 
                               required>
                    </div>

                    <!-- Comentarios -->
                    <div class="form-group">
                        <label class="form-label" for="comentarios">Comentarios (Opcional)</label>
                        <textarea id="comentarios" 
                                  name="comentarios" 
                                  class="form-input" 
                                  rows="3" 
                                  placeholder="Comentarios adicionales...">{{ old('comentarios') }}</textarea>
                    </div>

                    <!-- Botones -->
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-check"></i> Confirmar Reserva
                    </button>
                    <button type="button" class="btn-cancel" onclick="closeReservaModal()">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                </form>
            </div>
        </div>

        <!-- JavaScript para el Modal -->
        <script>
            function openReservaModal() {
                document.getElementById('reservaModal').style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }

            function closeReservaModal() {
                document.getElementById('reservaModal').style.display = 'none';
                document.body.style.overflow = 'auto';
            }

            // Cerrar modal al hacer clic fuera del contenido
            document.getElementById('reservaModal').addEventListener('click', function(e) {
                if (e.target.id === 'reservaModal') {
                    closeReservaModal();
                }
            });

            // Cerrar modal con tecla ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeReservaModal();
                }
            });

            // Validación básica del formulario
            document.getElementById('reservaForm').addEventListener('submit', function(e) {
                const fecha = document.getElementById('fechaReserva').value;
                const personas = document.getElementById('noPersonas').value;
                const whatsapp = document.getElementById('whatsapp').value;

                if (!fecha || !personas || !whatsapp) {
                    e.preventDefault();
                    alert('Por favor, completa todos los campos obligatorios.');
                }
            });

            // Establecer fecha mínima como hoy
            document.addEventListener('DOMContentLoaded', function() {
                const today = new Date().toISOString().split('T')[0];
                document.getElementById('fechaReserva').min = today;
            });
        </script>
    </body>
</html>