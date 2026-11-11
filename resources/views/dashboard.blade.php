<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GestorComercial | Panel administrativo</title>
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
            <a href="/" class="menu-item active">▦ <span>Dashboard</span></a>
            <a href="#" class="menu-item">▤ <span>Productos</span></a>
            <a href="#" class="menu-item">▧ <span>Categorías</span></a>
            <a href="#" class="menu-item">♙ <span>Clientes</span></a>
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
                <h3>Panel de control</h3>
                <p>Gestión general de tu negocio</p>
            </div>
            <div class="top-user">
                <span>● Sistema activo</span>
            </div>
        </header>

        <section class="content">

<div class="welcome">
                <div>
                    <h1>¡Bienvenido a GestorComercial!</h1>
                    <p>Consulta los indicadores y analiza el comportamiento de tu negocio.</p>
                </div>
                <div class="welcome-icon">📊</div>
            </div>

            <div class="section-heading">
                <div>
                    <h2>Dashboard de análisis</h2>
                    <p>Información de ventas e inventario conectada a Supabase.</p>
                </div>
                <span class="period">Datos en tiempo real</span>
            </div>

            <div style="width: 100%; min-height: 800px; background: white; border-radius: 12px; overflow: hidden;">
                <iframe
                    src="https://datastudio.google.com/embed/reporting/d83510d7-8388-4df7-808f-40f5085db1c2/page/p_cw5dh0o78d"
                    width="100%"
                    height="800"
                    frameborder="0"
                    style="border: 0;"
                    allowfullscreen>
                </iframe>
            </div>

            <footer>
                GestorComercial © 2026 · Sistema de gestión empresarial
            </footer>
        </section>
    </main>
</div>

</body>
</html>