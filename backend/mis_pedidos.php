<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require '../db/db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
    echo json_encode([]); // No datos si no hay sesión
    exit();
}

$usuario_id = $_SESSION['usuario']['id'];

$sql = "SELECT * FROM pedidos WHERE usuario_id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

$pedidos = [];

while ($pedido = $resultado->fetch_assoc()) {
    $pedidos[] = $pedido;
}

echo json_encode($pedidos);
?>
