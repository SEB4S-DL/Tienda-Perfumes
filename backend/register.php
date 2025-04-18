<?php
require '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $rol = "user";
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $image = file_get_contents($_FILES['imagen']['tmp_name']);
    $tipo_imagen = $_FILES['imagen']['type'];

    // Creamos el statement
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellidos, email, password, rol, imagen, tipo_imagen) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Definimos variables por referencia
    $stmt->send_long_data(5, $image); // 5 es la posición del campo 'imagen'

    // Necesitamos pasar una variable vacía para bindear, pero que luego reciba los datos
    $imagenDummy = null; // esta es la clave: debe existir y estar como null al inicio

    $stmt->bind_param("sssssss", $nombre, $apellido, $email, $password, $rol, $imagenDummy, $tipo_imagen);

    if ($stmt->execute()) {
        $stmt->close();
        header('Location: /TIENDA-PERFUMES/pages/login.php');
        exit();
    } else {
        echo "Error al registrar: " . $stmt->error;
    }
}
?>
