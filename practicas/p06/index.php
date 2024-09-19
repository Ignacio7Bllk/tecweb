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
    // Incluir el archivo con la función
    include 'src/funciones.php';

    if (isset($_GET['numero'])) {
        $num = $_GET['numero'];

    if (Multiplo($num)) {
        echo '<h3>R= El número ' . $num . ' SÍ es múltiplo de 5 y 7.</h3>';
    } else {
        echo '<h3>R= El número ' . $num . ' NO es múltiplo de 5 y 7.</h3>';
    }
}
?>

</body>
</html>