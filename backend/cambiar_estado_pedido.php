<?php
session_start();
require '../db/db.php';

if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    echo "Acceso denegado.";
    exit;
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conexion, $_GET['id']);
    $nuevo_estado = 'procesado'; // Ejemplo de cambio de estado

    $sql = "UPDATE pedidos SET estado = '$nuevo_estado' WHERE id = $id";
    if (mysqli_query($conexion, $sql)) {
        header("Location: ../pages/detallePedido.php?id=$id");
        exit();
    } else {
        echo "Error al actualizar el estado: " . mysqli_error($conexion);
    }
} else {
    echo "Acceso inválido.";
}
?>
