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
    <body >


        <div class="contenedor-principal">

            <!--header -->
            @include('layouts.header')


        <!-- CUERPO - Contenido principal -->
        <main class="cuerpo">
            <div class="contenido">
                <h2>Pagina de inicio de Atexacatl</h2>
                <p>Este es el área de contenido principal de la página.</p>
                
                <!-- Ejemplo de subcontenedores dentro del cuerpo -->
                <div class="secciones">
                    <div class="seccion">
                        <h3>Sección 1</h3>
                        <p>Contenido de la primera sección.</p>
                    </div>
                    <div class="seccion">
                        <h3>Sección 2</h3>
                        <p>Contenido de la segunda sección.</p>
                    </div>
                    <div class="seccion">
                        <h3>Sección 3</h3>
                        <p>Contenido de la tercera sección.</p>
                    </div>
                </div>
            </div>
            
            <!-- Barra lateral -->
            <aside class="sidebar">
                <h3>Barra Lateral</h3>
                <p>Información adicional o enlaces.</p>
            </aside>
        </main>

        <!-- CUERPO - Contenido principal -->
        <main class="cuerpo">
            <div class="contenido">
                <h2>Contenido Principal</h2>
                <p>Este es el área de contenido principal de la página.</p>
                
                <!-- Ejemplo de subcontenedores dentro del cuerpo -->
                <div class="secciones">
                    <div class="seccion">
                        <h3>Sección 1</h3>
                        <p>Contenido de la primera sección.</p>
                    </div>
                    <div class="seccion">
                        <h3>Sección 2</h3>
                        <p>Contenido de la segunda sección.</p>
                    </div>
                    <div class="seccion">
                        <h3>Sección 3</h3>
                        <p>Contenido de la tercera sección.</p>
                    </div>
                </div>
            </div>
            
            <!-- Barra lateral -->
            <aside class="sidebar">
                <h3>Barra Lateral</h3>
                <p>Información adicional o enlaces.</p>
            </aside>
        </main>

        <!-- CUERPO - Contenido principal -->
        <main class="cuerpo">
            <div class="contenido">
                <h2>Contenido Principal</h2>
                <p>Este es el área de contenido principal de la página.</p>
                
                <!-- Ejemplo de subcontenedores dentro del cuerpo -->
                <div class="secciones">
                    <div class="seccion">
                        <h3>Sección 1</h3>
                        <p>Contenido de la primera sección.</p>
                    </div>
                    <div class="seccion">
                        <h3>Sección 2</h3>
                        <p>Contenido de la segunda sección.</p>
                    </div>
                    <div class="seccion">
                        <h3>Sección 3</h3>
                        <p>Contenido de la tercera sección.</p>
                    </div>
                </div>
            </div>
            
            <!-- Barra lateral -->
            <aside class="sidebar">
                <h3>Barra Lateral</h3>
                <p>Información adicional o enlaces.</p>
            </aside>
        </main>

        <!-- CUERPO - Contenido principal -->
        <main class="cuerpo">
            <div class="contenido">
                <h2>Contenido Principal</h2>
                <p>Este es el área de contenido principal de la página.</p>
                
                <!-- Ejemplo de subcontenedores dentro del cuerpo -->
                <div class="secciones">
                    <div class="seccion">
                        <h3>Sección 1</h3>
                        <p>Contenido de la primera sección.</p>
                    </div>
                    <div class="seccion">
                        <h3>Sección 2</h3>
                        <p>Contenido de la segunda sección.</p>
                    </div>
                    <div class="seccion">
                        <h3>Sección 3</h3>
                        <p>Contenido de la tercera sección.</p>
                    </div>
                </div>
            </div>
            
            <!-- Barra lateral -->
            <aside class="sidebar">
                <h3>Barra Lateral</h3>
                <p>Información adicional o enlaces.</p>
            </aside>
        </main>

        <!-- CUERPO - Contenido principal -->
        <main class="cuerpo">
            <div class="contenido">
                <h2>Contenido Principal</h2>
                <p>Este es el área de contenido principal de la página.</p>
                
                <!-- Ejemplo de subcontenedores dentro del cuerpo -->
                <div class="secciones">
                    <div class="seccion">
                        <h3>Sección 1</h3>
                        <p>Contenido de la primera sección.</p>
                    </div>
                    <div class="seccion">
                        <h3>Sección 2</h3>
                        <p>Contenido de la segunda sección.</p>
                    </div>
                    <div class="seccion">
                        <h3>Sección 3</h3>
                        <p>Contenido de la tercera sección.</p>
                    </div>
                </div>
            </div>
            
            <!-- Barra lateral -->
            <aside class="sidebar">
                <h3>Barra Lateral</h3>
                <p>Información adicional o enlaces.</p>
            </aside>
        </main>

        <!-- FOOTER - Pie de página -->
        @include('layouts.footer')

        </div>


    </body>
</html>
