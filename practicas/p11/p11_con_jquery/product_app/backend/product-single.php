<?php
    include('database.php');

    $id = $_POST['id'];

    $query = "SELECT * FROM productos WHERE id = $id";
    $result = mysqli_query($conexion, $query);
    if(!$result){
        die('Error de consulta');
    }
    $row = mysqli_fetch_array($result);
        $json[] = array(
            'id' => $row['id'],
            'nombre' => $row['nombre'],
            'marca' => $row['marca'],
            'modelo' => $row['modelo'],
            'precio' => $row['precio'],
            'detalles' => $row['detalles'],
            'unidades' => $row['unidades'],
            'imagen' => $row['imagen']
        );
    

    $jsonString = json_encode($json[0]);
    echo $jsonString;

?>