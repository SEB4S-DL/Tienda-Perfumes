<?php
require '../db/db.php';

// Filtrar productos por categoría
$categoria_id = isset($_GET['categoria']) ? (int) $_GET['categoria'] : 0; // Si no hay categoría, muestra todos los productos
if ($categoria_id > 0) {
    // Filtra por la categoría seleccionada
    $productos = mysqli_query($conexion, "SELECT * FROM productos WHERE categoria_id = $categoria_id");
} else {
    // Si no hay filtro, muestra todos los productos
    $productos = mysqli_query($conexion, "SELECT * FROM productos");
}

// Obtener las categorías para mostrarlas en el header o menú
$categorias = mysqli_query($conexion, "SELECT * FROM categorias");
?>
