<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Reserva</title>
    
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

        .formulario-contenedor {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .form-input:focus {
            outline: none;
            border-color: #be3308;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background-color: #be3308;
            color: white;
        }

        .btn-primary:hover {
            background-color: #a52c07;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            margin-right: 10px;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .botones-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    @include('layouts.header')

    <!-- Contenido Principal -->
    <div class="contenedor-principal">
        <div style="max-width: 1400px; margin: 0 auto;">
            <h1 class="titulo">Editar Reserva #{{ $reserva->idReserva }}</h1>

            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i> 
                <strong>Importante:</strong> Al editar la reserva, el estado volverá a "Pendiente" para ser revisada nuevamente.
            </div>

            <div class="formulario-contenedor">
                <form action="{{ route('reservas.update', $reserva->idReserva) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label" for="fechaReserva">Fecha de Reserva *</label>
                        <input type="date" 
                               id="fechaReserva" 
                               name="fechaReserva" 
                               class="form-input"
                               value="{{ old('fechaReserva', $reserva->fechaReserva->format('Y-m-d')) }}"
                               required>
                        @error('fechaReserva')
                            <span style="color: red; font-size: 14px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="noPersonas">Número de Personas *</label>
                        <input type="number" 
                               id="noPersonas" 
                               name="noPersonas" 
                               class="form-input"
                               min="1"
                               value="{{ old('noPersonas', $reserva->noPersonas) }}"
                               required>
                        @error('noPersonas')
                            <span style="color: red; font-size: 14px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="whatsapp">WhatsApp *</label>
                        <input type="tel" 
                               id="whatsapp" 
                               name="whatsapp" 
                               class="form-input"
                               value="{{ old('whatsapp', $reserva->whatsapp) }}"
                               placeholder="Ej: 1234567890"
                               required>
                        @error('whatsapp')
                            <span style="color: red; font-size: 14px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="comentarios">Comentarios</label>
                        <textarea id="comentarios" 
                                  name="comentarios" 
                                  class="form-input" 
                                  rows="4"
                                  placeholder="Comentarios adicionales...">{{ old('comentarios', $reserva->comentarios) }}</textarea>
                        @error('comentarios')
                            <span style="color: red; font-size: 14px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="rutasidRuta">Ruta *</label>
                        <select id="rutasidRuta" name="rutasidRuta" class="form-input" required>
                            <option value="">Selecciona una ruta</option>
                            @foreach($rutas as $ruta)
                                <option value="{{ $ruta->idRuta }}" 
                                    {{ old('rutasidRuta', $reserva->rutasidRuta) == $ruta->idRuta ? 'selected' : '' }}>
                                    {{ $ruta->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('rutasidRuta')
                            <span style="color: red; font-size: 14px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="botones-container">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Actualizar Reserva
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')
</body>
</html>