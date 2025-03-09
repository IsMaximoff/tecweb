<?php
    include_once __DIR__.'/database.php';

    $data = null;
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_GET['id'])) {
        $id = $_GET['id'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql = "SELECT * FROM productos WHERE id = {$id}";
        $result = $conexion->query($sql);
        if ( $result ) {
            // SE OBTIENEN LOS RESULTADOS
            $data = $result->fetch_all(MYSQLI_ASSOC)[0];
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
		$conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>