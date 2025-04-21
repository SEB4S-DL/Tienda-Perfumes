<?php
session_start();
header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode([]);
    exit;
}

require '../db/db.php';

$pedidoId = intval($_GET['id']);

// Verificación de conexión (opcional si ya hiciste conexión correctamente)
if ($conexion->connect_error) {
    echo json_encode([]);
    exit;
}

// SQL corregido
$sql = "SELECT p.nombre, p.imagen, dp.unidades, p.precio, p.precio_oferta
        FROM lineas_pedidos dp
        JOIN productos p ON dp.producto_id = p.id
        WHERE dp.pedido_id = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $pedidoId);
$stmt->execute();
$result = $stmt->get_result();

$detalles = [];
while ($row = $result->fetch_assoc()) {
    $detalles[] = $row;
}

echo json_encode($detalles);
