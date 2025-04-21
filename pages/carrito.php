<?php
if (session_status() === PHP_SESSION_NONE) session_start(); 
?>
<?php

require '../db/db.php';
$carrito = $_SESSION['carrito'] ?? [];
// Obtener el carrito de la sesión
if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) 
  // El carrito tiene productos
?>

<script>
  var carrito = <?php echo json_encode($carrito); ?>;
  localStorage.setItem('carrito', JSON.stringify(carrito));
</script>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Carrito de Compras</title>
  <link rel="stylesheet" href="../assets/css/carrito.css">
  <link rel="stylesheet" href="../assets/css/styleheader.css">
  <link rel="stylesheet" href="../assets/css/stylefooter.css">
</head>
<body>
  <?php include '../includes/header.php'; ?>

  <main class="cart-container">
    <h2>CARRITO DE COMPRAS</h2>

    <div id="cart-items">
      <?php if (!empty($carrito)): ?>
        <?php $total = 0; ?>
        <?php foreach ($carrito as $item): ?>
          <div class="cart-item">
          <img src="../uploads/<?= htmlspecialchars($item['imagen']) ?>" alt="<?= htmlspecialchars($item['nombre']) ?>">


            <div class="cart-details">
              <p><strong><?= htmlspecialchars($item['nombre']) ?></strong></p>
              <p>Precio unitario: $<?= number_format($item['precio'], 0) ?> COP</p>
              <p>Cantidad: <?= $item['cantidad'] ?></p>
              <p>Total: $<?= number_format($item['precio'] * $item['cantidad'], 0) ?> COP</p>
            </div>
          </div>
          <?php $total += $item['precio'] * $item['cantidad']; ?>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Tu carrito está vacío.</p>
      <?php endif; ?>
    </div>

    <?php if (!empty($carrito)): ?>
    <div class="cart-footer">
      <form action="../backend/vaciarCarrito.php" method="post">
        <button type="submit" class="btn clear">Vaciar Carrito</button>
      </form>

      <div class="total">
      <?php if (!empty($_SESSION['carrito'])): ?>
  <a href="../pages/realizarPedido.php" class="btn order">Hacer Pedido</a>
<?php endif; ?>
      </div>
    </div>
    <?php endif; ?>
  </main>

  <script src="../js/carrito.js"></script>
</body>
</html>
