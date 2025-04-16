<?php
session_start();
require '../db/db.php';

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Acciones
if (isset($_GET['sumar'])) {
    $_SESSION['carrito'][$_GET['sumar']]['cantidad']++;
}
if (isset($_GET['restar'])) {
    $id = $_GET['restar'];
    $_SESSION['carrito'][$id]['cantidad']--;
    if ($_SESSION['carrito'][$id]['cantidad'] <= 0) {
        unset($_SESSION['carrito'][$id]);
    }
}
if (isset($_GET['eliminar'])) {
    unset($_SESSION['carrito'][$_GET['eliminar']]);
}
if (isset($_GET['vaciar'])) {
    $_SESSION['carrito'] = [];
}

$productos = $_SESSION['carrito'];
$total = 0;

foreach ($productos as $p) {
    $total += $p['precio'] * $p['cantidad'];
}
?>

<div data-total="<?= $total ?>">
    <?php if (empty($productos)): ?>
        <p>El carrito está vacío.</p>
    <?php else: ?>
        <?php foreach ($productos as $p): ?>
            <div class="cart-item">
                <span class="item-name"><?= htmlspecialchars($p['nombre']) ?></span>
                <span class="item-qty">Cantidad: <?= $p['cantidad'] ?></span>
                <span class="item-price">$<?= number_format($p['precio'] * $p['cantidad'], 0, ',', '.') ?> COP</span>
                <div class="item-actions">
                    <button onclick="actualizarCarrito('sumar', <?= $p['id'] ?>)">[+]</button>
                    <button onclick="actualizarCarrito('restar', <?= $p['id'] ?>)">[-]</button>
                    <button onclick="actualizarCarrito('eliminar', <?= $p['id'] ?>)">[Eliminar]</button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
