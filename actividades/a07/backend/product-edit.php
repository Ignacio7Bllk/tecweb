<?php
    use TECWEB\MYAPI\Products;
    require_once __DIR__.'/myapi/products.php';
 
    
    $productos = new Products('marketzone');
    $jsonObj = json_decode($_POST['description']);
    $productId = $_POST['producto_id'];
    $jsonObj->id = $productId;
    $productos->edit($jsonObj, $_POST['name']);
    $productos->getResponse();
?>