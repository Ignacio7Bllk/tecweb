<?php
    include('database.php');

    $data = array(
        'status' => 'error',
        'message' => 'No se pudo actualizar el producto'
    );
    $id = $_POST['producto_id'];
    $nom = $_POST['nombre'];
    $mar = $_POST['marca'];
    $mod = $_POST['modelo'];
    $pre = $_POST['precio'];
    $det = $_POST['detalles'];
    $unid = $_POST['unidades'];
    $img = $_POST['imagen'];
    $conexion->set_charset("utf8");
    
    if (!empty($nom)) {
        $query = "UPDATE productos SET nombre = '{$nom}', marca = '{$mar}', modelo = '{$mod}', precio = {$pre}, 
        detalles = '{$det}', unidades = {$unid}, imagen = '{$img}' WHERE id = {$id}"; 
        if ($conexion->query($query) === TRUE) {
            $data['status'] = "success";
            $data['message'] = "Producto actualizada correctamente";
        }
         
    } 
    echo 'status: '.$data['status'].'<br> message: '.$data['message'];
?>