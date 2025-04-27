<?php
// Mostrar errores en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sesión solo si aún no está activa
include '../includes/validarSession.php';
require '../db/db.php'; // Conexión a la base de datos

// Obtener el ID del pedido desde la URL
$pedido_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Verificar que el ID sea válido
if ($pedido_id <= 0) {
    echo "ID de pedido inválido.";
    exit();
}

// Recuperar los detalles del pedido desde la base de datos
$sql = "SELECT * FROM pedidos WHERE id = $pedido_id";
$resultado = mysqli_query($conexion, $sql);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $pedido = mysqli_fetch_assoc($resultado);
} else {
    echo "No se encontró el pedido.";
    exit();
}

// Verificar si es admin (solo si hay sesión y tiene 'rol')
$isAdmin = isset($_SESSION['usuario']) && isset($_SESSION['usuario']['rol']) && $_SESSION['usuario']['rol'] === 'admin';

// Si el admin envió un nuevo estado del pedido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isAdmin && isset($_POST['estado'])) {
    $nuevo_estado = mysqli_real_escape_string($conexion, $_POST['estado']);
    $update_sql = "UPDATE pedidos SET estado = '$nuevo_estado' WHERE id = $pedido_id";
    
    if (mysqli_query($conexion, $update_sql)) {
        header("Location: detallePedido.php?id=$pedido_id");
        exit();
    } else {
        echo "Error al actualizar el estado: " . mysqli_error($conexion);
    }
}

// Obtener los productos del pedido (líneas de pedido)
$sql_lineas = "SELECT lp.*, p.nombre, p.imagen, p.precio, p.precio_oferta 
               FROM lineas_pedidos lp
               JOIN productos p ON lp.producto_id = p.id
               WHERE lp.pedido_id = $pedido_id";
$resultado_lineas = mysqli_query($conexion, $sql_lineas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../assets/css/styleheader.css" />
  <link rel="stylesheet" href="../assets/css/stylefooter.css" />
  <link rel="stylesheet" href="../assets/css/gestionarPedido.css" />
  <title>Detalle Pedido - Nuit de Parfum</title>
  <style>
    /* Estilo general */
    body {
        font-family: Arial, sans-serif;
        background-color: #5a4e42;
        color: #5a4e42; /* Color café suave */
        margin: 0;
        padding: 0;
    }

    h2, h3 {
        color: white; /* Café más oscuro para los encabezados */
        text-align: center;
    }

    h2 {
        margin-top: 20px;
    }

    h3 {
        margin-top: 40px;
    }

    /* Estilo para los contenedores */
    .detalle-pedido, .lineas-pedido {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin: 20px;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Estilos para los párrafos */
    p {
        font-size: 1.1rem;
        margin: 8px 0;
        line-height: 1.5;
    }

    strong {
        color: #4f3821;
    }

    /* Estilo para las tablas */
    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        text-align: left;
    }

    th, td {
        padding: 12px;
        border: 1px solid #d1b19d; /* Borde sutil color café */
    }

    th {
        background-color: #8e735b; /* Café más intenso */
        color: white;
        font-weight: bold;
    }

    td {
        background-color: #f9f4e3; /* Blanco suave con toque cálido */
    }

    /* Estilo para imágenes */
    img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    /* Estilo para formularios */
    form {
        display: flex;
        flex-direction: column;
        margin-top: 20px;
    }

    form label {
        font-size: 1.1rem;
        margin-bottom: 8px;
        color: #4f3821;
    }

    form select, form button {
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        border: 1px solid #8e735b;
        font-size: 1rem;
    }

    form select {
        background-color: #f9f4e3;
    }

    form button {
        background-color: #8e735b;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    form button:hover {
        background-color: #6c533f; /* Cambio al color más oscuro del café */
    }

    /* Estilo de mensaje de error */
    .error {
        color: red;
        font-weight: bold;
        text-align: center;
    }
  </style>
</head>
<body>

<?php include '../includes/header.php'; ?>

<h2>Detalle del Pedido</h2>

<div class="detalle-pedido">
    <p><strong>ID Pedido:</strong> <?= $pedido['id'] ?></p>
    <p><strong>Provincia:</strong> <?= htmlspecialchars($pedido['provincia']) ?></p>
    <p><strong>Localidad:</strong> <?= htmlspecialchars($pedido['localidad']) ?></p>
    <p><strong>Dirección:</strong> <?= htmlspecialchars($pedido['direccion']) ?></p>
    <p><strong>Precio Total:</strong> $<?= number_format($pedido['coste'], 0, ',', '.') ?> COP</p>
    <p><strong>Estado:</strong> <?= ucfirst(htmlspecialchars($pedido['estado'])) ?></p>
    <p><strong>Fecha:</strong> <?= $pedido['fecha'] ?></p>
    <p><strong>Hora:</strong> <?= $pedido['hora'] ?></p>

    <?php if ($isAdmin): ?>
        <form action="detallePedido.php?id=<?= $pedido['id'] ?>" method="post">
            <label for="estado">Cambiar Estado:</label>
            <select name="estado" required>
                <option value="pendiente" <?= $pedido['estado'] === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                <option value="enviado" <?= $pedido['estado'] === 'enviado' ? 'selected' : '' ?>>Enviado</option>
                <option value="entregado" <?= $pedido['estado'] === 'entregado' ? 'selected' : '' ?>>Entregado</option>
            </select>
            <button type="submit">Actualizar Estado</button>
        </form>
    <?php endif; ?>
</div>

<h3>Productos del Pedido</h3>
<div class="lineas-pedido">
    <?php if ($resultado_lineas && mysqli_num_rows($resultado_lineas) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($linea = mysqli_fetch_assoc($resultado_lineas)): ?>
                    <tr>
                        <td><img src="../uploads/<?= htmlspecialchars($linea['imagen']) ?>" alt="<?= htmlspecialchars($linea['nombre']) ?>" style="width: 100px;"></td>
                        <td><?= htmlspecialchars($linea['nombre']) ?></td>
                        <td>
                            $<?= number_format($linea['precio_oferta'] > 0 ? $linea['precio_oferta'] : $linea['precio'], 0, ',', '.') ?> COP
                        </td>
                        <td><?= $linea['unidades'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay productos registrados para este pedido.</p>
    <?php endif; ?>
</div>

</body>
</html>
