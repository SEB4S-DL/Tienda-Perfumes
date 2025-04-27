<?php
include '../includes/validarSession.php';
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <title>Gestión de Categorías</title>
</head>
<style>
    body {
        background-color: #f8f4f0; /* Blanco con un toque cálido */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    form {
        background-color: #4e342e; /* Café oscuro */
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    form h2 {
        color: #ffffff;
        margin-bottom: 1.5rem;
        font-size: 1.8rem;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px 15px;
        margin-bottom: 1.5rem;
        border: none;
        border-radius: 8px;
        background-color: #ffffff;
        font-size: 1rem;
        box-sizing: border-box;
    }

    input[type="text"]::placeholder {
        color: #a1887f; /* Café claro */
    }

    .button-container {
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }

    button.crear, a.cancelar {
        flex: 1;
        text-decoration: none;
        padding: 10px;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
    }

    button.crear {
        background-color: #6d4c41; /* Otro café */
        color: white;
    }

    button.crear:hover {
        background-color: #5d4037;
        transform: scale(1.05);
    }

    a.cancelar {
        background-color: #d7ccc8; /* Café muy clarito */
        color: #4e342e;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    a.cancelar:hover {
        background-color: #bcaaa4;
        transform: scale(1.05);
    }
</style>

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
