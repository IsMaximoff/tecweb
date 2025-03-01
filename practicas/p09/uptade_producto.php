<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    @$link = new mysqli('localhost', 'root', 'WandaVision', 'marketzone');
    if ($link->connect_errno) {
        die('<p>Falló la conexión: '.$link->connect_error.'</p>');
    }

    // Escapar datos para evitar inyección SQL
    $id = $link->real_escape_string($_POST['id']);
    $nombre = $link->real_escape_string($_POST['nombre']);
    $marca = $link->real_escape_string($_POST['marca']);
    $modelo = $link->real_escape_string($_POST['modelo']);
    $precio = floatval($_POST['precio']);
    $detalles = $link->real_escape_string($_POST['detalles']);
    $unidades = intval($_POST['unidades']);

    // Manejo de imagen (si se sube)
    if (!empty($_FILES['imagen']['name'])) {
        $imagen = basename($_FILES['imagen']['name']);
        $ruta = "src/".$imagen;

        // Mover imagen al servidor
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)) {
            $sql = "UPDATE productos SET nombre='$nombre', marca='$marca', modelo='$modelo', precio=$precio, detalles='$detalles', unidades=$unidades, imagen='$ruta' WHERE id=$id";
        } else {
            die('<p>Error al subir la imagen.</p>');
        }
    } else {
        $sql = "UPDATE productos SET nombre='$nombre', marca='$marca', modelo='$modelo', precio=$precio, detalles='$detalles', unidades=$unidades WHERE id=$id";
    }

    // Ejecutar actualización
    if ($link->query($sql)) {
        echo "<p>Producto actualizado correctamente.</p>";
        echo '<p><a href="get_productos_xhtml_v2.php">Ver productos en XHTML</a></p>';
        echo '<p><a href="get_productos_vigentes_v2.php">Ver productos vigentes</a></p>';
    } else {
        echo "<p>Error al actualizar el producto: " . $link->error . "</p>";
    }

    $link->close();
}
?>

