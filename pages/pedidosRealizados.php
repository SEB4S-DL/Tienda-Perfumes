<?php
// Mostrar errores en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sesión solo si aún no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require '../db/db.php'; // Conexión a la base de datos

// Verificar si es admin (solo si hay sesión y tiene 'rol')
$isAdmin = isset($_SESSION['usuario']) && isset($_SESSION['usuario']['rol']) && $_SESSION['usuario']['rol'] === 'admin';

// Si el admin envió un nuevo estado del pedido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isAdmin && isset($_POST['estado']) && isset($_POST['pedido_id'])) {
    $nuevo_estado = mysqli_real_escape_string($conexion, $_POST['estado']);
    $pedido_id = (int)$_POST['pedido_id'];
    $update_sql = "UPDATE pedidos SET estado = '$nuevo_estado' WHERE id = $pedido_id";
    
    if (mysqli_query($conexion, $update_sql)) {
        header("Location: pedidosRealizados.php"); // Redirigir a la lista de pedidos
        exit();
    } else {
        echo "Error al actualizar el estado: " . mysqli_error($conexion);
    }
}

// Obtener los pedidos desde la base de datos
$sql = "SELECT id, coste, fecha, estado FROM pedidos";
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

<div class="cart-header">
    <h2>PEDIDOS REALIZADOS</h2>
  </div>

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
                                    <form action="pedidosRealizados.php" method="post">
                                        <input type="hidden" name="pedido_id" value="<?= $pedido['id'] ?>">
                                        <select name="estado" required>
                                            <option value="pendiente" <?= $pedido['estado'] === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                            <option value="enviado" <?= $pedido['estado'] === 'enviado' ? 'selected' : '' ?>>Enviado</option>
                                            <option value="entregado" <?= $pedido['estado'] === 'entregado' ? 'selected' : '' ?>>Entregado</option>
                                        </select>
                                        <button type="submit">Actualizar Estado</button>
                                    </form>
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
<?php include '../includes/footer.php'?>
</body>
</html>
