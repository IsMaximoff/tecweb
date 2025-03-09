<?php
    include_once __DIR__.'/database.php';

    $producto = file_get_contents('php://input');
    $data = array(
        'status'  => 'error',
        'message' => 'No se pudo editar el producto'
    );
    if( isset($_GET['id']) && !empty($producto)) {
        $jsonOBJ = json_decode($producto);
        $id = $_GET['id'];

        $sql = "UPDATE productos SET marca = '{$jsonOBJ->marca}', modelo = '{$jsonOBJ->modelo}', precio = {$jsonOBJ->precio}, unidades = {$jsonOBJ->unidades}, detalles = '{$jsonOBJ->detalles}', imagen = '{$jsonOBJ->imagen}' WHERE id = {$id}";
        
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS

        if ( $conexion->query($sql) ) {
            $data['status'] =  "success";
            $data['message'] =  "Producto editado";
		} else {
            $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($conexion);
        }
		$conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>