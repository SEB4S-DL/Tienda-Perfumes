<?php 
session_start();

// Aseguramos que el usuario esté logueado
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
    header("Location: ../pages/login.php");
    exit();
}

// Calcular el total del carrito
$total = 0;
if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
    foreach ($_SESSION['carrito'] as $item) {
      $precio = floatval($item['precio']);
      $total += $precio * intval($item['cantidad']);
      
    }
} else {
    // Mostrar mensaje y redirigir si el carrito está vacío
    $_SESSION['error_carrito_vacio'] = "Tu carrito está vacío. Agrega productos antes de continuar.";
    header("Location: ../pages/carrito.php");
    exit();
}

// Obtener ID del usuario
$usuario_id = $_SESSION['usuario']['id'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Realizar Pedido - Nuit de Parfum</title>
  <link rel="stylesheet" href="../assets/css/realizarPedido.css" />
  <link rel="stylesheet" href="../assets/css/styleheader.css">
  <link rel="stylesheet" href="../assets/css/stylefooter.css">
</head>
<body>
<?php include '../includes/header.php'; ?>
<main class="contenedor">
  <h2>Realizar Pedido</h2>

  <?php 
  if (isset($_SESSION['error_carrito_vacio'])) {
      echo '<p class="error-message">' . $_SESSION['error_carrito_vacio'] . '</p>';
      unset($_SESSION['error_carrito_vacio']);
  }
  ?>

  <form action="../backend/procesarPedido.php" method="post">
    <input type="hidden" name="usuario_id" value="<?= $usuario_id ?>" />

    <input type="text" name="provincia" placeholder="Departamento" required />
    <input type="text" name="localidad" placeholder="Ciudad" required />
    <input type="text" name="direccion" placeholder="Dirección" required />
    
    <label for="coste">Total:</label>
    <input type="text" name="coste" id="coste" value="<?= number_format($total, 2, '.', '') ?>" readonly />

    <button type="submit">Confirmar Pedido</button>
  </form>
</main>
</body>
</html>