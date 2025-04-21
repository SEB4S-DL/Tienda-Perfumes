<?php
require '../db/db.php';

// Asegurarse de que se pase la categoría
if (!isset($categoria_id)) {
    die("Falta el ID de categoría");
}

// Sanitizar el valor por seguridad
$categoria_id = (int) $categoria_id;

// Seleccionar solo los productos activos de la categoría
$query = "SELECT id, nombre, descripcion, precio, precio_oferta, imagen 
          FROM productos 
          WHERE categoria_id = $categoria_id AND activo = 1"; // Filtrar solo los activos

$productos = mysqli_query($conexion, $query);

// Verificar errores de la consulta
if (!$productos) {
    die("Error al cargar productos: " . mysqli_error($conexion));
}


