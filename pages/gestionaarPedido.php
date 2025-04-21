<?php
// Mostrar errores en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sesión si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require '../db/db.php';

// Verificar rol
$isAdmin = isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] === 'admin';
$idUsuario = $_SESSION['usuario']['id'] ?? null;

// Actualizar estado del pedido (solo admin)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isAdmin && isset($_POST['estado'], $_POST['pedido_id'])) {
    $nuevo_estado = mysqli_real_escape_string($conexion, $_POST['estado']);
    $pedido_id = (int)$_POST['pedido_id'];

    $update_sql = "UPDATE pedidos SET estado = '$nuevo_estado' WHERE id = $pedido_id";

    if (mysqli_query($conexion, $update_sql)) {
        header("Location: pedidosRealizados.php");
        exit();
    } else {
        echo "Error al actualizar el estado: " . mysqli_error($conexion);
    }
}

// Obtener pedidos según el rol
if ($isAdmin) {
    $sql = "SELECT id, coste, fecha, estado FROM pedidos";
} else {
    $sql = "SELECT id, coste, fecha, estado FROM pedidos WHERE usuario_id = $idUsuario";
}

$resultado = mysqli_query($conexion, $sql);
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Pedidos Realizados - Nuit de Parfum</title>
  <link rel="stylesheet" href="../assets/css/styleheader.css" />
  <link rel="stylesheet" href="../assets/css/stylefooter.css" />
  <link rel="stylesheet" href="../assets/css/gestionarPedido.css" />
</head>
<body>

<?php include '../includes/header.php'; ?>
<br>
<div style="background-color: #2E211D;">
    <h2 style="color: white; margin-left: 750px">PEDIDOS REALIZADOS</h2>
  </div>
<br>
<main class="main-content">
    <div class="cart-container">
        <table class="cart-table">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Precio</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado && mysqli_num_rows($resultado) > 0): ?>
                    <?php while ($pedido = mysqli_fetch_assoc($resultado)): ?>
                        <tr>
                            <td><?= $pedido['id'] ?></td>
                            <td>$<?= number_format($pedido['coste'], 0, ',', '.') ?> COP</td>
                            <td><?= $pedido['fecha'] ?></td>
                            <td><?= ucfirst(htmlspecialchars($pedido['estado'])) ?></td>
                            <td>
                                <?php if ($pedido['estado'] !== 'entregado'): ?>
                                   
                                <?php else: ?>
                                    <em>Finalizado</em>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5">No se encontraron pedidos.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>
