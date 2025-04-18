<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestionar Productos - Nuit de Parfum</title>
  <link rel="stylesheet" href="../assets/css/gestionarProducto.css" />
  <link rel="stylesheet" href="../assets/css/styleheader.css" />
  <link rel="stylesheet" href="../assets/css/stylePaginaInicio.css" />

  
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
<?php session_start()?>

<?php include '../includes/header.php'; ?>


  <table>
    <thead>
      <tr>
        <th>N°</th>
        <th>id</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>2</td>
        <td>2</td>
        <td>Dolce & Gabbana<br>The One</td>
        <td>344,000 COP</td>
        <td>2</td>
        <td>
            
          <button class="btn eliminar">EDITAR</button>
          <button class="btn eliminar">ELIMINAR</button>
        </td>
      </tr>
    </tbody>
  </table>


</body>
</html>
