<?php
session_start();
require '../db/db.php';

// Asegurar acceso solo para admins
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$productos = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM productos"));
$usuarios = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM usuarios"));
$pedidos = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM pedidos"));
$pendientes = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM pedidos WHERE estado = 'pendiente'"));
?>

<h2>Panel de Administrador</h2>
<ul>
    <li>Total de productos: <?= $productos ?></li>
    <li>Total de usuarios: <?= $usuarios ?></li>
    <li>Total de pedidos: <?= $pedidos ?></li>
    <li>Pedidos pendientes: <?= $pendientes ?></li>
</ul>

<a href="admin_productos.php">Gestionar productos</a><br>
<a href="admin_pedidos.php">Gestionar pedidos</a><br>
<a href="admin_categorias.php">Gestionar categorías</a>
