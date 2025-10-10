  document.addEventListener("DOMContentLoaded", function () {
    const loader = document.getElementById('loaderOverlay');
    const btnAcceder = document.getElementById('btnAcceder');

    // Aseguramos que esté oculto siempre al cargar la página
    loader.style.display = 'none';

    // Si el botón existe, agregamos el evento
    if (btnAcceder) {
      btnAcceder.addEventListener('click', function () {
        // Guardamos una marca temporal para saber que se hizo clic en "Acceder"
        sessionStorage.setItem('loaderActive', 'true');

        // Mostramos el loader visualmente
        loader.style.display = 'flex';
      });
    }

    // Al cargar la página, verificamos si debe mostrarse el loader
    const loaderActive = sessionStorage.getItem('loaderActive');

    // Si NO se activó manualmente, lo ocultamos siempre
    if (!loaderActive) {
      loader.style.display = 'none';
    }

    // Después de cargar la nueva página (por ejemplo, login), limpiamos la marca
    sessionStorage.removeItem('loaderActive');
  });

  // Cuando el usuario vuelve atrás, garantizamos que se oculte
  window.addEventListener('pageshow', function () {
    const loader = document.getElementById('loaderOverlay');
    if (loader) {
      loader.style.display = 'none';
    }
  });