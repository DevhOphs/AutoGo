<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - AutoGo</title>
    <link rel="stylesheet" href="../public/estilos.css">
</head>
<body>
    <div class="container-auth">
        <header>
            <h1>AutoGo</h1>
        </header>
        <main>
            <h2>Iniciar Sesión</h2>
            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" placeholder="tu@correo.com">
            
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="Tu contraseña">
            
            <button class="button" onclick="validateLogin()">Iniciar sesión</button>
            <p>O</p>
            <p><a href="register.php">¿No tienes cuenta? Registrarse</a></p>
        </main>
    </div>
    <script src="../public/script.js"></script>
</body>
</html>