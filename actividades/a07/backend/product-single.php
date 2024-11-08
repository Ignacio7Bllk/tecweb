<?php
    use TECWEB\MYAPI\Products;
    require_once __DIR__.'/myapi/products.php';
    
    $productos = new Products('marketzone');
    $productos->single($_POST['id']);
    $productos->getResponse();
    
    
?>