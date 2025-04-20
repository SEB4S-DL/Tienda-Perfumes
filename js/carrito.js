<?php
session_start();
require '../db/db.php';

$carrito = $_SESSION['carrito'] ?? [];

$productos = [];

if (!empty($carrito)) {
    $ids = implode(',', array_keys($carrito));
    $query = "SELECT * FROM productos WHERE id IN ($ids)";
    $resultado = mysqli_query($conexion, $query);

    while ($producto = mysqli_fetch_assoc($resultado)) {
        $producto['cantidad'] = $carrito[$producto['id']];
        $producto['subtotal'] = $producto['cantidad'] * $producto['precio'];
        $productos[] = $producto;
    }
}
?>
<div>
  <?php foreach ($productos as $prod): ?>
    <div class="item">
      <img src="<?= $prod['imagen'] ?>" width="80">
      <p><?= $prod['nombre'] ?></p>
      <p><?= $prod['cantidad'] ?> unidad(es)</p>
      <p>$<?= number_format($prod['subtotal'], 0, ',', '.') ?> COP</p>
    </div>
  <?php endforeach; ?>
  <hr>
  <strong>Total: $
    <?= number_format(array_sum(array_column($productos, 'subtotal')), 0, ',', '.') ?> COP
  </strong>
<?php if (!empty($productos)): ?>
    <br><a href="../pages/realizarPedido.php" class="btn order">Hacer Pedido</a>
<?php endif; ?>
</div>