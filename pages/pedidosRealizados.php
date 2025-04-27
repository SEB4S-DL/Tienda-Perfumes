<?php
// Mostrar errores en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sesión solo si aún no está activa
include '../includes/validarSession.php';

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
  
  <!-- Estilos para los botones de estado y el select -->
  <style>
    /* Estilos para los botones de estado */
    button[type="submit"] {
        padding: 10px 15px;
        background-color: #4b3c2f; /* Color café */
        color: white;
        border: none;
        font-size: 14px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s, transform 0.2s ease-in-out;
    }

    button[type="submit"]:hover {
        background-color: #3c2a1e; /* Color más oscuro de café al pasar el mouse */
        transform: scale(1.05); /* Efecto de aumento al pasar el mouse */
    }

    button[type="submit"]:active {
        background-color: #2b1c14; /* Color aún más oscuro al hacer clic */
        transform: scale(1); /* Mantener tamaño normal al hacer clic */
    }

    /* Estilos para el select */
    select {
        padding: 10px;
        background-color: #4b3c2f; /* Fondo café */
        color: white; /* Texto blanco */
        border: 1px solid #ddd; /* Borde suave */
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    select:hover {
        background-color: #3c2a1e; /* Color más oscuro de café al pasar el mouse */
    }

    /* Estilos para las opciones dentro del select */
    select option {
        background-color: #4b3c2f; /* Fondo café */
        color: white; /* Texto blanco */
    }

    select option:hover {
        background-color: #3c2a1e; /* Color más oscuro de café al pasar el mouse sobre la opción */
    }
  </style>
</head>
<body>

<?php include '../includes/header.php'; ?>

<div class="cart-header" style="background-color: #3c2a1e;">
    <h2 style="color: #ddd; margin-left: 700px">PEDIDOS REALIZADOS</h2>
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
                                <!-- Siempre permitir cambiar el estado, incluso si ya es 'entregado' -->
                                <form action="pedidosRealizados.php" method="post">
                                    <input type="hidden" name="pedido_id" value="<?= $pedido['id'] ?>">
                                    <select name="estado" required>
                                        <option value="pendiente" <?= $pedido['estado'] === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                        <option value="enviado" <?= $pedido['estado'] === 'enviado' ? 'selected' : '' ?>>Enviado</option>
                                        <option value="entregado" <?= $pedido['estado'] === 'entregado' ? 'selected' : '' ?>>Entregado</option>
                                    </select>
                                    <button type="submit">Actualizar Estado</button>

                                    <a href="detallePedido.php?id=<?= $pedido['id'] ?>" class="btn-ver-descripcion" style="background-color: #2b1c14; color:white; padding:10px; border:none; text-decoration:none">Ver descripcion</a>

                                </form>
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
