import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Funcionalidad del menú lateral - VERSIÓN CORREGIDA
document.addEventListener('DOMContentLoaded', function() {
    console.log('🔧 Iniciando script del menú lateral...');
    
    const abrirMenu = document.getElementById('abrirMenu');
    const menuLateral = document.getElementById('menuLateral');
    const cerrarMenu = document.getElementById('cerrarMenu');
    
    console.log('Elementos encontrados:', {
        abrirMenu: abrirMenu ? '✅' : '❌',
        menuLateral: menuLateral ? '✅' : '❌',
        cerrarMenu: cerrarMenu ? '✅' : '❌'
    });

    if (abrirMenu && menuLateral && cerrarMenu) {
        console.log('✅ Todos los elementos encontrados');
        
        // Crear overlay dinámicamente si no existe
        let overlay = document.getElementById('overlay');
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.id = 'overlay';
            overlay.className = 'overlay';
            document.body.appendChild(overlay);
            console.log('✅ Overlay creado dinámicamente');
        }

        // Abrir menú lateral
        abrirMenu.addEventListener('click', () => {
            console.log('🎯 Click en abrirMenu');
            menuLateral.classList.add('activo');
            overlay.classList.add('activo');
            document.body.style.overflow = 'hidden';
        });

        // Cerrar menú lateral
        function cerrarMenuLateral() {
            console.log('🔒 Cerrando menú lateral');
            menuLateral.classList.remove('activo');
            overlay.classList.remove('activo');
            document.body.style.overflow = '';
        }

        cerrarMenu.addEventListener('click', cerrarMenuLateral);
        overlay.addEventListener('click', cerrarMenuLateral);

        // Cerrar con tecla Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && menuLateral.classList.contains('activo')) {
                cerrarMenuLateral();
            }
        });

    } else {
        console.error('❌ Error: Faltan elementos necesarios para el menú');
        if (!abrirMenu) console.error('   - No se encontró #abrirMenu');
        if (!menuLateral) console.error('   - No se encontró #menuLateral');
        if (!cerrarMenu) console.error('   - No se encontró #cerrarMenu');
    }
});