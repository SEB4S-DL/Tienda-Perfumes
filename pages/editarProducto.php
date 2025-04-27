<?php
include '../includes/validarSession.php';


require '../db/db.php';

// Obtener categorías
$categorias = [];
$query = "SELECT id, nombre FROM categorias";
$resultado = mysqli_query($conexion, $query);
while ($row = mysqli_fetch_assoc($resultado)) {
    $categorias[] = $row;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Crear Producto</title>
  <link rel="stylesheet" href="../assets/css/editarProducto.css" />
  <link rel="stylesheet" href="../assets/css/stylePaginaInicio.css" />
  <link rel="stylesheet" href="../assets/css/styleheader.css">
  <link rel="stylesheet" href="../assets/css/stylefooter.css">
</head>
<body>

<?php include '../includes/header.php'; ?>

<main>
  <h2>Crear Producto</h2>

  <form id="form-editar-producto" method="POST" action="../backend/producto.php" enctype="multipart/form-data">
  
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required />

        <label for="descripcion">Descripción</label>
        <input type="text" id="descripcion" name="descripcion" required />
    
        <label for="precio">Precio</label>
        <input type="number" step="0.01" id="precio" name="precio" required />
    
        <label for="stock">Stock</label>
        <input type="number" id="stock" name="stock" required />
  
    <div class="fila full">
      <label for="categoria">Categoría</label>
      <select name="categoria_id" id="categoria" required>
        <option value="">Seleccione una categoría</option>
        <?php foreach ($categorias as $cat): ?>
          <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nombre']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="fila full">
      <label for="imagen">Imagen</label>
      <input type="file" id="imagen" name="imagen" accept="image/*" required />
      
    </div>

    <button type="submit">Guardar</button>
  </form>
</main>

<?php include '../includes/footer.php'?>

</body>
</html>
