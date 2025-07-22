<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoGo - Agregar Vehículo</title>
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
                <a href="home.php">Inicio</a>
                <a href="inventario.php">Inventario</a>
                <a href="../index.html">Cerrar Sesión</a>
            </div>
        </div>
        <h3>Agregar Vehículo</h3>
        <form class="reserva-form" action="procesar_vehiculo.php" method="POST" enctype="multipart/form-data">
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
                    <label for="transmision">Transmisión</label>
                    <select id="transmision" name="transmision" class="filter" required>
                        <option value="">Seleccionar</option>
                        <option value="manual">Manual</option>
                        <option value="automatico">Automático</option>
                    </select>
                </div>
                <div>
                    <label for="combustible">Combustible</label>
                    <select id="combustible" name="combustible" class="filter" required>
                        <option value="">Seleccionar</option>
                        <option value="gasolina">Gasolina</option>
                        <option value="hibrido">Híbrido</option>
                        <option value="electrico">Eléctrico</option>
                    </select>
                </div>
            </div>
            <label for="imagen">Imagen del Vehículo</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required>
            <button type="submit" class="button">Agregar Vehículo</button>
        </form>
    </div>
</body>
</html>