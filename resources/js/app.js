import PerfectScrollbar from 'perfect-scrollbar';
window.PerfectScrollbar = PerfectScrollbar;

import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

// Configuración global de Toastr
toastr.options = {
    closeButton: true, // Mostrar botón de cerrar
    progressBar: true, // Mostrar barra de progreso
    positionClass: 'toast-bottom-right', // Posición del toast
    preventDuplicates: true, // Evitar duplicados
    timeOut: 5000, // Duración en milisegundos
};

// Hacer Toastr disponible globalmente
window.toastr = toastr;

import './bootstrap';
import './custom';