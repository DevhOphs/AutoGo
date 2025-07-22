<?php
session_start();
if (!isset($_SESSION["usuario"]) || $_SESSION["tipo"] !== "usuario") {
    header("Location: ../login.php");
    exit();
}

include '../conexion.php';

// Obtener autos desde mysql
$sql = "SELECT * FROM vehiculos";
$result = $conexion->query($sql);
$cars = $result->fetch_all(MYSQLI_ASSOC);

// Obtener reservas activas
$current_date = date('Y-m-d H:i:s');
$reservations_query = "SELECT vehiculo_id 
                      FROM reservas 
                      WHERE estado = 'Confirmada' 
                        AND fecha_recogida <= '$current_date' 
                        AND fecha_devolucion >= '$current_date'";//sirve para encontrar los vehiculos con reservas conf.
$reservations_result = $conexion->query($reservations_query);
$reserved_car_ids = [];
while ($row = $reservations_result->fetch_assoc()) {
    $reserved_car_ids[] = $row['vehiculo_id'];
}//se itera sobre los resultados de las reservas y se agrega el id del auto al array
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoGo - Tu auto ideal, al instante</title>
    <link rel="stylesheet" href="../../public/estilos.css">
</head>
<body>
    <div class="container-home">
        <div class="header">
            <div class="autogo-container">
                <img src="../../assets/car-icon.png" alt="Icono de Auto" width="65">
                <span class="autogo-text">AutoGo</span>
            </div>
            <div class="nav-links">
                <a href="/../../index.php">Inicio</a>
                <a href="/php/Usuario/mis_reservas.php">Mis Reservas</a>
                <a href="/../../logout.php">Cerrar Sesión</a>
            </div>
        </div>
        <h3>Tu auto ideal, al instante</h3>
        <p>Encuentra y reserva el auto perfecto para ti</p>
        <input type="text" class="search-bar" id="search-bar" placeholder="Buscar modelo o marca...">
        <br><br>
        <div class="filters">
            <select class="filter" id="year-filter">
                <option value="">Año</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
                <option value="2021">2021</option>
            </select>
            <select class="filter" id="fuel-filter">
                <option value="">Combustible</option>
                <option value="Gasolina">Gasolina</option>
                <option value="Híbrido">Híbrido</option>
                <option value="Eléctrico">Eléctrico</option>
            </select>
            <select class="filter" id="price-filter">
                <option value="">Precio</option>
                <option value="0-100">Menos de $100</option>
                <option value="100-200">$100 - $200</option>
                <option value="200+">Más de $200</option>
            </select>
            <select class="filter" id="type-filter">
                <option value="">Tipo</option>
                <option value="SUV">SUV</option>
                <option value="Sedán">Sedán</option>
                <option value="Camioneta">Camioneta</option>
                <option value="Van">Van</option>
                <option value="Deportivo">Deportivo</option>
            </select>
            <select class="filter" id="transmission-filter">
                <option value="">Transmisión</option>
                <option value="Manual">Manual</option>
                <option value="Automático">Automático</option>
            </select>
            <select class="filter" id="status-filter">
                <option value="">Disponibilidad</option>
                <option value="disponible">Disponible</option>
                <option value="no-disponible">No Disponible</option>
            </select>
        </div>
        <div class="car-list" id="car-list">
            <?php foreach ($cars as $car): 
                $isReserved = in_array($car['id'], $reserved_car_ids);//compara id's
                $status = $isReserved ? 'no-disponible' : 'disponible';
            ?>
                <div class="car-card" data-year="<?php echo $car['anio']; ?>" data-fuel="<?php echo $car['combustible']; ?>" 
                     data-price="<?php echo $car['precio']; ?>" data-type="<?php echo $car['tipo']; ?>" 
                     data-transmission="<?php echo $car['transmision']; ?>" data-status="<?php echo $status; ?>">
                    <img src="../../Assets/<?php echo $car['imagen']; ?>" alt="<?php echo $car['modelo']; ?>">
                    <div class="car-model"><?php echo $car['marca'] . ' ' . $car['modelo']; ?></div>
                    <div class="car-details"><?php echo $car['anio'] . ' - ' . $car['transmision'] . ' - ' . $car['combustible']; ?></div>
                    <div class="car-details">$<?php echo $car['precio']; ?>/día</div>
                    
                    <form method="get" action="reserva.php">
                        <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
                        <input type="hidden" name="model" value="<?php echo htmlspecialchars($car['marca'] . ' ' . $car['modelo']); ?>">
                        <input type="hidden" name="year" value="<?php echo $car['anio']; ?>">
                        <input type="hidden" name="transmission" value="<?php echo htmlspecialchars($car['transmision']); ?>">
                        <input type="hidden" name="fuel" value="<?php echo htmlspecialchars($car['combustible']); ?>">
                        <input type="hidden" name="price" value="<?php echo $car['precio']; ?>">
                        <button class="button" type="submit" <?php echo $isReserved ? 'disabled' : ''; ?>>
                            <?php echo $isReserved ? 'Reservado' : 'Reservar'; ?>
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="../../public/script.js"></script>
</body>
</html>