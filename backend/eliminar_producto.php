<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
    require '../db/db.php'; // o el archivo donde conectas con la BD

    $producto_id = intval($_POST['producto_id']);
    $query = "DELETE FROM productos WHERE id = $producto_id";
    mysqli_query($conexion, $query);

    header("Location: ../pages/index.php"); // o donde sea que se vuelve después de borrar
    exit;
} else {
    echo "Acceso denegado.";
}
