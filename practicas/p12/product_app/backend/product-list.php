<?php
    use TECWEB\MYAPI\READ\Read;
    require_once __DIR__.'/vendor/autoload.php';

    $productos = new Read('marketzone');
    $productos->list();
    echo $productos->getData();
?>