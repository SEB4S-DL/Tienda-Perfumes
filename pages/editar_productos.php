<?php
// Incluir la conexión a la base de datos
include '../db/db.php';  
include '../includes/validarSession.php';

// Obtener el ID del producto desde la URL
$id = $_GET['id'] ?? null;

// Mensajes para mostrar al usuario
$mensaje = '';
$tipo_mensaje = '';

// Obtener datos del producto
$sql = "SELECT * FROM productos WHERE id = $id";
$result = mysqli_query($conexion, $sql);

if ($result) {
    $producto = mysqli_fetch_assoc($result);
} else {
    echo "Error al obtener el producto: " . mysqli_error($conexion);
    exit();
}

// Obtener categorías
$categorias = [];
$query_categorias = "SELECT * FROM categorias";
$resultado_categorias = mysqli_query($conexion, $query_categorias);
while ($row = mysqli_fetch_assoc($resultado_categorias)) {
    $categorias[] = $row;
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $precio_oferta = mysqli_real_escape_string($conexion, $_POST['precio_oferta']);
    $stock = mysqli_real_escape_string($conexion, $_POST['stock']);
    $categoria_id = mysqli_real_escape_string($conexion, $_POST['categoria_id']);
    $imagen = $_FILES['imagen']['name'];

    // Procesar imagen
    if ($imagen) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($imagen);
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file);
    } else {
        $imagen = $producto['imagen'];
    }

    // Actualizar producto
    $sql_update = "UPDATE productos SET 
                   nombre = '$nombre',
                   descripcion = '$descripcion',
                   precio = '$precio',
                   precio_oferta = '$precio_oferta',
                   stock = '$stock',
                   categoria_id = '$categoria_id',
                   imagen = '$imagen'
                   WHERE id = $id";

    if (mysqli_query($conexion, $sql_update)) {
        $mensaje = "Producto actualizado correctamente.";
        $tipo_mensaje = 'exito';
    } else {
        $mensaje = "Error al actualizar el producto: " . mysqli_error($conexion);
        $tipo_mensaje = 'error';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../assets/css/styleheader.css">
    <link rel="stylesheet" href="../assets/css/stylePaginaInicio.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            display: grid;
            gap: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        input[type="file"] {
            background-color: #ccc6c0;
            border: none;
            border-radius: 10px;
            padding: 0.5rem;
            font-size: 1rem;
            color: #4b3d2d;
        }

        button[type="submit"] {
            padding: 12px 20px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #4cae4c;
        }

        .alerta {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .exito {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
<?php include '../includes/header.php'; ?>

<div class="container">
    <h2>Editar Producto</h2>

    <?php if ($mensaje): ?>
        <div class="alerta <?= $tipo_mensaje ?>">
            <?= $mensaje ?>
        </div>
        <?php if ($tipo_mensaje === 'exito'): ?>
            <script>
                setTimeout(function () {
                    window.location.href = '../index.php'; // Ajustá esta ruta si es otra
                }, 1000);
            </script>
        <?php endif; ?>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>">

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"><?= htmlspecialchars($producto['descripcion']) ?></textarea>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" value="<?= $producto['precio'] ?>">

        <label for="precio_oferta">Precio Oferta:</label>
        <input type="number" name="precio_oferta" value="<?= $producto['precio_oferta'] ?>">

        <label for="stock">Stock:</label>
        <input type="number" name="stock" value="<?= $producto['stock'] ?>">

        <label for="categoria_id">Categoría:</label>
        <select name="categoria_id">
            <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= $producto['categoria_id'] == $cat['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen">

        <button type="submit">Actualizar Producto</button>
    </form>
</div>
</body>
</html>
