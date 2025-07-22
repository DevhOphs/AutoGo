<?php
session_start();

if (!isset($_SESSION["usuario"]) || $_SESSION["tipo"] !== "admin") {
    header("Location: ../login.php");
    exit();
}

include '../conexion.php';

$auto_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Obtener vehículo desde la base de datos
$sql = "SELECT * FROM vehiculos WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $auto_id);
$stmt->execute();
$result = $stmt->get_result();
$auto = $result->fetch_assoc();

if (!$auto) {
    die("ID de auto no válido.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Auto - AutoGo</title>
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
                <a href="inventario.php">Volver al Inventario</a>
                <a href="/logout.php">Cerrar Sesión</a>
            </div>
        </div>

        <div class="edit-form">
            <h3>Editar Auto: <?= htmlspecialchars($auto['modelo']) ?></h3>
            
            <form action="actualizar_auto.php" method="POST">
                <input type="hidden" name="id" value="<?= $auto_id ?>">
                
                <div class="form-group">
                    <label for="modelo">Modelo</label>
                    <input type="text" id="modelo" name="modelo" value="<?= htmlspecialchars($auto['modelo']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="marca">Marca</label>
                    <input type="text" id="marca" name="marca" value="<?= htmlspecialchars($auto['marca']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="placa">Placa</label>
                    <input type="text" id="placa" name="placa" value="<?= htmlspecialchars($auto['placa']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="anio">Año</label>
                    <input type="number" id="anio" name="anio" min="1990" max="2099" value="<?= $auto['anio'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="transmision">Transmisión</label>
                    <select id="transmision" name="transmision" required>
                        <option value="Automático" <?= $auto['transmision'] === 'Automático' ? 'selected' : '' ?>>Automático</option>
                        <option value="Manual" <?= $auto['transmision'] === 'Manual' ? 'selected' : '' ?>>Manual</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="combustible">Combustible</label>
                    <select id="combustible" name="combustible" required>
                        <option value="Gasolina" <?= $auto['combustible'] === 'Gasolina' ? 'selected' : '' ?>>Gasolina</option>
                        <option value="Diésel" <?= $auto['combustible'] === 'Diésel' ? 'selected' : '' ?>>Diésel</option>
                        <option value="Híbrido" <?= $auto['combustible'] === 'Híbrido' ? 'selected' : '' ?>>Híbrido</option>
                        <option value="Eléctrico" <?= $auto['combustible'] === 'Eléctrico' ? 'selected' : '' ?>>Eléctrico</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="precio">Precio por día ($)</label>
                    <input type="number" id="precio" name="precio" step="0.01" min="0" value="<?= $auto['precio'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <select id="tipo" name="tipo" required>
                        <option value="SUV" <?= $auto['tipo'] === 'SUV' ? 'selected' : '' ?>>SUV</option>
                        <option value="Sedán" <?= $auto['tipo'] === 'Sedán' ? 'selected' : '' ?>>Sedán</option>
                        <option value="Deportivo" <?= $auto['tipo'] === 'Deportivo' ? 'selected' : '' ?>>Deportivo</option>
                        <option value="Pickup" <?= $auto['tipo'] === 'Pickup' ? 'selected' : '' ?>>Pickup</option>
                        <option value="Van" <?= $auto['tipo'] === 'Van' ? 'selected' : '' ?>>Van</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" required>
                        <option value="disponible" <?= $auto['estado'] === 'disponible' ? 'selected' : '' ?>>Disponible</option>
                        <option value="no-disponible" <?= $auto['estado'] === 'no-disponible' ? 'selected' : '' ?>>No Disponible</option>
                        <option value="mantenimiento" <?= $auto['estado'] === 'mantenimiento' ? 'selected' : '' ?>>Mantenimiento</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="imagen">Imagen del vehículo</label>
                    <input type="text" id="imagen" name="imagen" value="<?= htmlspecialchars($auto['imagen']) ?>" required>
                </div>
                
                <div class="button-group">
                    <button type="button" class="button secondary" onclick="history.back()">Cancelar</button>
                    <button type="submit" class="button">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>