<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #2d2a3e;
      color: #fff;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', sans-serif;
    }
    .login-box {
      background-color: #1e1c2e;
      border-radius: 16px;
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
      display: flex;
      width: 800px;
      max-width: 100%;
      overflow: hidden;
    }
    .login-left {
      width: 50%;
      background-image: url('/desert.jpg');
      background-size: cover;
      background-position: center;
    }
    .login-right {
      width: 50%;
      padding: 40px;
    }
    .form-control {
      background-color: #2e2b43;
      border: 1px solid #444;
      color: white;
    }
    .form-control:focus {
      background-color: #2e2b43;
      color: white;
      border-color:rgb(81, 65, 138);
      box-shadow: none;
    }
    .btn-custom {
      background-color: #4c72ff;
      border: none;
    }
    .btn-custom:hover {
      background-color: #3d5cd6;
    }
    .subtitle {
      font-size: 14px;
      color: #aaa;
      margin-bottom: 20px;
    }
    .subtitle a {
      color: #9a82f4;
      text-decoration: none;
    }
    .subtitle a:hover {
      text-decoration: underline;
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

  <div class="login-box">
    <div class="login-left d-none d-md-block"></div>

    <div class="login-right">
      <h2 class="text-center mb-4">Iniciar Sesión</h2>

      <p class="subtitle text-center">
        ¿No tienes cuenta?
        <a href="{{ route('register') }}">Regístrate aquí</a>
      </p>

      <!-- Mostrar errores de validación -->
      @if (session('error'))
        <div class="alert alert-danger text-center">
          {{ session('error') }}
        </div>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Correo electrónico</label>
          <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-custom w-100">Iniciar Sesión</button>
      </form>
    </div>
  </div>

</body>
</html>
