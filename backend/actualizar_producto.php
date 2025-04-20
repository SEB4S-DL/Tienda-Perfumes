<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
  header("Location: ../index.php");
  exit;
}

require '../db/db.php';

// Validar y limpiar datos
$id = intval($_POST['id']);
$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$precio = floatval($_POST['precio']);
$oferta = isset($_POST['oferta']) ? 1 : 0;
$categoria_id = intval($_POST['categoria_id']);

$query = "";

// Si se subió una nueva imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
    $imagen = $_FILES['imagen']['name'];
    $ruta_temporal = $_FILES['imagen']['tmp_name'];
    $ruta_destino = "../assets/img/" . basename($imagen);

    // Mover imagen al destino
    move_uploaded_file($ruta_temporal, $ruta_destino);

    $query = "UPDATE productos SET 
                nombre = '$nombre', 
                precio = $precio, 
                oferta = $oferta, 
                categoria_id = $categoria_id, 
                imagen = '$imagen'
              WHERE id = $id";
} else {
    // Sin actualizar imagen
    $query = "UPDATE productos SET 
                nombre = '$nombre', 
                precio = $precio, 
                oferta = $oferta, 
                categoria_id = $categoria_id
              WHERE id = $id";
}

// Ejecutar actualización
mysqli_query($conexion, $query);

// Redirigir según categoría
switch ($categoria_id) {
  case 1:
    header("Location: ../pages/sesionperfumeunisex.php");
    break;
  case 2:
    header("Location: ../pages/sesionperfumehombre.php");
    break;
  case 3:
    header("Location: ../pages/sesionperfumemujer.php");
    break;
  default:
    header("Location: ../index.php");
}
exit;
