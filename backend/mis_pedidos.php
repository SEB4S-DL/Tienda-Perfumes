<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
require '../includes/conexion.php'; // ajusta según cómo te conectás a la BD


$usuario_id = $_SESSION['usuario_id'] ?? null;
if (!$usuario_id) {
    exit('<tr><td colspan="4">Debes iniciar sesión para ver tus pedidos.</td></tr>');
}

// Obtener pedidos del usuario
$sql = "SELECT id, precio, fecha, estado FROM pedidos WHERE usuario_id = $usuario_id ORDER BY fecha DESC";
$pedidos = mysqli_query($conn, $sql);

if (mysqli_num_rows($pedidos) === 0) {
    echo "<tr><td colspan='4'>No hay pedidos aún.</td></tr>";
} else {
    while ($p = mysqli_fetch_assoc($pedidos)) {
        echo "<tr>";
        echo "<td>{$p['id']}</td>";
        echo "<td>$" . number_format($p['precio'], 0, ',', '.') . "</td>";
        echo "<td>{$p['fecha']}</td>";
        echo "<td>{$p['estado']}</td>";
        echo "</tr>";
    }
}
