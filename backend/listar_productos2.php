<?php
// Conectar a la base de datos
require_once './db/db.php';

// Verificar si la categoría está definida
if (!isset($_GET['categoria'])) {
    die('Categoría no especificada 😵');
}

$categoria_id = intval($_GET['categoria']); // Asegúrate de que sea un número entero

// Realizar la consulta para obtener los productos de la categoría
$query = "SELECT id, nombre, descripcion, precio, precio_oferta, imagen 
          FROM productos 
          WHERE categoria_id = ? AND activo = 1"; 

// Preparar la consulta
$stmt = $conexion->prepare($query);

if ($stmt === false) {
    die('Error en la preparación de la consulta: ' . $conexion->error);
}

// Vincula el parámetro
$stmt->bind_param('i', $categoria_id);

// Ejecuta la consulta
$stmt->execute();

// Obtener el resultado
$productos = $stmt->get_result();

// Verificar si se encontraron productos
if ($productos->num_rows === 0) {
    echo "<h3>No se encontraron productos en esta categoría.</h3>";
}

// Cerrar la consulta
$stmt->close();
?>
