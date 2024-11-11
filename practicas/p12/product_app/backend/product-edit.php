<?php
    use TECWEB\MYAPI\UPDATE\Update;
    require_once __DIR__.'/vendor/autoload.php';

    $productos = new Update('marketzone');
    $productos->edit( json_decode( json_encode($_POST) ) );
    echo $productos->getData();
?>