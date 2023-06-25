// Para cerrar sesión
$(document).ready(function() {
    // Capturar el evento de clic en el enlace de cierre de sesión
    $('#logout-link').click(function(e) {
      e.preventDefault(); // Prevenir el comportamiento predeterminado del enlace

      // Enviar una solicitud POST al servidor para cerrar la sesión
      $.post('/logout', function() {
        // Redireccionar a la página de inicio de sesión u otra página deseada
        window.location.href = '/login';
      });
    });
});

