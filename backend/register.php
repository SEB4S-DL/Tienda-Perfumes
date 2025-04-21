<?php
require '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $rol = "admin";
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $imagenNombre = null;

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = uniqid() . "_" . basename($_FILES['imagen']['name']);
        $rutaDestino = '../uploads/' . $nombreArchivo;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
            $imagenNombre = $nombreArchivo;
        }
    }

    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellidos, email, password, rol, imagen) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nombre, $apellido, $email, $password, $rol, $imagenNombre);

    if ($stmt->execute()) {
        $stmt->close();
        header('Location: /TIENDA-PERFUMES/pages/login.php');
        exit();
    } else {
        echo "Error al registrar: " . $stmt->error;
    }
}
?>
