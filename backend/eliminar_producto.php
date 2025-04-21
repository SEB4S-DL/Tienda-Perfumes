<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_SESSION['usuario']['rol']) &&
    $_SESSION['usuario']['rol'] === 'admin') {
    
    require '../db/db.php'; // Conexión a la base de datos

    $producto_id = intval($_POST['producto_id']);

    // En lugar de eliminar, actualizamos el estado "activo"
    $query = "UPDATE productos SET activo = 0 WHERE id = $producto_id";

    if (mysqli_query($conexion, $query)) {
        header("Location: ../index.php"); // Ajusta ruta si es necesario
        exit;
    } else {
        echo "Error al desactivar el producto: " . mysqli_error($conexion);
    }

} else {
    echo "Acceso denegado.";
}
