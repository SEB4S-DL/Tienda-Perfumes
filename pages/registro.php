<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="../assets/css/registro.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="form-image">
                <img src="../assets/img/Dior-Sauvage-Parfum-Vaporisateur-Spray-3-4-oz_37c18456-0a4f-4780-81b8-6334d46cf653.2483d861099b2e96f6ded1a0fe06e94c.jpg" alt="Dior Sauvage perfume" class="perfume-image">
            </div>
            <div class="form-content">
                <div class="watermark"></div>
                <h2 class="form-title">REGISTRARSE</h2>
                <form id="registerForm" method="post" action="../backend/register.php" enctype="multipart/form-data">
                    <div class="input-group">
                        <span class="material-symbols-outlined">person</span>
                        <input type="text" name="nombre" placeholder="Nombre" required>
                    </div>
                    <div class="input-group">
                        <span class="material-symbols-outlined">person</span>
                        <input type="text" name="apellido" placeholder="Apellido" required>
                    </div>
                    <div class="input-group">
                        <span class="material-symbols-outlined">mail</span>
                        <input type="email" name="email"  placeholder="Email" required>
                    </div>
                    
                    <div class="input-group">
                        <span class="material-symbols-outlined">lock</span>
                        <input type="password" name="password" placeholder="Contraseña" required>
                    </div>
                    <div class="input-group">
                        <label>Añadir Imagen</label>
                        <input type="file" name="imagen">
                    </div>
                    <button type="submit" class="submit-btn">REGISTRARME</button>
                </form>
            </div>
        </div>
    </div>

    <script src="js/registro.js"></script>
</body>
</html>