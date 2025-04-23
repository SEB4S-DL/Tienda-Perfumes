<?php
// Asegúrate de iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define la base del proyecto (ajusta si cambia el nombre de tu carpeta)
define('BASE_URL', '/TIENDA-PERFUMES/');

// Incluir la conexión a la base de datos
require __DIR__ . '/../db/db.php';

// Definir la variable de búsqueda y sanitizarla
$busqueda = isset($_GET['q']) ? $_GET['q'] : '';
$busqueda = htmlspecialchars($busqueda);

// Inicializar los resultados
$resultados = null;

if (!empty($busqueda)) {
    $query = "SELECT * FROM productos WHERE nombre LIKE '%$busqueda%' AND activo = 1";
    $resultados = mysqli_query($conexion, $query);

    if (!$resultados) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Buscar productos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/styleheader.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/stylefooter.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/stylePaginaInicio.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .contenedor {
      max-width: 1200px;
      margin: 0 auto;
      padding: 30px 15px;
    }

    h2 {
      margin-bottom: 20px;
      font-size: 28px;
      color: #333;
    }

    .contenedor-productos {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
    }

    .producto {
      background-color: #fff;
      border-radius: 10px;
      padding: 15px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
      text-align: center;
    }

    .producto img {
      max-width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 8px;
    }

    .producto h3 {
      margin: 10px 0 5px;
      font-size: 18px;
      color: #222;
    }

    .producto p {
      margin: 5px 0;
      color: #555;
    }

    .precio {
      margin: 10px 0;
      font-weight: bold;
      font-size: 16px;
    }

    .precio-oferta {
      text-decoration: line-through;
      color: #888;
      font-size: 14px;
      margin-right: 5px;
    }

    button {
      background-color: #78624f;
      color: white;
      border: none;
      border-radius: 20px;
      padding: 8px 16px;
      cursor: pointer;
      font-weight: bold;
    }

    button:hover {
      background-color: #5e4e3f;
    }

    .admin-buttons {
      margin-top: 10px;
    }

    .admin-buttons a {
      display: inline-block;
      margin: 5px;
      padding: 6px 12px;
      background-color: #d33;
      color: white;
      text-decoration: none;
      border-radius: 10px;
      font-size: 14px;
    }

    .admin-buttons a:hover {
      background-color: #a00;
    }

    .buscador-form {
      text-align: center;
      margin-bottom: 30px;
    }

    .buscador-form input[type="text"] {
      padding: 10px;
      width: 250px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-right: 10px;
    }

    .buscador-form button {
      padding: 10px 16px;
      border-radius: 8px;
    }
  </style>
</head>
<body>

  <?php include_once __DIR__ . '/../includes/header.php'; ?>

  <main class="contenedor">

    <div class="buscador-form">
      <form action="" method="GET">
        <input type="text" name="q" placeholder="Buscar perfume..." value="<?= htmlspecialchars($busqueda) ?>">
        <button type="submit">Buscar</button>
      </form>
    </div>

    <h2>Resultados de búsqueda para: <em><?= htmlspecialchars($busqueda) ?></em></h2>

    <?php if ($resultados && mysqli_num_rows($resultados) > 0): ?>
      <div class="contenedor-productos">
        <?php while ($producto = mysqli_fetch_assoc($resultados)): ?>
          <div class="producto">
            <img src="<?= BASE_URL ?>uploads/<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">
            <h3><?= htmlspecialchars($producto['nombre']) ?></h3>
            <p class="precio">$<?= number_format($producto['precio'], 2) ?></p>

            <form action="<?= BASE_URL ?>backend/carrito.php" method="POST">
              <input type="hidden" name="id_producto" value="<?= $producto['id'] ?>">
           
            </form>

            <?php if (isset($_SESSION['usuario']['rol']) && $_SESSION['usuario']['rol'] === 'admin'): ?>
              <div class="admin-buttons">
                <a href="<?= BASE_URL ?>pages/editar_Productos.php?id=<?= $producto['id'] ?>">Editar</a>
                <a href="<?= BASE_URL ?>backend/eliminar_Producto.php?id=<?= $producto['id'] ?>" onclick="return confirm('¿Seguro que quieres eliminar este producto?')">Eliminar</a>
              </div>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <p>No se encontraron productos que coincidan con tu búsqueda.</p>
    <?php endif; ?>

  </main>

  <?php include_once __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
