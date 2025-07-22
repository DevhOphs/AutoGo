<?php
session_start();

if (!isset($_SESSION["usuario"]) || $_SESSION["tipo"] !== "admin") {
    header("Location: ../login.php");
    exit();
}

include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    
    $stmt = $conexion->prepare("DELETE FROM vehiculos WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: inventario.php");
        exit();
    } else {
        die("Error al eliminar: " . $conexion->error);
    }
}
?>