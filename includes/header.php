<?php 
if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<header>
    <div class="logo-section">
        <div class="logo">
            <img src="/TIENDA-PERFUMES/assets/img/LogoPerfumeria.jpg">
        </div>
        <div class="brand">
            <h1>Nuit de Parfum</h1>
            <p>Perfumería</p>
        </div>
    </div>

    <nav>
        <ul class="main-menu">
            <li><a href="/TIENDA-PERFUMES/index.php" class="active">Inicio</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">Perfumes <span class="arrow-down">▼</span></a>
                <ul class="dropdown-menu">
                    <li><a href="/TIENDA-PERFUMES/pages/sesionperfumeunisex.php?categoria=1">Perfumes Unisex</a></li>
                    <li><a href="/TIENDA-PERFUMES/pages/sesionperfumehombre.php?categoria=2">Perfumes Hombre</a></li>
                    <li><a href="/TIENDA-PERFUMES/pages/sesionperfumemujer.php?categoria=3">Perfumes Mujer</a></li>
                </ul>
            </li>
            <li><a href="/TIENDA-PERFUMES/pages/sesionsobrenosotros.php">Sobre Nosotros</a></li>
            <li><a href="/TIENDA-PERFUMES/pages/sesioncontacto.php">Contacto</a></li>

            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                <li><a href="/TIENDA-PERFUMES/pages/categorias.php">Categorías</a></li>
                <li><a href="/TIENDA-PERFUMES/pages/editarProducto.php">Gestionar Productos</a></li>
                <li><a href="/TIENDA-PERFUMES/pages/detallePedido.php">Pedidos Realizados</a></li>
                <li><a href="/TIENDA-PERFUMES/pages/gestionaarPedido.php">Pedidos</a></li>
                <li><a href="/TIENDA-PERFUMES/pages/gestionarProducto.php">Productos</a></li>
            <?php endif; ?>

            <?php if (!isset($_SESSION['rol'])): ?>
                <li><a href="/TIENDA-PERFUMES/pages/login.php">Iniciar Sesión</a></li>
            <?php else: ?>
                <li><a href="/TIENDA-PERFUMES/backend/logout.php">Cerrar Sesión</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="search-profile">
        <a href="/TIENDA-PERFUMES/pages/carrito.php" class="cart-button" style="margin-left: 10px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
        </a>
        <div class="search-bar">
            <input type="text" placeholder="Buscar perfume">
            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>
        </div>
        <div class="profile">
            <?php if (isset($_SESSION['imagen']) && $_SESSION['imagen'] !== ''): ?>
                <img src="/TIENDA-PERFUMES/uploads/<?= htmlspecialchars($_SESSION['imagen']) ?>" alt="Perfil de usuario" style="width: 40px; height: 40px; border-radius: 50%;">
            <?php endif; ?>
            <a href="/TIENDA-PERFUMES/pages/sesionperfil.php">Perfil</a>
        </div>
    </div>
</header>
