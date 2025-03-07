<?php
    include_once __DIR__.'/database.php';

    // Recibir y decodificar el JSON enviado desde el cliente
    $data = json_decode(file_get_contents("php://input"), true);

    // Validación temprana: verificar que los datos necesarios estén presentes
    $missingFields = [];
    foreach (['nombre', 'marca', 'modelo', 'detalles'] as $field) {
        if (empty($data[$field])) {
            $missingFields[] = $field;
        }
    }
    
    // Si faltan campos obligatorios, enviar error
    if (!empty($missingFields)) {
        echo json_encode(["mensaje" => "Faltan datos obligatorios: " . implode(', ', $missingFields)]);
        exit;
    }

    // Sanitizar y escapar los valores antes de usarlos en la consulta
    $nombre = $conexion->real_escape_string($data['nombre']);
    $marca = $conexion->real_escape_string($data['marca']);
    $modelo = $conexion->real_escape_string($data['modelo']);
    $detalles = $conexion->real_escape_string($data['detalles']);

    // Verificación de existencia del producto (nombre + marca) o (marca + modelo)
    $query = "
        SELECT id FROM productos 
        WHERE eliminado = 0 AND 
              ((nombre = '$nombre' AND marca = '$marca') 
              OR (marca = '$marca' AND modelo = '$modelo'))
    ";

    // Ejecución de la consulta de verificación
    $existeProducto = $conexion->query($query)->num_rows > 0;

    // Acción según la existencia del producto
    if ($existeProducto) {
        echo json_encode(["mensaje" => "El producto ya existe."]);
    } else {
        // Insertar el nuevo producto si no existe
        $queryInsertar = "
            INSERT INTO productos (nombre, marca, modelo, detalles, eliminado) 
            VALUES ('$nombre', '$marca', '$modelo', '$detalles', 0)
        ";

        // Resultado de la inserción
        $mensaje = $conexion->query($queryInsertar) ? "¡Producto agregado exitosamente!" : "Error al agregar el producto.";

        echo json_encode(["mensaje" => $mensaje]);
    }

    $conexion->close();
?>