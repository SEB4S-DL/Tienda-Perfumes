<?php
require '../db/db.php';

if (!isset($categoria_id)) {
    die("Falta el ID de categoría");
}

$productos = mysqli_query($conexion, "SELECT * FROM productos WHERE categoria_id = $categoria_id");

if (!$productos) {
    die("Error al cargar productos: " . mysqli_error($conexion));
}
