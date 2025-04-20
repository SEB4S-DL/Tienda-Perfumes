<?php
require '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $precio = (float) $_POST['precio'];
    $stock = (int) $_POST['stock']; 
    $fecha = date('Y-m-d'); // <-- FECHA ACTUAL
    $categoria_id = (int) $_POST['categoria_id'];
   

    // Manejo de imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreImagen = basename($_FILES['imagen']['name']);
        $rutaDestino = '../uploads/' . $nombreImagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino);
    } else {
        $rutaDestino = null;
    }

    // Insertar en la base de datos (incluye fecha)
    $query = "INSERT INTO productos (nombre, descripcion, precio, stock, categoria_id,fecha, imagen) 
              VALUES ('$nombre', '$descripcion', $precio, $stock, $categoria_id, '$fecha', '$rutaDestino')";

    if (mysqli_query($conexion, $query)) {
        header("Location: ../index.php?mensaje=creado");
        exit;
    } else {
        echo "Error al guardar el producto: " . mysqli_error($conexion);
    }
} else {
    echo "Acceso no permitido.";
}