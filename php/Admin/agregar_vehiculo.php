<?php
session_start();
if (!isset($_SESSION["usuario"]) || $_SESSION["tipo"] !== "admin") {
    header("Location: ../login.php");
    exit();
}

include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $precio = $_POST['precio'];
    $anio = $_POST['anio'];
    $placa = $_POST['placa'];
    $transmision = $_POST['transmision'];
    $combustible = $_POST['combustible'];
    $tipo = $_POST['tipo'];
    $estado = $_POST['estado'];
    $imagen = $_POST['imagen'];

    $stmt = $conexion->prepare("INSERT INTO vehiculos (
        modelo, marca, precio, anio, placa, transmision, combustible, tipo, estado, imagen
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); 
    //se pone ? para cada campo porque son parámetros que se van a llenar con los datos del formulario
    $stmt->bind_param("ssdissssss", //s para string, d para double, i para integer
        $modelo, $marca, $precio, $anio, $placa, $transmision, $combustible, $tipo, $estado, $imagen
    );
    
    if ($stmt->execute()) {
        header('Location: inventario.php');
        exit;
    } else {
        echo "Error al agregar el vehículo: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoGo - Agregar Vehículo</title>
    <link rel="stylesheet" href="../../public/estilos.css">
</head>
<body>
    <div class="container-home">
        <div class="header">
            <div class="autogo-container">
                <img src="../../assets/car-icon.png" alt="Icono de Auto" width="75">
                <span class="autogo-text">AutoGo</span>
            </div>
            <div class="nav-links">
                <a href="homeAdmin.php">Inicio</a>
                <a href="inventario.php">Inventario</a>
                <a href="../../logout.php">Cerrar Sesión</a>
            </div>
        </div>
        <h3>Agregar Vehículo</h3>
        <form class="reserva-form" action="agregar_vehiculo.php" method="POST">
            <div class="form-row">
                <div>
                    <label for="modelo">Modelo</label>
                    <input type="text" id="modelo" name="modelo" placeholder="Ej. RAV4 SUV" required>
                </div>
                <div>
                    <label for="marca">Marca</label>
                    <input type="text" id="marca" name="marca" placeholder="Ej. Toyota" required>
                </div>
            </div>
            <div class="form-row">
                <div>
                    <label for="precio">Precio por día</label>
                    <input type="number" id="precio" name="precio" placeholder="Ej. 50" step="0.01" required>
                </div>
                <div>
                    <label for="anio">Año</label>
                    <input type="number" id="anio" name="anio" placeholder="Ej. 2024" required>
                </div>
            </div>
            <div class="form-row">
                <div>
                    <label for="placa">Placa</label>
                    <input type="text" id="placa" name="placa" placeholder="Ej. PRE-203" required>
                </div>
            </div>
            <div class="form-row">
                <div>
                    <label for="transmision">Transmisión</label>
                    <select id="transmision" name="transmision" class="filter" required>
                        <option value="">Seleccionar</option>
                        <option value="Manual">Manual</option>
                        <option value="Automático">Automático</option>
                    </select>
                </div>
                <div>
                    <label for="combustible">Combustible</label>
                    <select id="combustible" name="combustible" class="filter" required>
                        <option value="">Seleccionar</option>
                        <option value="Gasolina">Gasolina</option>
                        <option value="Híbrido">Híbrido</option>
                        <option value="Eléctrico">Eléctrico</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div>
                    <label for="tipo">Tipo</label>
                    <select id="tipo" name="tipo" class="filter" required>
                        <option value="">Seleccionar</option>
                        <option value="SUV">SUV</option>
                        <option value="Sedán">Sedán</option>
                        <option value="Camioneta">Camioneta</option>
                        <option value="Van">Van</option>
                        <option value="Deportivo">Deportivo</option>
                    </select>
                </div>
                <div>
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" class="filter" required>
                        <option value="">Seleccionar</option>
                        <option value="disponible">Disponible</option>
                        <option value="no-disponible">No Disponible</option>
                        <option value="mantenimiento">Mantenimiento</option>
                    </select>
                </div>
            </div>
            <label for="imagen">URL de la imagen</label>
            <input type="text" id="imagen" name="imagen" placeholder="Ej: toyotaRAV.png" required>
            <button type="submit" class="button">Agregar Vehículo</button>
        </form>
    </div>
</body>
</html>