<?php
require '../db/db.php'; // Asegúrate de tener aquí tu conexión a la BD

if (!isset($categoria_id)) {
    die('No se ha recibido una categoría válida 😤');
}

// Prevenir SQL Injection
$categoria_id = intval($categoria_id);

// Obtener nombre y banner de la categoría
$sql_categoria = "SELECT nombre, banner FROM categorias WHERE id = ?";
$stmt_cat = $conn->prepare($sql_categoria);
$stmt_cat->bind_param("i", $categoria_id);
$stmt_cat->execute();
$result_cat = $stmt_cat->get_result();

if ($result_cat->num_rows === 0) {
    die('Categoría no encontrada 🚫');
}

$categoria = $result_cat->fetch_assoc();
$titulo_categoria = htmlspecialchars($categoria['nombre']);
$banner_img = '../uploads/' . htmlspecialchars($categoria['banner']);

// Obtener productos de la categoría
$sql_productos = "SELECT id, nombre, descripcion, precio, precio_oferta, imagen 
                  FROM productos 
                  WHERE categoria_id = ? AND activo = 1";
$stmt_prod = $conn->prepare($sql_productos);
$stmt_prod->bind_param("i", $categoria_id);
$stmt_prod->execute();
$productos = $stmt_prod->get_result();
?>
