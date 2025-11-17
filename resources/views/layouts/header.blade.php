<!-- aqui empieza views/layouts/header.blade-php-->
<header class="header">
    <h1>Atexakatl</h1>
    <nav class="navegacion">
        <a href="{{ route('inicio') }}">Inicio</a>
        <div class="menuDes-container">
            <a href="{{ route('rutas') }}" class="boton-menuDes">Rutas <i class="fas fa-chevron-down"></i></a>
            <div class="menuDes-opciones">
                <a href="{{ route('ruta.show', 1) }}"><i class="fas fa-hiking"></i> Recorrido nacimiento rio tonto</a>
                <a href="{{ route('ruta.show', 2) }}"><i class="fas fa-bicycle"></i> Espeleologia</a>
                <a href="{{ route('ruta.show', 3) }}"><i class="fas fa-car"></i> Cascada de Atlahuitzia</a>
                <a href="{{ route('ruta.show', 4) }}"><i class="fas fa-map-marked-alt"></i> Cueva de las golondrinas</a>
                <a href="{{ route('ruta.show', 5) }}"><i class="fas fa-map-marked-alt"></i> Ruta de kayak</a>
                <a href="{{ route('ruta.show', 6) }}"><i class="fas fa-map-marked-alt"></i> Ruta Boqueron</a>


            </div>
        </div>

        <div class="menuDes-container">
            <a href="{{ route('destinos') }}" class="boton-menuDes">Destinos <i class="fas fa-chevron-down"></i></a>
                <div class="menuDes-opciones">
                    <a href="{{ route('destino.show', 1) }}"><i class="fas fa hiking"></i> Nacimiento rio tonto</a>
                    <a href="{{ route('destino.show', 2) }}"><i class="fas fa-bicycle"></i> Cascada Atlahuitzia</a>
                    <a href="{{ route('destino.show', 3) }}"><i class="fas fa-hiking"></i> Boqueron</a>

                </div>
        </div>

        <a href="{{ route('nosotros') }}">Nosotros</a>

        @if (Route::has('login'))
            <div class="auth-links">
        @auth
            <!-- Botón que abre el menú deslizable (reemplaza el user-menu original) -->
            <button id="abrirMenu" class="user-menu-btn">
                <span class="user-name">{{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            
            <!-- Menú lateral deslizable -->
            <div class="menu-lateral" id="menuLateral">
                <div class="menu-cerrar">
                    <button id="cerrarMenu"><i class="fas fa-times"></i></button>
                </div>
                <div class="menu-perfil">
                    <div class="icono-usuario">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <h3>{{ Auth::user()->name }}</h3>
                </div>
                <nav class="menu-navegacion">


                    <a href="{{ route('profile.edit') }}" class="menu-item">
                        <i class="fas fa-user-edit"></i>
                        <span>Editar Usuario</span>
                    </a>

                                <!-- Para usuarios normales -->
                    @if(auth()->user()->rol === 'usuario')
                        <a href="{{ route('mis-reservas') }}" class="menu-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Mis Reservaciones</span>
                    </a>
                    @endif
                    

                                    <!-- Para administradores -->
                    @if(auth()->user()->rol === 'admin')

                        <a href="{{ route('mis-reservas') }}" class="menu-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Mis Reservaciones</span>

                        <a href="{{ route('reservaciones-confirmadas') }}" class="menu-item">
                        <i class="fas fa-check-circle text-success"></i>
                        <span>reservaciones confirmadas</span>

                        <a href="{{ route('reservaciones-por-confirmar') }}" class="menu-item">
                        <i class="fas fa-calendar-times text-warning"></i>
                        <span>reservaciones por confirmar</span>
                    </a>
                    @endif
                    
                    <form method="POST" action="{{ route('logout') }}" class="menu-item-form">
                        @csrf
                        <a href="{{ route('logout') }}" class="menu-item" 
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Cerrar Sesión</span>
                        </a>
                    </form>
                </nav>
            </div>
        @else
            <!-- Botón de login para usuarios no autenticados -->
            <a href="{{ route('login') }}" class="auth-btn login-btn" title="Log in">
                <i class="fas fa-user"></i>
            </a>
        @endauth
    </div>
@endif
    </nav>

    <!-- Menú lateral deslizable (derecha) - SOLO PARA USUARIOS AUTENTICADOS -->
    
</header>
<!-- aqui termina views/layouts/header.blade-php-->