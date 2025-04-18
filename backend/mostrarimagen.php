<?php
require '../db/db.php';
session_start();

if (!isset($_SESSION['email'])) {
    http_response_code(403);
    exit('No autorizado');
}

$email = $_SESSION['email'];
$sql = "SELECT imagen, tipo_imagen FROM usuarios WHERE email = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($imagen, $tipo_imagen);
    $stmt->fetch();

    if ($imagen) {
        header("Content-Type: $tipo_imagen");
        echo $imagen;
    } else {
        // Imagen vacía, mostrar predeterminada
        header("Content-Type: image/jpeg");
        readfile("../assets/img/imagenperfil.jpg");
    }
} else {
    http_response_code(404);
    echo "Imagen no encontrada.";
}
?>
