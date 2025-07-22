<?php
session_start();
include 'conexion.php';

if (isset($_SESSION["usuario"])) {
    if ($_SESSION["tipo"] === "admin") {
        header("Location: Admin/homeAdmin.php");
    } else {
        header("Location: Usuario/home.php");
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conexion->real_escape_string($_POST['email']); //evita inyeccion sql
    $password = $_POST['password'];

    // Busca el usuario en la base de datos
    $stmt = $conexion->prepare("SELECT id, password, tipo FROM usuarios WHERE email = ?"); //? es el valor que espera
    $stmt->bind_param("s", $email);//enlase de mail con ?
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        
        if ($password == $usuario['password']) {
            $_SESSION["usuario"] = $email; // Guardamos el email como identificador
            $_SESSION["tipo"] = $usuario['tipo'];
            $_SESSION["usuario_id"] = $usuario['id'];
            
            if ($usuario['tipo'] === "admin") {
                header('Location: Admin/homeAdmin.php');
            } else {
                header('Location: Usuario/home.php');
            }
            exit;
        }
    }
    
    $error = 'Usuario o contraseña incorrecto';
    echo "<script>alert('$error');</script>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - AutoGo</title>
    <link rel="stylesheet" href="../public/estilos.css">
</head>
<body>
    <div class="container-auth">
        <h1>AutoGo</h1>
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="login.php">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" required>
            
            <label for="password">Contraseña</label>
            <input type="password" name="password" required>
            
            <button type="submit" class="button">Ingresar</button>
        </form>
        
        <p>¿No tienes cuenta? <a href="register.php">Regístrate</a></p>
        <p>Volver al inicio <a href="../index.php">Inicio</a></p>
    </div>
</body>
</html>