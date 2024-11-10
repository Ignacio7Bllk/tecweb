<?php
    include('database.php');
    if (isset($_POST['nombre'])) {
        $nombre = $conexion->real_escape_string($_POST['nombre']);
        $consulta = "SELECT id FROM productos WHERE nombre = '$nombre' AND eliminado = 0 LIMIT 1";
        $resultado = $conexion->query($consulta);
    
        if ($resultado->num_rows > 0) {
            echo 'existe';
        } else {
            echo 'disponible';
        }
    }
?>