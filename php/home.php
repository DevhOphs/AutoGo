<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoGo - Tu auto ideal, al instante</title>
    <link rel="stylesheet" href="../public/estilos.css">
</head>
<body>
    <div class="container-home">
        <div class="header">
            <div class="autogo-container">
                <img src="/assets/car-icon.png" alt="Icono de Auto" width="75">
                <span class="autogo-text">AutoGo</span>
            </div>
            <div class="nav-links">
                <a href="reportes.php">Reportes</a>
                <a href="inventario.php">Inventario</a>
                <a href="/index.html">Cerrar Sesión</a>
            </div>
        </div>
        <h3>Tu auto ideal, al instante</h3>
        <p>Encuentra y reserva el auto perfecto para ti</p>
        <input type="text" class="search-bar" placeholder="Buscar modelo o marca...">
        <br><br>
        <div class="filters">
            <select class="filter">
                <option value="">Año</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
            </select>
            <select class="filter">
                <option value="">Combustible</option>
                <option value="gasolina">Gasolina</option>
                <option value="hibrido">Híbrido</option>
                <option value="electrico">Eléctrico</option>
            </select>
            <select class="filter">
                <option value="">Precio</option>
                <option value="0-100">Menos de $100</option>
                <option value="100-200">$100 - $200</option>
                <option value="200+">Más de $200</option>
            </select>
            <select class="filter">
                <option value="">Tipo</option>
                <option value="suv">SUV</option>
                <option value="sedan">Sedán</option>
                <option value="camioneta">Camioneta</option>
                <option value="van">Van</option>
            </select>
            <select class="filter">
                <option value="">Transmisión</option>
                <option value="manual">Manual</option>
                <option value="automatico">Automático</option>
            </select>
            <select class="filter">
                <option value="">Disponibilidad</option>
                <option value="disponible">Disponible</option>
                <option value="no-disponible">No Disponible</option>
            </select>
        </div>
        <div class="car-list">
            <div class="car-card">
                <img src="/assets/toyotaRAV.png" alt="Toyota RAV4 SUV">
                <div class="car-model">Toyota RAV4 SUV</div>
                <div class="car-details">2024 - Automático - Gasolina</div>
                <div class="car-details">$50/día</div>
                <button class="button" onclick="location.href='reserva.php'">Reservar</button>
            </div>
            <div class="car-card">
                <img src="/assets/BMWS3.png" alt="BMW Serie 3 Sedán">
                <div class="car-model">BMW Serie 3 Sedán</div>
                <div class="car-details">2023 - Automático - Gasolina</div>
                <div class="car-details">$150/día</div>
                <button class="button" onclick="location.href='reserva.php'">Reservar</button>
            </div>
            <div class="car-card">
                <img src="/assets/fordmustang.png" alt="Ford Mustang Deportivo">
                <div class="car-model">Ford Mustang Deportivo</div>
                <div class="car-details">2022 - Manual - Gasolina</div>
                <div class="car-details">$200/día</div>
                <button class="button" onclick="location.href='reserva.php'">Reservar</button>
            </div>
            <div class="car-card">
                <img src="/assets/hondaCRV.png" alt="Honda CRV SUV">
                <div class="car-model">Honda CRV SUV</div>
                <div class="car-details">2021 - Automático - Híbrido</div>
                <div class="car-details">$150/día</div>
                <button class="button" onclick="location.href='reserva.php'">Reservar</button>
            </div>
        </div>
    </div>
</body>
</html>