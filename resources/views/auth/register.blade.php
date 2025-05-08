<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #2d2a3e;
      color: #fff;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .register-box {
      background-color: #1e1c2e;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
      width: 900px;
      display: flex;
    }
    .register-left {
      width: 50%;
      background-image: url('/desert.jpg');
      background-size: cover;
      background-position: center;
      position: relative;
    }
    .overlay-text {
      position: absolute;
      bottom: 40px;
      left: 30px;
      color: #fff;
      font-size: 20px;
      font-weight: 500;
    }
    .back-btn {
      position: absolute;
      top: 20px;
      right: 20px;
      background: rgba(255, 255, 255, 0.2);
      border: none;
      padding: 8px 14px;
      color: #fff;
      border-radius: 20px;
      font-size: 14px;
      text-decoration: none;
    }
    .register-right {
      width: 50%;
      padding: 40px;
    }
    .form-control {
      background-color:rgb(157, 155, 180);
      border: 1px solid #444;
      color: white;
    }
    .form-control:focus {
      background-color:rgb(75, 72, 92);
      color: white;
    }
    .btn-custom {
      background-color: #9a82f4;
      border: none;
    }
    .btn-custom:hover {
      background-color: #7d65d7;
    }
    .subtitle {
      font-size: 14px;
      color: #aaa;
    }
    .subtitle a {
      color: #9a82f4;
      text-decoration: none;
    }
    .alert-danger {
      background-color: #ff4c4c;
      color: white;
      border: none;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 8px;
    }
  </style>
</head>
<body>

  <div class="register-box">
    <!-- Lado izquierdo -->
    <div class="register-left">
      <div class="overlay-text">
        <h2>¡Bienvenido!<br>Regístrate para comenzar</h2>
      </div>
      <a href="{{ route('login') }}" class="back-btn">Volver al login</a>
    </div>

    <!-- Lado derecho -->
    <div class="register-right">
      <h1>Registro</h1>
      <p class="subtitle">¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>

      <!-- Mostrar errores de validación -->
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
          <input type="text" class="form-control" name="name" placeholder="Nombre completo" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
          <input type="email" class="form-control" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
          <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
        </div>
        <div class="mb-3">
          <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmar contraseña" required>
        </div>
        <button type="submit" class="btn btn-custom w-100">Registrarse</button>
      </form>
    </div>
  </div>

</body>
</html>
