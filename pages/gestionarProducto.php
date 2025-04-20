<?php
session_start();
require '../db/db.php';
include '../includes/header.php';

// Validación de sesión para permitir solo admin
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location:/TIENDA-PERFUMES/pages/detallePedido.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$isAdmin = $usuario['rol'] === 'admin';

// Escapamos el ID por seguridad aunque venga de la sesión
$usuario_id = mysqli_real_escape_string($conexion, $usuario['id']);

// Consulta SQL según rol
if ($isAdmin) {
    $sql = "SELECT * FROM pedidos ORDER BY fecha DESC";
} else {
    $sql = "SELECT * FROM pedidos WHERE usuario_id = $usuario_id ORDER BY fecha DESC";
}

// Ejecutar consulta y verificar errores
$resultado = mysqli_query($conexion, $sql);

if (!$resultado) {
    echo "Error en la consulta: " . mysqli_error($conexion);
    exit();
}
?>
<!-- 
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pedidos - Nuit de Parfum</title>
  <link rel="stylesheet" href="../assets/css/gestionarProducto.css" />
  <link rel="stylesheet" href="../assets/css/styleheader.css" />
  <link rel="stylesheet" href="../assets/css/stylePaginaInicio.css" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins&display=swap" rel="stylesheet">
</head>
<body>

<h2 style="text-align:center; margin-top: 20px;">
  <?= $isAdmin ? "Gestión de todos los pedidos" : "Historial de tus pedidos" ?>
</h2>

<table>
  <thead>
    <tr>
      <th>N°</th>
      <th>ID Pedido</th>
      <th>Fecha</th>
      <th>Dirección</th>
      <th>Estado</th>
      <th>Total</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $contador = 1;
    while ($row = mysqli_fetch_assoc($resultado)): ?>
      <tr>
        <td><?= $contador++ ?></td>
        <td><?= $row['id'] ?></td>
        <td><?= $row['fecha'] ?></td>
        <td><?= htmlspecialchars($row['direccion']) ?></td>
        <td><?= ucfirst(htmlspecialchars($row['estado'])) ?></td>
        <td>$<?= number_format($row['coste'], 0, ',', '.') ?> COP</td>
        <td>
          <a href="detallePedido.php?id=<?= $row['id'] ?>" class="btn">Ver Detalle</a>
          <?php if ($isAdmin): ?>
            <a href="/TIENDA-PERFUMES/backend/cambiar_estado_pedido.php?id=<?= $row['id'] ?>" class="btn editar">Editar Estado</a>
          <?php endif; ?>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

</body>
</html> -->
