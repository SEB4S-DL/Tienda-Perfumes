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
<?php session_start()?>
<?php include '../includes/header.php'; ?>
<?php require '../backend/podructo.php'?>

  <main>
    <h2>Crear Producto</h2>
    <form id="form-editar-producto">
      <div class="fila">
        <div>
          <label for="nombre">Nombre</label>
          <input type="text" id="nombre" name="nombre" />
        </div>
        <div>
          <label for="descripcion">Descripción</label>
          <input type="text" id="descripcion" name="descripcion" />
        </div>
      </div>

      <div class="fila">
        <div>
          <label for="precio">Precio</label>
          <input type="number" id="precio" name="precio" />
        </div>
        <div>
          <label for="stock">Stock</label>
          <input type="number" id="stock" name="stock" />
        </div>
      </div>

      <div class="fila full">
        <label for="categoria">Categoría</label>
        <input type="text" id="categoria" name="categoria" />
      </div>

      <div class="fila full">
        <label for="imagen">Imagen</label>
        <input type="file" id="imagen" name="imagen" />
        <span id="nombre-imagen">No hay imagen cargada</span>
      </div>

      <button type="submit">Guardar</button>
    </form>
  </main>

</body>
</html>
