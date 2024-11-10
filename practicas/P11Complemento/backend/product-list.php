<?php
    include('database.php');

    $query = "SELECT * from productos WHERE eliminado = 0";
    $result = mysqli_query($conexion, $query);

    if(!$result){
        die('Query Failed'.mysqli_error($conexion));
    }
    $json = array();
    while($row = mysqli_fetch_array($result)){
        $json[] = array(
            'id'=> $row['id'],
            'nombre'=> $row['nombre'],
            'precio'=> $row['precio'],
            'unidades'=> $row['unidades'],
            'marca'=> $row['marca'],
            'modelo'=> $row['modelo'],
            'detalles'=> $row['detalles']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring; 
?>