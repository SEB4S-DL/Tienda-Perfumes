<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="form-image">
                <img src="img/pexels-didsss-1190829.jpg" alt="Perfume bottle" class="perfume-image">
            </div>
            <div class="form-content">
                <h2 class="form-title">INICIAR SESIÓN</h2>
                <form id="loginForm">
                    <div class="input-group">
                        <span class="material-symbols-outlined">mail</span>
                        <input type="email" placeholder="Email" required>
                    </div>
                    <div class="input-group">
                        <span class="material-symbols-outlined">lock</span>
                        <input type="password" placeholder="Contraseña" required>
                    </div>
                    <button type="submit" class="submit-btn">INGRESAR</button>
                </form>
            </div>
        </div>
    </div>

    <script src="js/login.js"></script>
</body>
</html>