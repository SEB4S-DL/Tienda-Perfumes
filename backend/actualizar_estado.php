<?php
session_start();
require '../db/db.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pedido_id'], $_POST['estado'])) {
    $pedido_id = (int) $_POST['pedido_id'];
    $estado = mysqli_real_escape_string($conexion, $_POST['estado']);

    $sql = "UPDATE pedidos SET estado = '$estado' WHERE id = $pedido_id";
    if (mysqli_query($conexion, $sql)) {
        header("Location: ../pages/detallePedido.php?id=$pedido_id");
        exit;
    } else {
        echo "Error al actualizar el estado: " . mysqli_error($conexion);
    }
} else {
    echo "Datos inválidos.";
}
