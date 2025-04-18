<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      <p>Cargando carrito...</p>
    </div>

    <div class="cart-footer">
      <button class="btn clear" onclick="vaciarCarrito()">Vaciar Carrito</button>
      <div class="total">
        <span id="total">Precio Total: $0 COP</span>
        <a href="../pages/realizarPedido.php" class="btn order">Hacer Pedido</a>
      </div>
    </div>
  </main>
  <script src="../js/carrito.js"></script>
</body>
</html>