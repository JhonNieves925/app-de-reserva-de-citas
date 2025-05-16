<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agendar Cita</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .navbar {
      background-color: #343a40;
    }
    .navbar-nav .nav-link, .navbar-brand {
      color: white;
    }
    .navbar-nav .nav-link:hover, .navbar-brand:hover {
      color: #ffc107;
    }
    .footer {
      background-color: #343a40;
      color: white;
      padding: 10px 0;
      text-align: center;
    }
    .presentation {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-top: 50px;
      display: none; /* Ocultar inicialmente */
    }
    .presentation img {
      max-width: 50%;
      height: auto;
      margin-right: 20px;
    }
    .presentation .description {
      max-width: 50%;
    }

    
  .contenido {
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.7s ease, visibility 0.7s ease;
    
  }
  

  .contenido.visible {
    opacity: 1;
    visibility: visible;
  }

  .contenido:not(.visible) {
    pointer-events: none;
    position: absolute;
    width: 100%;
    top: 0;
    left: 0;
  }



</style>
</head>
<body>

<header class="bg-primary py-3">
    <div class="container">
        <h1 class="text-white" style="font-family: 'Brush Script MT', cursive; font-size: 2.5rem;">Mi Agenda</h1>
    </div>
</header>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand nav-btn" href="#" data-target="inicio">Inicio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link nav-btn" href="#" data-target="calendarContainer">Agendar Cita</a>
        </li>
          </li>
          <a class="nav-link" href="{{ route('citas.index') }}">Mis Citas</a>
          <li class="nav-item"><a class="nav-link nav-btn" href="#" data-target="servicios">Servicios</a></li>
          <li class="nav-item"><a class="nav-link nav-btn" href="#" data-target="contacto">Contacto / Ayuda</a></li>

        </ul>
        <ul class="navbar-nav">
          @if(Auth::check())
            <li class="nav-item">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link btn btn-link" style="padding: 0; border: none; background: none;">Cerrar Sesión</button>
              </form>
            </li>
          @else
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Registrarse</a></li>
          @endif
        </ul>
      </div>
    </div>
  </nav>

  <!-- ENVOLVER el banner con ID e incluir clase "contenido" -->
<div id="inicio" class="contenido">
  <section class="position-relative contenido" id="inicio">
    <img src="{{ asset('storage/fondo3.jpg') }}" alt="banner" class="img-fluid w-100" style="height: 500px; object-fit: cover;">
    <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
      <h2 class="display-5 fw-bold">Programa Tu Cita Médica Con Facilidad</h2>
      <p class="lead">Reserva tu cita en línea de manera rápida y sencilla. Confía en nuestros profesionales para cuidar de tu salud.</p>
      <a href="#" class="btn btn-outline-light btn-lg nav-btn" data-target="calendarContainer">Explorar</a>
    </div>
  </section>
</div>


  <!-- CALENDARIO -->
  <div class="container mt-5 contenido" id="calendarContainer">
    <h2 class="text-center mb-4">Agendar Cita</h2>
    <div id="calendar"></div>
  </div>

  <!-- MODAL DE FORMULARIO -->
  <div class="modal fade" id="citaModal" tabindex="-1" aria-labelledby="citaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="POST" action="{{ route('citas.store') }}">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="citaModalLabel">Agendar Nueva Cita</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
              <label for="dependencia" class="form-label">Dependencia</label>
              <input type="text" class="form-control" id="dependencia" name="dependencia" required>
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label">Descripción</label>
              <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
            </div>
            <input type="hidden" id="fecha" name="fecha">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Guardar Cita</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- SERVICIOS -->
<div class="container mt-5 contenido" id="servicios" style="display: none;">
  <h2 class="text-center mb-4">Nuestros Servicios</h2>
  <p class="text-center">Aquí puedes describir los diferentes tipos de servicios que ofrece tu clínica o empresa.</p>
</div>

<!-- CONTACTO / AYUDA -->
<div class="container mt-5 contenido" id="contacto" style="display: none;">
  <h2 class="text-center mb-4">Contacto y Ayuda</h2>
  <p class="text-center">¿Necesitas ayuda? Contáctanos en nuestro correo o por teléfono. Aquí puedes poner un formulario de contacto también.</p>
</div>


  <!-- FOOTER -->
  <footer class="bg-dark text-white text-center py-3 mt-5">
  <p>&copy; {{ date('Y') }} Jhon Nieves. Todos los derechos reservados.</p>
</footer>

  <!-- SCRIPTS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
 <script>
  let calendar = null;

  function showContent(targetId) {
    document.querySelectorAll('.contenido').forEach(div => {
      if (div.id === targetId) {
        div.classList.add('visible');
      } else {
        div.classList.remove('visible');
      }
    });

    if (targetId === 'calendarContainer') {
      setTimeout(() => {
        if (!calendar) {
          const calendarEl = document.getElementById('calendar');
          calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            dateClick: function(info) {
              document.getElementById('fecha').value = info.dateStr;
              const citaModal = new bootstrap.Modal(document.getElementById('citaModal'));
              citaModal.show();
            }
          });
          calendar.render();
        }
      }, 300); // Esperamos que termine la animación
    } else {
      if (calendar) {
        calendar.destroy();
        calendar = null;
        document.getElementById('calendar').innerHTML = '';
      }
    }
  }

  document.querySelectorAll('.nav-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      const target = this.getAttribute('data-target');
      showContent(target);
    });
  });
</script>



</body>
</html>
