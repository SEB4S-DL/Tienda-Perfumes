<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styleheader.css">
</head>
<body>
<header>
            <div class="logo-section">
                <div class="logo">
                    <img src="../assets/img/LogoPerfumeria.jpg">
                </div>
                <div class="brand">
                    <h1>Nuit de Parfum</h1>
                    <p>Perfumería</p>
                </div>
            </div>

            <nav>
                <ul class="main-menu">
                    <li><a href="../pages/inicio.php" class="active">Inicio</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">Perfumes <span class="arrow-down">▼</span></a>
                        <ul class="dropdown-menu">
                            <li><a href="../pages/sesionperfumeunisex.php">Perfumes Unisex</a></li>
                            <li><a href="../pages/sesionperfumehombre.php">Perfumes Hombre</a></li>
                            <li><a href="../pages/sesionperfumemujer.php">Perfumes Mujer</a></li>
                        </ul>
                    </li>
                    <li><a href="../pages/sesionsobrenosotros.php">Sobre Nosotros</a></li>
                    <li><a href="../pages/sesioncontacto.php">Contacto</a></li>
                </ul>
            </nav>
            
            <div class="search-profile">
                <a href="../pages/carrito.php" class="cart-button" style="margin-left: 10px;">
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
                    <img src="../assets/img/imagenperfil.jpg" alt="Perfil de usuario">
                    <a href="../pages/sesionperfil.php">.</a>
                </div>
            </div>
        </header>
</body>
</html>