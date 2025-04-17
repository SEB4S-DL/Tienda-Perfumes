<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos Realizados</title>
    <link rel="stylesheet" href="css/pedidosRealizados.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>

<?php include '../includes/header.php'; ?>

    
    <div class="cart-header">
        <h2>PEDIDOS REALIZADOS</h2>
    </div>
    
    <main class="main-content">
        <div class="cart-container">
            <table class="cart-table">
                <thead>
                  <tr>
                    <th>Imagen</th>
                    <th>N.id</th>
                    <th>Precio</th>
                    <th>Fecha</th>
                    <th>Cantidad</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><img src="img/pexels-valeriya-1961795.jpg" alt="Perfume 1" class="product-img"></td>
                    <td>1</td>
                    <td>344.000 COP</td>
                    <td>xx-xx-xxxx</td>
                    <td>1</td>
                  </tr>
                  <tr>
                    <td><img src="img/pexels-valeriya-1961789.jpg" alt="Perfume 2" class="product-img"></td>
                    <td>1</td>
                    <td>344.000 COP</td>
                    <td>xx-xx-xxxx</td>
                    <td>1</td>
                  </tr>
                </tbody>
            </table>
        </div>
    </main>

    <script src="js/pedidosRealizados.js"></script>
</body>
</html>