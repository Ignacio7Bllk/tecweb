<?php
    use TECWEB\MYAPI\DELETE\Delete;
    require_once __DIR__.'/vendor/autoload.php';

    $productos = new Delete('marketzone');
    $productos->delete( $_POST['id'] );
    echo $productos->getData();
?>