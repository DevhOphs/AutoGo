<?php
session_start();

if (!isset($_SESSION["usuario"]) || $_SESSION["tipo"] !== "admin") {
    header("Location: ../login.php");
    exit();
}

include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $placa = $_POST['placa'];
    $anio = (int)$_POST['anio'];
    $transmision = $_POST['transmision'];
    $combustible = $_POST['combustible'];
    $precio = (float)$_POST['precio'];
    $tipo = $_POST['tipo'];
    $estado = $_POST['estado'];
    $imagen = $_POST['imagen'];

    $stmt = $conexion->prepare("UPDATE vehiculos SET 
        modelo = ?, marca = ?, placa = ?, anio = ?, transmision = ?, 
        combustible = ?, precio = ?, tipo = ?, estado = ?, imagen = ? 
        WHERE id = ?");
    
    $stmt->bind_param("sssisssdssi", 
        $modelo, $marca, $placa, $anio, $transmision, 
        $combustible, $precio, $tipo, $estado, $imagen, $id
    );
    
    if ($stmt->execute()) {
        header("Location: inventario.php");
        exit();
    } else {
        die("Error al actualizar: " . $conexion->error);
    }
}
?>