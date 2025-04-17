<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del pedido</title>
    <link rel="stylesheet" href="css/detallePedido.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>

<?php include '../includes/header.php'; ?>
    
    
    <div class="order-header">
        <h2>Detalle del pedido</h2>
    </div>
    
    <main class="main-content">
        <div class="order-container">
            <div class="order-columns">
          
              <!-- Columna izquierda: Estado + Dirección -->
              <div class="left-column">
                <div class="order-status-section">
                    <label for="status" class="status-label">Cambiar estado del pedido</label>
                    <select id="status" class="status-select">
                      <option>Pendiente</option>
                      <option>En proceso</option>
                      <option>Enviado</option>
                      <option>Entregado</option>
                    </select>
                    <button class="status-btn">Cambiar estado</button>
                  </div>
          
                <div class="delivery-info-section">
                  <h3>Dirección de envío:</h3>
                  <p>Dirección: (Dirección ingresada)</p>
                  <p>Ciudad: (Ciudad ingresada)</p>
                  <p>Departamento: (Ciudad ingresada)</p>
                  <p>Teléfono: (Teléfono ingresado)</p>
          
                  <h3>Datos del pedido:</h3>
                  <p>Número de pedido: 2</p>
                  <p>Total a pagar: $700.000</p>
                  <p>Productos:</p>
                </div>
              </div>
          
              <!-- Columna derecha: Tabla -->
              <div class="right-column">
                <div class="order-details-section">
                  <table>
                    <thead>
                      <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><img src="img/pexels-valeriya-1961795.jpg" alt="Producto 1" width="60" /></td>
                        <td>Luis XV 1722</td>
                        <td>$545.300</td>
                        <td>Stock: 2</td>
                      </tr>
                      <tr>
                        <td><img src="img/pexels-valeriya-1961789.jpg" alt="Producto 2" width="60" /></td>
                        <td>Hierba pura</td>
                        <td>$706.700</td>
                        <td>Stock: 2</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
          
            </div>
          </div>
    </main>
    
    <?php include '../includes/footer.php'; ?>

    <script src="js/detallePedido.js"></script>
</body>
</html>