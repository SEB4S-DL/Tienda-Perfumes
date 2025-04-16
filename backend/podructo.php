<?php
session_start();
require '../db/db.php';

// Crear producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria_id'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_FILES['imagen']['name'];

    move_uploaded_file($_FILES['imagen']['tmp_name'], "img/$imagen");

    $sql = "INSERT INTO productos (categoria_id, nombre, descripcion, precio,  descripcion, stock ,oferta , fecha, imagen) 
            VALUES ('$nombre', '$precio', '$categoria', '$descripcion', '$imagen')";
    mysqli_query($conn, $sql);
}

// Eliminar producto
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    mysqli_query($conn, "DELETE FROM productos WHERE id = $id");
}

$productos = mysqli_query($conn, "SELECT * FROM productos");
$categorias = mysqli_query($conn, "SELECT * FROM categorias");
?>

<!-- Formulario Crear -->
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="number" name="precio" placeholder="Precio" required>
    <select name="categoria_id">
        <?php while ($cat = mysqli_fetch_assoc($categorias)): ?>
            <option value="<?= $cat['id'] ?>"><?= $cat['nombre'] ?></option>
        <?php endwhile; ?>
    </select>
    <textarea name="descripcion" placeholder="Descripción"></textarea>
    <input type="file" name="imagen">
    <input type="submit" name="crear" value="Agregar Producto">
</form>

<!-- Lista -->
<ul>
    <?php while ($p = mysqli_fetch_assoc($productos)): ?>
        <li>
            <?= $p['nombre'] ?> - $<?= $p['precio'] ?>
            <a href="?eliminar=<?= $p['id'] ?>">Eliminar</a>
        </li>
    <?php endwhile; ?>
</ul>
