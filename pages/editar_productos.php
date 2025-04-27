<?php
// Incluir la conexión a la base de datos
include '../db/db.php';  // Asegúrate de que la ruta de tu archivo de conexión sea correcta
include '../includes/validarSession.php';

// Obtener el ID del producto desde la URL
$id = $_GET['id'];  // O usar otra forma de obtener el ID del producto

// Obtener los datos del producto desde la base de datos
$sql = "SELECT * FROM productos WHERE id = $id";
$result = mysqli_query($conexion, $sql);

if ($result) {
    $producto = mysqli_fetch_assoc($result);
} else {
    echo "Error al obtener el producto: " . mysqli_error($conexion);
    exit();
}

// Obtener las categorías desde la base de datos
$categorias = [];
$query_categorias = "SELECT * FROM categorias";
$resultado_categorias = mysqli_query($conexion, $query_categorias);
while ($row = mysqli_fetch_assoc($resultado_categorias)) {
    $categorias[] = $row;
}

// Si el formulario se envía para actualizar el producto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $precio_oferta = mysqli_real_escape_string($conexion, $_POST['precio_oferta']);
    $stock = mysqli_real_escape_string($conexion, $_POST['stock']);
    $categoria_id = mysqli_real_escape_string($conexion, $_POST['categoria_id']);
    $imagen = $_FILES['imagen']['name'];  // O usar alguna forma para manejar la imagen

    // Si se ha subido una nueva imagen, movemos el archivo
    if ($imagen) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file);
    } else {
        // Si no se sube una imagen nueva, mantén la anterior
        $imagen = $producto['imagen'];
    }

    // Actualizar el producto en la base de datos
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
        // Redirigir a la lista de productos o mostrar un mensaje de éxito
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error al actualizar el producto: " . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>

    <!-- Estilos internos -->
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 50px;
        }

        /* Títulos */
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        /* Formulario */
        form {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        /* Etiquetas */
        label {
            font-weight: bold;
            color: #555;
        }

        /* Campos de entrada */
        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        /* Área de texto (textarea) */
        textarea {
            resize: vertical;
            height: 100px;
        }

        /* Botón */
        button[type="submit"] {
            padding: 12px 20px;
            background-color: #5cb85c;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        /* Botón en hover */
        button[type="submit"]:hover {
            background-color: #4cae4c;
        }

        /* Estilos de la imagen de carga */
        input[type="file"] {
            padding: 5px;
        }

        /* Opciones seleccionadas */
        select {
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Editar Producto</h2>
    <!-- Formulario para editar el producto -->
    <form method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?= $producto['nombre'] ?>" required />

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"><?= $producto['descripcion'] ?></textarea>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" value="<?= $producto['precio'] ?>" required />

        <label for="precio_oferta">Precio Oferta:</label>
        <input type="number" name="precio_oferta" value="<?= $producto['precio_oferta'] ?>" />

        <label for="stock">Stock:</label>
        <input type="number" name="stock" value="<?= $producto['stock'] ?>" required />

        <label for="categoria_id">Categoría:</label>
        <select name="categoria_id">
            <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= $producto['categoria_id'] == $cat['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['nombre']) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen" />

        <button type="submit">Actualizar Producto</button>
    </form>
</div>

</body>
</html>
