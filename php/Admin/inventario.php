<?php
session_start();

if (!isset($_SESSION["usuario"]) || $_SESSION["tipo"] !== "admin") {
    header("Location: ../login.php");
    exit();
}

include '../conexion.php';

// Obtener vehículos desde la base de datos
$sql = "SELECT * FROM vehiculos";
$result = $conexion->query($sql);
$vehiculos = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoGo - Gestión de Inventario</title>
    <link rel="stylesheet" href="/public/estilos.css">
</head>
<body>
    <div class="container-home">
        <div class="header">
            <div class="autogo-container">
                <img src="/assets/car-icon.png" alt="Icono de Auto" width="75">
                <span class="autogo-text">AutoGo</span>
            </div>
            <div class="nav-links">
                <a href="homeAdmin.php">Inicio</a>
                <a href="agregar_vehiculo.php" class="button">Agregar Vehículo</a>
                <a href="/logout.php">Cerrar Sesión</a>
            </div>
        </div>

        <h3>Gestión de Inventario</h3>
        <input type="text" class="search-bar" id="search-bar" placeholder="Buscar por modelo o placa...">
        <table class="admin-table" id="inventory-table">
            <thead>
                <tr>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Placa</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vehiculos as $vehiculo): ?>
                    <tr class="car-item" data-model="<?php echo htmlspecialchars($vehiculo['modelo']); ?>" data-placa="<?php echo htmlspecialchars($vehiculo['placa']); ?>" data-status="<?php echo htmlspecialchars($vehiculo['estado']); ?>">
                        <td><?php echo htmlspecialchars($vehiculo['modelo']); ?></td>
                        <td><?php echo htmlspecialchars($vehiculo['marca']); ?></td>
                        <td><?php echo htmlspecialchars($vehiculo['placa']); ?></td>
                        <td><?php echo htmlspecialchars($vehiculo['estado']); ?></td>
                        <td>
                            <!-- Uso get para pasar datos a inventario_edit -->
                            <a href="inventario_edit.php?id=<?php echo htmlspecialchars($vehiculo['id']); ?>" class="btn-edit">Editar</a>
                            <form method="POST" action="eliminar_vehiculo.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $vehiculo['id']; ?>">
                                <button type="submit" class="btn-delete">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="/public/inventario.js"></script>
</body>
</html>