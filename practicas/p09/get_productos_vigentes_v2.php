<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<?php
if(isset($_GET['tope']))
    $tope = $_GET['tope'];
else
    die('<p>Parámetro "tope" no detectado...</p>');

if (!empty($tope))
{
    /** SE CREA EL OBJETO DE CONEXION */
    @$link = new mysqli('localhost', 'root', 'WandaVision', 'marketzone');    

    /** comprobar la conexión */
    if ($link->connect_errno) 
    {
        die('<p>Falló la conexión: '.$link->connect_error.'</p>');
    }

    /** Obtener los productos no eliminados con unidades <= tope */
    if ($result = $link->query("SELECT * FROM productos WHERE unidades <= $tope AND eliminado = 0")) 
    {
        $productos = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
    }

    $link->close();
}
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Productos No Eliminados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
</head>
<body>
    <h3>PRODUCTOS VIGENTES</h3>
    <br/>
    
    <?php if(!empty($productos)) : ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Unidades</th>
                    <th scope="col">Detalles</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Modificar</th> <!-- Nueva columna -->
                </tr>
            </thead>
            <tbody>
                <?php foreach($productos as $producto) : ?>
                    <tr>
                        <th scope="row"><?= $producto['id'] ?></th>
                        <td><?= $producto['nombre'] ?></td>
                        <td><?= $producto['marca'] ?></td>
                        <td><?= $producto['modelo'] ?></td>
                        <td><?= $producto['precio'] ?></td>
                        <td><?= $producto['unidades'] ?></td>
                        <td><?= $producto['detalles'] ?></td>
                        <td><img src="<?= $producto['imagen'] ?>" width="100" /></td>
                        <td>
                            <a href="formulario_productos_v2.php?id=<?= $producto['id'] ?>" class="btn btn-warning">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No se encontraron productos con el tope especificado.</p>
    <?php endif; ?>
</body>
</html>
