<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'GestorComercial')</title>

    <link rel="stylesheet" href="{{ asset('css/gestor.css') }}">
</head>
<body>

<div class="app">

    <aside class="sidebar">

        <div class="brand">
            <div class="brand-icon">G</div>
            <div>
                <h2>GestorComercial</h2>
                <span>Panel administrativo</span>
            </div>
        </div>

        <div class="menu-label">MENÚ PRINCIPAL</div>

        <nav>
            <a href="/" class="menu-item">
                ▦ <span>Dashboard</span>
            </a>

            <a href="{{ route('productos.index') }}" class="menu-item active">
                ▤ <span>Productos</span>
            </a>

            <a href="{{ route('categorias.index') }}" class="menu-item">▧ <span>Categorías</span></a>
            <a href="{{ route('clientes.index') }}" class="menu-item">
    ♙ <span>Clientes</span>
</a>
<a href="#" class="menu-item">♧ <span>Proveedores</span></a>
<a href="#" class="menu-item">▣ <span>Ventas</span></a>
<a href="#" class="menu-item">▥ <span>Pagos</span></a>
        </nav>

        <div class="menu-label">ANÁLISIS</div>

        <nav>
            <a href="#" class="menu-item">▨ <span>Reportes</span></a>
            <a href="#" class="menu-item">⚙ <span>Configuración</span></a>
        </nav>

        <div class="sidebar-footer">
            <div class="avatar">CO</div>
            <div>
                <strong>Administrador</strong>
                <span>Gestión empresarial</span>
            </div>
        </div>

    </aside>

    <main class="main">

        <header class="topbar">
            <div>
                <h3>@yield('header', 'GestorComercial')</h3>
                <p>Gestión general de tu negocio</p>
            </div>

            <div class="top-user">
                <span>● Sistema activo</span>
            </div>
        </header>

        <section class="content">
            @yield('content')

            <footer>
                GestorComercial © 2026 · Sistema de gestión empresarial
            </footer>
        </section>

    </main>

</div>

</body>
</html>