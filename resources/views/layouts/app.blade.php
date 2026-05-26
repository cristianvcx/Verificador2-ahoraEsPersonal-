<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FirmaGob')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @stack('styles')
</head>
<body>

    <!-- Barra de Colores Gobierno de Chile -->
    <div class="header-bar-top"></div>

    <!-- Navegación Principal -->
    <header class="header-nav">
        <div class="header-logo-container">
            <span class="logo-signature">
                <span class="logo-circle-marker"></span>
                firma.gob
            </span>
        </div>
        <div style="display: flex; align-items: center; gap: 20px;">
            <div class="user-display-profile-badge">
                <span class="dot-online"></span>
                @if(Auth::user()->usuario_rol === 'admin')
                    <span class="badge-role-item admin" style="margin-right: 8px;">ADMIN</span>
                @endif
                <span>{{ Auth::user()->usuario_nombre }}</span>
            </div>
            
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-header-access" style="background-color: #ef3340; border: none; cursor: pointer;">
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </header>

    <!-- Barra de Accesibilidad -->
    <div class="accessibility-bar">
        <div class="breadcrumbs">
            <a href="#">Inicio</a>
            <span class="separator">‣</span>
            @yield('breadcrumbs')
        </div>
        <div class="accessibility-control-buttons">
            <button class="btn-acc" onclick="toggleContrast()" title="Alto Contraste">◐ Contraste</button>
            <button class="btn-acc" onclick="changeFontSize('small')" title="Reducir Fuente">-A</button>
            <button class="btn-acc" onclick="changeFontSize('large')" title="Aumentar Fuente">+A</button>
        </div>
    </div>

    <!-- Layout Principal -->
    <main class="layout-dashboard-main">
        <aside>
            <div class="menu-sidebar-left">
                <div style="padding: 10px 24px; font-size: 0.8rem; text-transform: uppercase; font-weight: 700; color: var(--color-primary); opacity: 0.7;">
                    @if(Auth::user()->usuario_rol === 'admin')
                        Panel Central
                    @else
                        Menú Funcionario
                    @endif
                </div>
                <ul>
                    @yield('sidebar_menu')
                </ul>
            </div>
        </aside>

        <section class="panel-dashboard-content">
            @if (session('success'))
                <div class="form-group-item" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                    <strong>Éxito:</strong> {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="form-group-item" style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                    <strong>Error:</strong> {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </section>
    </main>

    <footer class="footer-credits-institution">
        <p>© 2026 FirmaGob - Gobierno de Chile. Todos los derechos reservados.</p>
    </footer>

    <!-- Scripts de Accesibilidad -->
    <script>
        function toggleContrast() {
            document.body.classList.toggle('high-contrast');
            const isHigh = document.body.classList.contains('high-contrast');
            localStorage.setItem('high-contrast', isHigh ? 'true' : 'false');
        }

        function changeFontSize(size) {
            const html = document.documentElement;
            html.classList.remove('font-small', 'font-large', 'font-xlarge');
            if (size === 'small') {
                html.classList.add('font-small');
                localStorage.setItem('font-size', 'small');
            } else if (size === 'large') {
                html.classList.add('font-large');
                localStorage.setItem('font-size', 'large');
            } else if (size === 'xlarge') {
                html.classList.add('font-xlarge');
                localStorage.setItem('font-size', 'xlarge');
            } else {
                localStorage.setItem('font-size', 'normal');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('high-contrast') === 'true') {
                document.body.classList.add('high-contrast');
            }
            const savedSize = localStorage.getItem('font-size');
            if (savedSize) changeFontSize(savedSize);
        });
    </script>

    @stack('scripts')
</body>
</html>