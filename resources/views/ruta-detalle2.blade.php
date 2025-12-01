<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        @vite(['resources/css/custom.css'])

        @vite(['resources/js/custom.js'])
        <!-- Styles -->
        <style>
            
            /*! tailwindcss v4.0.14 | MIT License | https://tailwindcss.com */
        </style>
        <!--este es el welcome.blade.php-->
    </head>
        <body>
            <div class="contenedor-principal">
                <!--header -->
            
            @include('layouts.header')
                <main class="cuerpo">
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
                    
                </main>


                <!-- FOOTER - Pie de página -->
            @include('layouts.footer')
            </div>
        </body>
</html>