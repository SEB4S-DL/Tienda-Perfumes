<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require '../db/db.php';

$carrito = $_SESSION['carrito'] ?? [];
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
  <style>
    .cantidad-controls {
      display: flex;
      align-items: center;
      gap: 5px;
    }
    .cantidad-controls button {
      padding: 4px 10px;
      background-color: #78624f;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .cantidad-controls button:hover {
      background-color: #5e4e3f;
    }
  </style>
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
              <div class="cantidad-controls">
                <form method="POST" action="../backend/carrito.php" style="display:inline;">
                  <input type="hidden" name="disminuir_producto_id" value="<?= $item['id'] ?>">
                  <button type="submit">−</button>
                </form>

                <span><?= $item['cantidad'] ?></span>

                <form method="POST" action="../backend/carrito.php" style="display:inline;">
                  <input type="hidden" name="aumentar_producto_id" value="<?= $item['id'] ?>">
                  <button type="submit">+</button>
                </form>
              </div>
              <p>Total: $<?= number_format($item['precio'] * $item['cantidad'], 0) ?> COP</p>
            </div>

            <!-- Formulario para eliminar producto -->
            <form method="POST" action="../backend/carrito.php" class="delete-form">
              <input type="hidden" name="eliminar_producto_id" value="<?= $item['id'] ?>">
              <button type="submit" class="btn eliminar" style="background-color: #2E211F;">Eliminar</button>
            </form>
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
        <p><strong>Total a pagar:</strong> $<?= number_format($total, 0) ?> COP</p>
        <a href="../pages/realizarPedido.php" class="btn order">Hacer Pedido</a>
      </div>
    </div>
    <?php endif; ?>
  </main>

  <script src="../js/carrito.js"></script>
</body>
</html>
