<?php 
// includes/header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();

    
}

require_once __DIR__ . '/../db/db.php';


// Extraigo los datos de usuario de la sesión
$usuario = $_SESSION['usuario'] ?? null;
$rol     = $usuario['rol']     ?? null;
$nombre  = $usuario['nombre']  ?? null;
$imagen  = $usuario['imagen']  ?? null;

// Obtengo la página actual para el menú activo
$ruta = basename($_SERVER['PHP_SELF']);

$categorias_result = mysqli_query($conexion, "SELECT id, nombre FROM categorias ORDER BY nombre ASC");
?>
<header>
  <div class="logo-section">
    <div class="logo">
      <img src="/TIENDA-PERFUMES/assets/img/LogoPerfumeria.jpg" alt="Logo Perfumería">
    </div>
    <div class="brand">
      <h1>Nuit de Parfum</h1>
      <p>Perfumería</p>
    </div>
  </div>

  <nav>
    <ul class="main-menu">
      <li><a href="/TIENDA-PERFUMES/index.php" class="<?= $ruta=='index.php' ? 'active':'' ?>">Inicio</a></li>
      
        <li class="dropdown">
        <a href="#" class="dropdown-toggle <?= in_array($ruta, ['productos_por_categoria.php']) ? 'active' : '' ?>">
          Perfumes <span class="arrow-down">▼</span>
        </a>
        <ul class="dropdown-menu">
          <?php while ($cat = mysqli_fetch_assoc($categorias_result)): ?>
            <li><a href="/TIENDA-PERFUMES/pages/PlantillaCategorias.php?id=<?= $cat['id'] ?>">
              <?= htmlspecialchars($cat['nombre']) ?>
            </a></li>
          <?php endwhile; ?>
        </ul>
      </li>
      </li>
      <li><a href="/TIENDA-PERFUMES/pages/sesionsobrenosotros.php" class="<?= $ruta=='sesionsobrenosotros.php'?'active':'' ?>">Sobre Nosotros</a></li>
      <li><a href="/TIENDA-PERFUMES/pages/sesioncontacto.php" class="<?= $ruta=='sesioncontacto.php'?'active':'' ?>">Contacto</a></li>

      <!-- Menú de administrador -->
      <?php if ($rol==='admin'): ?>
        <li><a href="/TIENDA-PERFUMES/pages/categorias.php">Categorías</a></li>
        <li><a href="/TIENDA-PERFUMES/pages/editarProducto.php">Crear Productos</a></li>
        <li><a href="/TIENDA-PERFUMES/pages/pedidosRealizados.php">Pedidos Realizados</a></li>
        <li><a href="/TIENDA-PERFUMES/pages/productos.php">Productos</a></li>
        <?php endif; ?>

      <?php if ($rol==='user'): ?>
      <li><a href="/TIENDA-PERFUMES/pages/gestionaarPedido.php">Pedidos</a></li>
      <?php endif; ?>

      <!-- Login / Logout -->
      <?php if (!$usuario): ?>
        <li><a href="/TIENDA-PERFUMES/pages/login.php">Iniciar Sesión</a></li>
      <?php else: ?>
        <li><a href="/TIENDA-PERFUMES/backend/logout.php">Cerrar Sesión</a></li>
      <?php endif; ?>
    </ul>
  </nav>

  <div class="search-profile">
  <a href="/TIENDA-PERFUMES/pages/carrito.php" class="cart-button">
  <svg width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
    <path d="M8 0a2 2 0 1 0 2 2 2 2 0 0 0-2-2zM5.5 1a.5.5 0 0 1 .5.5V3h6V1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V3h.5a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5h-12a.5.5 0 0 1-.5-.5V3a.5.5 0 0 1 .5-.5h.5V1a.5.5 0 0 1 .5-.5h2z"/>
  </svg>
</a>

    <!-- Formulario de búsqueda -->
    <form action="/TIENDA-PERFUMES/pages/busqueda.php" method="GET" class="search-bar">
      <input type="text" name="q" placeholder="Buscar perfume">
    </form>

    <!-- Perfil del usuario -->
    <?php if ($usuario): ?>
      <div class="profile">
        <?php 
          // Compruebo que exista el archivo de imagen
          $rutaImagen = $_SERVER['DOCUMENT_ROOT']."/TIENDA-PERFUMES/uploads/".$imagen;
          if ($imagen && file_exists($rutaImagen)): 
        ?>
          
          <a href="/TIENDA-PERFUMES/pages/sesionperfil.php"><img src="/TIENDA-PERFUMES/uploads/<?= htmlspecialchars($imagen) ?>" 
                 alt="<?= htmlspecialchars($nombre) ?>" 
                 style="width:40px;height:40px;border-radius:50%;"></a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</header>
