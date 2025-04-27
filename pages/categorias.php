
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <link rel="stylesheet" href="../assets/css/categorias.css">
    <link rel="stylesheet" href="../assets/css/stylePaginaInicio.css">
    <link rel="stylesheet" href="../assets/css/styleheader.css">
    <link rel="stylesheet" href="../assets/css/stylefooter.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>
    <style>
    li {list-style-type: none;}
    </style>

    
    <?php 
    include '../includes/header.php';
    

    ?>
    <div class="categories-header">
        <h2>Categorías</h2>
        <?php require '../backend/mostrarCategorias.php'; ?>
    </div>
    
    <main class="main-content">
        <div class="add-category" >
            <button style="border-radius: 20px; background-color: #3A2E2B; padding: 5px; "><a href="../pages/categories.php" style="color: white; text-decoration: none">Crear Categoria</a></button>
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
            <?php while ($cat = mysqli_fetch_assoc($categorias)): ?>
                <tr>
                    <td><?= $cat['id'] ?></td>
                    <td><?= $cat['nombre'] ?></td>
                    <td colspan="2"></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</main>
<?php include '../includes/footer.php'; ?>
    

    

</body>
</html>