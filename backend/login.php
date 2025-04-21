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
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'rol' => $usuario['rol'],
            'nombre' => $usuario['nombre'],
            'email' => $usuario['email'],
            'imagen' => $usuario['imagen'],
        ];
        
        header('Location: /TIENDA-PERFUMES/index.php');
        exit();
    } else {
        echo "Correo o contraseña incorrectos.";
    }
}
?>
