<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 6</title>
</head>
<body>

<h1>Ejercicio 1</h1>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>

    <form method="GET">
        Ingrese el número: <input type="number" name="numero">
        <input type="submit" value="Enviar">
    </form>
<?php
    
    if (isset($_GET['numero'])) {
        $num = $_GET['numero'];
    Multiplo($num);
    }
?>

</body>
</html>