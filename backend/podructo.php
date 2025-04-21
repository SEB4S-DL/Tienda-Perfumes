<?php
require '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $precio = (float) $_POST['precio'];
    $stock = (int) $_POST['stock'];
    $fecha = date('Y-m-d');
    $categoria_id = (int) $_POST['categoria_id'];

    // Inicializar nombreImagen por si no hay imagen
    $nombreImagen = null;

    // Manejo de imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreOriginal = basename($_FILES['imagen']['name']);
        $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));

        // Validar extensión permitida
        $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];
        if (!in_array($extension, $extensionesPermitidas)) {
            die("Formato de imagen no permitido.");
        }

        // Validar tamaño máximo (2MB)
        if ($_FILES['imagen']['size'] > 2 * 1024 * 1024) {
            die("La imagen excede el tamaño máximo de 2MB.");
        }

        // Generar nombre único para evitar conflictos
        $nombreImagen = uniqid('img_', true) . '.' . $extension;
        $rutaDestino = '../uploads/' . $nombreImagen;

        // Mover imagen a la carpeta 'uploads'
        if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
            die("Error al subir la imagen.");
        }
    }

    // Insertar en la base de datos (solo nombre de la imagen, no ruta completa)
    $query = "INSERT INTO productos (nombre, descripcion, precio, stock, categoria_id, fecha, imagen) 
              VALUES ('$nombre', '$descripcion', $precio, $stock, $categoria_id, '$fecha', " . ($nombreImagen ? "'$nombreImagen'" : "NULL") . ")";

    if (mysqli_query($conexion, $query)) {
        header("Location: ../index.php?mensaje=creado");
        exit;
    } else {
        echo "Error al guardar el producto: " . mysqli_error($conexion);
    }
} else {
    echo "Acceso no permitido.";
}
