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
                    
                        @if($rutas->count() > 0)
                            @foreach($rutas as $ruta)
                                <div class="ruta">
                                    <h2>
                                        <a href="{{ route('ruta.show', $ruta->idRuta) }}" style="text-decoration: none; color: inherit;">
                                            {{ $ruta->nombre }}
                                        </a>
                                    </h2>
                                    <p><strong>Descripción:</strong> {{ $ruta->descripcion }}</p>
                                    <p><strong>Dificultad:</strong> {{ $ruta->dificultad }}</p>
                                    <p><strong>Duración:</strong> {{ $ruta->duracion }}</p>
                                    <p class="precio"><strong>Precio:</strong> ${{ number_format($ruta->precio, 0) }}</p>
                                    
                                    {{-- Agrega este botón --}}
                                    <a href="{{ route('ruta.show', $ruta->idRuta) }}" style="background: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; display: inline-block;">
                                        Ver detalles completos
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <p>No hay rutas disponibles.</p>
                        @endif
                    
                </main>


                <!-- FOOTER - Pie de página -->
            @include('layouts.footer')
            </div>
        </body>
</html>