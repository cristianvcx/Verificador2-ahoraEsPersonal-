<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Contraseña - Intranet CAJBIOBIO</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="login-layout-body">

    <!-- Navegación Principal Institucional -->
    <header class="header-nav-caj">
        <div class="header-logo-container-caj">
            <span class="logo-text-caj">
                <strong>Intranet CAJBIOBIO</strong> <span style="font-weight: 300; opacity: 0.8; margin-left: 10px; font-size: 0.95rem; border-left: 1px solid rgba(255,255,255,0.3); padding-left: 10px;">Verificador de Actividades</span>
            </span>
        </div>
    </header>

    <!-- Contenedor Principal de Dos Columnas -->
    <div class="login-main-container">
        <div class="login-grid-wrapper" style="grid-template-columns: 1fr; max-width: 480px;">

            <!-- Tarjeta de Confirmación Segura -->
            <div class="login-container-card-caj">
                <div class="login-card-header">
                    <h2>🔐 Confirmar Identidad</h2>
                    <p style="margin-top: 8px; margin-bottom: 25px; font-size: 0.88rem; color: #64748b; line-height: 1.5;">
                        Está intentando ingresar a una sección protegida de configuración crítica. Por favor, reconfirme su contraseña institucional para continuar.
                    </p>
                </div>

                <form class="login-form-body-caj" action="{{ route('password.confirm') }}" method="POST">
                    @csrf

                    <div class="form-group-item-caj">
                        <label for="password">Contraseña Institucional</label>
                        <input type="password" id="password" name="password" class="form-input-control-caj" placeholder="••••••••••••" required autocomplete="current-password" autofocus>
                        @error('password')
                        <span style="color: #ef3340; font-size: 0.82rem; font-weight: 600; display: block; margin-top: 6px;">
                            ⚠️ {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group-item-caj" style="margin-top: 25px; display: flex; gap: 15px; flex-direction: row-reverse;">
                        <button type="submit" class="btn-primary-caj" style="flex: 1; padding: 12px;">
                            Confirmar Contraseña
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn-acc" style="flex: 1; text-align: center; padding: 12px; border: 1px solid #cbd5e1; text-decoration: none; font-size: 0.95rem; font-weight: 600; border-radius: 6px;">
                            Cancelar
                        </a>
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