<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conexion, $sql);
    $usuario = mysqli_fetch_assoc($resultado);

    if ($usuario && password_verify($password, $usuario['password'])) {
        $_SESSION['rol'] = $usuario['rol'];
        $_SESSION['nombre'] = $usuario['nombre']; // guarda nombre
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['imagen'] = $usuario['imagen']; // guarda ruta/nombre de imagen
        header('Location: /TIENDA-PERFUMES/index.php');
        exit();
    } else {
        echo "Correo o contraseña incorrectos.";
    }
}
?>
