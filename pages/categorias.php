<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <link rel="stylesheet" href="css/categorias.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <div class="categories-header">
        <h2>Categorías</h2>
    </div>
    
    <main class="main-content">
        <div class="add-category">
            <button class="add-btn">Agregar Categoría</button>
        </div>
        
        <div class="categories-table-container">
            <table class="categories-table">
                <thead>
                    <tr>
                        <th>N° Id</th>
                        <th>Nombres</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>600.000</td>
                        <td>
                            <button class="action-btn edit-btn">Editar</button>
                        </td>
                        <td>
                            <button class="action-btn delete-btn">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>250.000</td>
                        <td>
                            <button class="action-btn edit-btn">Editar</button>
                        </td>
                        <td>
                            <button class="action-btn delete-btn">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Modal for adding/editing categories -->
    <div id="categoryModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h3 id="modalTitle">Agregar Categoría</h3>
            <form id="categoryForm">
                <div class="form-group">
                    <label for="categoryName">Nombre de la categoría:</label>
                    <input type="text" id="categoryName" required>
                </div>
                <button type="submit" class="submit-btn">Guardar</button>
            </form>
        </div>
    </div>

    <script src="js/categorias.js"></script>
</body>
</html>