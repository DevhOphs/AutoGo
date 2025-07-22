<?php
$auto_id = $_GET['id'];
$auto_data = [
    '1' => ['nombre' => 'Toyota RAV4 SUV', 'placa' => 'ABC-1234', 'modelo' => 'RAV4'],
    '2' => ['nombre' => 'BMW Serie 3 Sedán', 'placa' => 'DEF-5678', 'modelo' => 'Serie 3'],
    '3' => ['nombre' => 'Ford Mustang Deportivo', 'placa' => 'GHI-9012', 'modelo' => 'Mustang'],
    '4' => ['nombre' => 'Honda CRV SUV', 'placa' => 'JKL-3456', 'modelo' => 'CRV'],
];
$auto = $auto_data[$auto_id];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Auto - AutoGo</title>
    <link rel="stylesheet" href="../public/estilos.css">
</head>
<body>
    <div class="container-home">
        <div class="header">
            <div class="autogo-container">
                <img src="../assets/car-icon.png" alt="Icono de Auto" width="75">
                <span class="autogo-text">AutoGo</span>
            </div>
            <div class="nav-links">
                <a href="inventario.php">Volver al Inventario</a>
                <a href="../index.html">Cerrar Sesión</a>
            </div>
        </div>

        <h3>Editar Auto</h3>
        <form action="/public/actualizar_auto.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $auto_id; ?>">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $auto['nombre']; ?>" required>
            
            <label for="placa">Placa</label>
            <input type="text" id="placa" name="placa" value="<?php echo $auto['placa']; ?>" required>
            
            <label for="modelo">Modelo</label>
            <input type="text" id="modelo" name="modelo" value="<?php echo $auto['modelo']; ?>" required>
            
            <label for="estado">Estado</label>
            <select id="estado" name="estado" required>
                <option value="Disponible">Disponible</option>
                <option value="Alquilado">Alquilado</option>
                <option value="Mantenimiento">Mantenimiento</option>
            </select>
            
            <button type="submit" class="button">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>