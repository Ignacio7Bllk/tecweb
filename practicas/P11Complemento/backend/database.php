<?php
    $conexion = @mysqli_connect(
        'localhost',
        'root',
        'b3llak0',
        'marketzone'
    );
    if(!$conexion) {
        die('¡Base de datos NO conextada!');
    }
?>