<?php
session_start();
header('Content-Type: application/json');

require '../db/db.php';

// Verifico sesión
if (!isset($_SESSION['usuario']['id'])) {
    echo json_encode([]);
    exit();
}

$usuario_id = (int) $_SESSION['usuario']['id'];

// Ahora hago un LEFT JOIN con lineas_pedidos y agrupo por pedido
$sql = "
  SELECT
    p.id,
    p.coste,
    p.fecha,
    p.estado,
    COALESCE(SUM(lp.unidades), 0) AS cantidad
  FROM pedidos p
  LEFT JOIN lineas_pedidos lp
    ON lp.pedido_id = p.id
  WHERE p.usuario_id = $usuario_id
  GROUP BY p.id
  ORDER BY p.fecha DESC
";

$resultado = mysqli_query($conexion, $sql);

$pedidos = [];

if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        // Aseguro que cantidad sea entero
        $fila['cantidad'] = (int) $fila['cantidad'];
        $pedidos[] = $fila;
    }
}

echo json_encode($pedidos);
