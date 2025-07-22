<?php
var_dump($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $placa = $_POST['placa'];
    $modelo = $_POST['modelo'];
    $estado = $_POST['estado'];

    // Crear una línea de texto con los datos
    $data = "ID: $id,\n Nombre: $nombre,\n Placa: $placa,\n Modelo: $modelo,\n Estado: $estado\n";

    // Guardar en un archivo de texto
    file_put_contents('autos_editados.txt', $data, FILE_APPEND);

    // Mostrar mensaje de éxito y redirigir después de 2 segundos
    echo "<p>Auto modificado con éxito: $nombre ($placa, $modelo)</p>";
    echo "<script>setTimeout(function(){ window.location.href = '/php/inventario.php'; }, 8000);</script>";
    exit;
}
?>