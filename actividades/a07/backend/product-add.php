<?php
    use TECWEB\MYAPI\Products;
    require_once __DIR__.'/myapi/products.php';
    
    $productos = new Products('marketzone');
    $jsonObj = json_decode($_POST['description']);
    $productos->add($jsonObj, $_POST['name']);
    $productos->getResponse();
?>