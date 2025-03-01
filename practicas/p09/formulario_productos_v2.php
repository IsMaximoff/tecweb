<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_producto = $_GET['id'];

    // Conexión segura a la BD
    @$link = new mysqli('localhost', 'root', 'WandaVision', 'marketzone');
    if ($link->connect_errno) {
        die('<p>Falló la conexión: '.$link->connect_error.'</p>');
    }

    $producto = [
        'id' => '',
        'nombre' => '',
        'marca' => '',
        'modelo' => '',
        'precio' => '',
        'unidades' => '',
        'detalles' => '',
        'imagen' => 'src/default.webp' 
    ];

    // Consulta segura con prepared statement
    $stmt = $link->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
    } else {
        die('<p>Error: Producto no encontrado.</p>');
    }

    $stmt->close();
    $link->close();
} else {
    die('<p>Error: ID de producto no válido.</p>');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Actualizar Producto</title>
    <style>
        ol, ul { list-style-type: none; }
        img { max-width: 200px; display: block; margin-top: 10px; }
    </style>
</head>
<body>
    <h1>Actualizar Producto</h1>

    <form id="formularioProductos" action="uptade_producto.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Datos del producto</legend>

            <input type="hidden" name="id" value="<?= $id_producto ?>">

            <ul>
                <li><label for="nombre">Nombre:</label> <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required></li>
                <li><label for="marca">Marca:</label> 
                    <select name="marca" id="marca" required>
                        <option value="">Seleccione una marca</option>
                        <option value="Editorial Planeta" <?= $producto['marca'] == 'Editorial Planeta' ? 'selected' : '' ?>>Editorial Planeta</option>
                        <option value="Penguin Random House" <?= $producto['marca'] == 'Penguin Random House' ? 'selected' : '' ?>>Penguin Random House</option>
                        <option value="HarperCollins" <?= $producto['marca'] == 'HarperCollins' ? 'selected' : '' ?>>HarperCollins</option>
                        <option value="Santillana" <?= $producto['marca'] == 'Santillana' ? 'selected' : '' ?>>Santillana</option>
                    </select>
                </li>    
                <li><label for="modelo">Modelo:</label> <input type="text" name="modelo" id="modelo" value="<?= htmlspecialchars($producto['modelo']) ?>" required></li>
                <li><label for="precio">Precio:</label> <input type="number" name="precio" id="precio" value="<?= $producto['precio'] ?>" step="0.01" required></li>
                <li><label for="detalles">Detalles:</label> <input type="text" name="detalles" id="detalles" value="<?= htmlspecialchars($producto['detalles']) ?>"></li>
                <li><label for="unidades">Unidades:</label> <input type="number" name="unidades" id="unidades" value="<?= $producto['unidades'] ?>" required></li>
                <li>
                    <label for="imagen">Imagen actual:</label>
                    <img src="<?= htmlspecialchars($producto['imagen']) ?>" alt="Imagen del producto">
                    <label for="imagen">Nueva Imagen:</label>
                    <input type="file" name="imagen" id="imagen" accept="image/*">
                </li>
            </ul>
        </fieldset>

        <p>
            <input type="submit" value="Actualizar producto">
            <input type="reset" value="Limpiar">
        </p>
    </form>

    <script src="validaciones.js"></script>
</body>
</html>
