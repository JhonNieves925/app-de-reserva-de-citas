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
  </style>
</head>
<body>

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
          <li class="nav-item"><a class="nav-link" href="#">Servicios</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Contacto / Ayuda</a></li>
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

  <!-- Encabezado de bienvenida -->
<div id="inicio" class="contenido" style="display: block;">
    <h1 style="text-align: center; margin-top: 2rem;">Bienvenido a <strong>Mi Agenda</strong></h1>
    <p style="text-align: center; max-width: 700px; margin: 0 auto;">
        Agenda tus citas de manera rápida y eficiente. Consulta servicios disponibles, elige profesionales
        y asegura tu espacio con un solo clic.
    </p>
    <div style="display: flex; justify-content: center; margin-top: 2rem;">
        <img src="{{ asset('storage/citas-medicas.jpg') }}" alt="Bienvenida"
             style="max-width: 600px; border-radius: 10px;">
    </div>
</div>


  <!-- CALENDARIO -->
  <div class="container mt-5" id="calendarContainer" style="display: none;">
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

  <!-- FOOTER -->
  <footer class="footer mt-5">
    <div class="container">
      <p>&copy; 2025 Mi Agenda. Todos los derechos reservados.</p>
    </div>
  </footer>

  <!-- SCRIPTS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
  <script>
  let calendar = null;

  document.querySelectorAll('.nav-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.contenido').forEach(div => div.style.display = 'none');

      const target = this.getAttribute('data-target');
      document.getElementById(target).style.display = 'block';

      // Si estamos cambiando de vista, destruir el calendario si existe
      if (target !== 'calendarContainer' && calendar) {
        calendar.destroy();
        calendar = null;
        document.getElementById('calendar').innerHTML = ''; // Limpia el HTML
      }

      // Si entramos al calendario y aún no está creado, lo creamos
      if (target === 'calendarContainer' && !calendar) {
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
    });
  });
</script>


</body>
</html>
