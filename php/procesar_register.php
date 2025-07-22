<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    
    echo "Registrando usuario: $nombre con email: $email";
    echo "<script>setTimeout(function(){ window.location.href = 'home.php'; }, 2500);</script>";
}
?>