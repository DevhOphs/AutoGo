<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $modelo = $_POST['modelo'];
        $marca = $_POST['marca'];
        $precio = $_POST['precio'];
        $anio = $_POST['anio'];
        $transmision = $_POST['transmision'];
        $combustible = $_POST['combustible'];

        // Manejo de la subida de archivo
        $target_dir = "../assets/vehiculos/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Verificar si es una imagen
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if ($check === false) {
            echo "<p>El archivo no es una imagen.</p>";
            $uploadOk = 0;
        }

        // Verificar tamaño del archivo
        if ($_FILES["imagen"]["size"] > 500000) {
            echo "<p>El archivo es demasiado grande.</p>";
            $uploadOk = 0;
        }

        // Permitir solo ciertos formatos
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "<p>Solo se permiten archivos JPG, JPEG, PNG y GIF.</p>";
            $uploadOk = 0;
        }

    // Guardar la imagen si no hay errores
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                // Guardar datos en vehiculos.txt
                $data = "$modelo,$marca,$precio,$anio,$transmision,$combustible,$target_file\n";
                file_put_contents('vehiculos.txt', $data, FILE_APPEND);

                // Mostrar mensaje de éxito y redirigir
                echo "<p>Vehículo agregado con éxito: $modelo ($marca)</p>";
                echo "<script>setTimeout(function(){ window.location.href = 'inventario.php'; }, 2500);</script>";
            } else {
            echo "<p>Error al subir el archivo.</p>";
            }
        } else {
            echo "<p>Error al procesar el formulario.</p>";
        }
        exit;
    }
?>