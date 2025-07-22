<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoGo - Gestión de Inventario</title>
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
                <a href="agregar_vehiculo.php" class="button">Agregar Vehículo</a>
                <a href="../index.html">Cerrar Sesión</a>
            </div>
        </div>

        <h3>Gestión de Inventario</h3>
        <input type="text" class="search-bar" placeholder="Buscar por modelo o placa...">

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Modelo</th>
                    <th>Placa</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img src="/assets/toyotaRAV_mini.png" alt="Toyota RAV4 SUV" width="60">
                        Toyota RAV4 SUV
                    </td>
                    <td>ABC-1234</td>
                    <td>Disponible</td>
                    <td>
                        <a href="inventario_edit.php?id=1" class="btn-edit">Editar</a>
                        <button class="btn-delete">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="/assets/BMWS3_mini.png" alt="BMW Serie 3 Sedán" width="60">
                        BMW Serie 3 Sedán
                    </td>
                    <td>DEF-5678</td>
                    <td>Alquilado</td>
                    <td>
                        <a href="inventario_edit.php?id=2" class="btn-edit">Editar</a>
                        <button class="btn-delete">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="/assets/fordmustang_mini.png" alt="Ford Mustang Deportivo" width="60">
                        Ford Mustang Deportivo
                    </td>
                    <td>GHI-9012</td>
                    <td>Mantenimiento</td>
                    <td>
                        <a href="inventario_edit.php?id=3" class="btn-edit">Editar</a>
                        <button class="btn-delete">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="/assets/hondaCRV_mini.png" alt="Honda CRV SUV" width="60">
                        Honda CRV SUV
                    </td>
                    <td>JKL-3456</td>
                    <td>Disponible</td>
                    <td>
                        <a href="inventario_edit.php?id=4" class="btn-edit">Editar</a>
                        <button class="btn-delete">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>