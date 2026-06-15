<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Establecer Nueva Contraseña - Verificador de Actividades</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="login-layout-body">

    <header class="header-nav-caj">
        <div class="header-logo-container-caj">
            <span class="logo-text-caj">
                <strong>Intranet CAJBIOBIO</strong>
            </span>
        </div>
    </header>

    <div class="login-main-container">
        <div class="login-grid-wrapper" style="grid-template-columns: 1fr; max-width: 480px;">

            <div class="login-container-card-caj">
                <div class="login-card-header">
                    <h2>Nueva Contraseña</h2>
                    <p>Por favor, ingrese sus nuevas credenciales de acceso para actualizar su cuenta.</p>
                </div>

                <form class="login-form-body-caj" action="{{ route('password.update') }}" method="POST">
                    @csrf

                    <!-- Token de Recuperación Proporcionado por Fortify -->
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">

                    <div class="form-group-item-caj">
                        <label for="email">Correo Institucional</label>
                        <input type="email" id="email" name="email" class="form-input-control-caj" value="{{ old('email', request()->email) }}" required readonly>
                        @error('email')
                        <span style="color: #ef3340; font-size: 0.85rem; font-weight: 600; display: block; margin-top: 6px;">
                            ⚠️ {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group-item-caj">
                        <label for="password">Nueva Contraseña</label>
                        <input type="password" id="password" name="password" class="form-input-control-caj" placeholder="Mínimo 8 caracteres" required autofocus autocomplete="new-password">
                        @error('password')
                        <span style="color: #ef3340; font-size: 0.85rem; font-weight: 600; display: block; margin-top: 6px;">
                            ⚠️ {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group-item-caj">
                        <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input-control-caj" placeholder="Repita la contraseña" required autocomplete="new-password">
                    </div>

                    <div class="form-group-item-caj" style="margin-top: 25px;">
                        <button type="submit" class="btn-primary-caj">
                            Restablecer Contraseña
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <footer class="footer-credits-caj">
        <p>© 2026 Corporación de Asistencia Judicial de la Región del Biobío. Todos los derechos reservados.</p>
    </footer>

</body>

</html>