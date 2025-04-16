<?php
session_start();
require '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    mysqli_query($conn, "INSERT INTO categorias (nombre) VALUES ('$nombre')");
}

$categorias = mysqli_query($conexion, "SELECT * FROM categorias");
?>
