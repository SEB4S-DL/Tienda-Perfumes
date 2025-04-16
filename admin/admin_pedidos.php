<?php
require '../includes/conexion.php';

$estado = $_GET['estado'] ?? '';
$sql = "SELECT * FROM pedidos";
if ($estado) {
    $estado = mysqli_real_escape_string($conn, $estado);
    $sql .= " WHERE estado = '$estado'";
}
$pedidos = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestionar Pedidos - Admin</title>
  <link rel="stylesheet" href="../assets/css/gestionarPedido.css">
</head>
<body>
<?php include '../includes/header.php'; ?>

<main>
  <h2>GESTIONAR PEDIDOS</h2>

  <form method="GET" id="filtroForm">
    <label for="estado">Filtrar por estado:</label>
    <select name="estado" id="estado">
      <option value="">Todos</option>
      <option value="pendiente" <?= $estado === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
      <option value="en proceso" <?= $estado === 'en proceso' ? 'selected' : '' ?>>En proceso</option>
      <option value="enviado" <?= $estado === 'enviado' ? 'selected' : '' ?>>Enviado</option>
      <option value="entregado" <?= $estado === 'entregado' ? 'selected' : '' ?>>Entregado</option>
    </select>
    <button type="submit">Filtrar</button>
  </form>

  <table id="tablaPedidos">
    <thead>
      <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Precio</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
      <?php if (mysqli_num_rows($pedidos) > 0): ?>
        <?php while ($p = mysqli_fetch_assoc($pedidos)): ?>
          <tr>
            <td><?= $p['id'] ?></td>
            <td><?= $p['usuario_id'] ?></td>
            <td>$<?= number_format($p['precio'], 0, ',', '.') ?></td>
            <td><?= $p['fecha'] ?></td>
            <td><?= $p['estado'] ?></td>
            <td><a href="../backend/cambiar_estado.php?id=<?= $p['id'] ?>">Cambiar Estado</a></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="6">No hay pedidos en este estado.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</main>

</body>
</html>
