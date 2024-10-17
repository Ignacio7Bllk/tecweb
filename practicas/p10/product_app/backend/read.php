<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();


    if (isset($_POST['search'])){
        $search = $_POST['search'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        if ($result = $conexion->query("SELECT * FROM productos WHERE nombre LIKE '%{$search}%'" . " OR marca LIKE '%{$search}%'" . " OR detalles LIKE '%{$search}%'")) {
            // SE OBTIENEN LOS RESULTADOS

        while( $row = $result->fetch_array(MYSQLI_ASSOC)){
            $data[] = array_map('utf8_encode', $row);
        }
           // SE LIBERA LA MEMORIA
            $result->free();
    }else{
        die('Query Error: '.mysqli_error($conexion));
    }
    $conexion->close();
    }

    if(empty($data)){
        $data[] = array('mensaje' => 'No se encontraron resultados');
    }else{
        echo json_encode($data, JSON_PRETTY_PRINT) ;
    }

    
?>