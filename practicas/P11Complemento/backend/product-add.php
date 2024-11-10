<?php
    include('database.php');
    $data = array(
        'status' => 'error',
        'message' => 'Ocurrió un error inesperado.'
    );

    $nom = $_POST['nombre'];
    $mar = $_POST['marca'];
    $mod = $_POST['modelo'];
    $pre = $_POST['precio'];
    $det = $_POST['detalles'];
    $unid = $_POST['unidades'];
    $img = $_POST['imagen'];
    $conexion->set_charset("utf8");
    $sql = "SELECT * FROM productos WHERE nombre = '{$nom}' AND eliminado = 0";
    $result = $conexion->query($sql);
    
    if ($result->num_rows == 0) {
        $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
                VALUES ('{$nom}', '{$mar}', '{$mod}', {$pre}, '{$det}', {$unid}, '{$img}', 0)";

        if ($conexion->query($sql)) {
            $data['status'] = "success";
            $data['message'] = "Producto agregado correctamente";
        } else {
            $data['message'] = "No se ejecutó $sql. " . mysqli_error($conexion);
        }
    } else {
        $data['message'] = "Ya existe un producto con el mismo nombre.";
    }
    $result->free();
    $conexion->close();
    echo 'status: '.$data['status'].'<br> message: '.$data['message'];
?>
