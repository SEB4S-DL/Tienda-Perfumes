<?php
session_start();
require_once '../db/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_categoria = trim($_POST["nombre_categoria"]);

    if (!empty($nombre_categoria)) {
        $sql = "INSERT INTO categorias (nombre) VALUES (?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $nombre_categoria);
        
        if ($stmt->execute()) {
            $_SESSION['mensaje'] = "success"; 
        } else {
            $_SESSION['mensaje'] = "error"; 
        }
        $stmt->close();

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $_SESSION['mensaje'] = "empty";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}


$sql = "SELECT id, nombre FROM categorias";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/stylecategorias.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <title>Gestión de Categorías</title>
</head>
<body>

<?php

if (isset($_SESSION['mensaje'])) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {";
    
    if ($_SESSION['mensaje'] == "success") {
        echo "Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: 'Categoría agregada correctamente.',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#2979CD',
            heightAuto: false
        }).then(() => {
            window.location.href = '../index.php';
        });;";
    } elseif ($_SESSION['mensaje'] == "error") {
        echo "Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al agregar la categoría.',
            confirmButtonText: 'Intentar de nuevo',
            confirmButtonColor: '#dc3545',
            heightAuto: false

        }).then(() => {
            window.location.href = '../index.php';
        });;";
    } elseif ($_SESSION['mensaje'] == "empty") {
        echo "Swal.fire({
            icon: 'warning',
            title: 'Atención',
            text: 'El nombre de la categoría no puede estar vacío.',
            confirmButtonText: 'OK',
            confirmButtonColor: '#ffc107',
            heightAuto: false
        }).then(() => {
            window.location.href = '../index.php';
        });;";
    }
    
    echo "});
    
    </script>";

    unset($_SESSION['mensaje']); 
}
?>

<form method="POST" class="animate__animated animate__fadeInDown animate__faster">
    <h2>Agregar Nueva Categoría</h2>
    <input type="text" name="nombre_categoria" placeholder="Nombre de la categoría" required>

    <div class="button-container">
        <button type="submit" class="crear">Agregar</button>
        <a href="../pages/categorias.php" class="cancelar">Cancelar</a>
    </div>
</form>


</body>
</html>
