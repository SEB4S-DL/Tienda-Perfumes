<?php
require '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $rol = "user";
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $image = file_get_contents($_FILES['imagen']['tmp_name']);

    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellidos, email, password, rol, imagen) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssb", $nombre, $apellido, $email, $password, $rol, $null);

    // Enviar imagen como long data
    $stmt->send_long_data(5, $image);
    $stmt->execute();
    $stmt->close();

    header('Location: ../Tienda-Perfumes/login.php');
}
?>