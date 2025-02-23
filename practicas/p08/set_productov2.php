<?php
/* CONEXIÓN A LA BASE DE DATOS */
$link = new mysqli('localhost', 'root', 'WandaVision', 'marketzone');

/* Vemos si conecto correctamente */
if ($link->connect_errno) {
    die('<script>alert("Error de conexión: ' . addslashes($link->connect_error) . '"); window.location.href="index.html";</script>');
}

$nombre   = trim($_POST['nombre']) ?? '';
$marca    = trim($_POST['marca']) ?? '';
$modelo   = trim($_POST['modelo']) ?? '';
$precio   = floatval($_POST['precio']) ?? 0.0;
$detalles = trim($_POST['detalles']) ?? '';
$unidades = intval($_POST['unidades'] ?? 0);
$imagen   = $_FILES['imagen']['name'] ?? ''; 

/* Validar que compla con los campos obligatorios */
if (empty($nombre) || empty($marca) || empty($modelo)) {
    die("<html><body><h2>Error</h2><p>Nombre, Marca y Modelo son obligatorios.</p></body></html>");
}

$ruta_imagen = "img/default.png"; // Imagen por defecto si no se sube una nueva

if (!empty($_FILES['imagen']['tmp_name'])) { 
    $directorio = 'img/';
    
    // Crea la carpeta si es que no existe
    if (!is_dir($directorio)) {
        mkdir($directorio, 0777, true);
    }

    $ruta_imagen = $directorio . basename($_FILES['imagen']['name']);

    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen)) {
        $ruta_imagen = 'img/default.png';
    }
}

//Verificar si el producto ya existe
$sql_check = "SELECT id FROM productos WHERE nombre = ? AND marca = ? AND modelo = ?";
$stmt = $link->prepare($sql_check);
$stmt->bind_param("sss", $nombre, $marca, $modelo);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    die("<html><body><h2>Error</h2><p>El producto que quieres registrar ya existe en la base de datos</p></body></html>");
}

$stmt->close();

/*Insertar el producto */
$sql_insert = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $link->prepare($sql_insert);
$stmt->bind_param("sssdsis", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $ruta_imagen);

if ($stmt->execute()) {
    echo "<!DOCTYPE html>
    <html>
    <head><title>Producto Registrado</title></head>
    <body>
        <h2>Producto registrado exitosamente</h2>
        <p><strong>Nombre:</strong> $nombre</p>
        <p><strong>Marca:</strong> $marca</p>
        <p><strong>Modelo:</strong> $modelo</p>
        <p><strong>Precio:</strong> $precio</p>
        <p><strong>Detalles:</strong> $detalles</p>
        <p><strong>Unidades:</strong> $unidades</p>
        <p><strong>Imagen:</strong> <br><img src='$ruta_imagen' width='100' alt='Imagen del producto'></p>
    </body>
    </html>";
} else {
    die("<html><body><h2>Error</h2><p>No se pudo registrar el producto</p></body></html>");
}

$stmt->close();
$link->close();

?>



