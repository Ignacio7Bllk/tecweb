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


<h1>Ejercicio 2</h1>

<p>Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una
secuencia compuesta por: <b>impar</b>, <b>par</b>, <b>impar</b>.</p>

<form method="POST">
<input type="submit" name="generar" value="Generar" >
</form>
<?php
if (isset($_POST['generar'])) {
    GenMatriz();
}
?>



<h1>Ejercicio 3</h1>
<p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente,
pero que además sea múltiplo de un número dado.</p>

<ul>
    <li>Crear una variante de este script utilizando el ciclo do-while.</li>
    <li>El número dado se debe obtener vía GET.</li>
</ul>

<form method="GET">
    Ingrese el número: <input type="number" name="numero_ing">
    <input type="submit" value="Enviar">
</form>
<?php
if (isset($_GET['numero_ing'])) {
    $ni = (int)$_GET['numero_ing'];

    $mensaje = CWile($ni);
    echo "<p>$mensaje</p>";

    $mensaje2=DoWile($ni);
    echo "<p>$mensaje2</p>";
}
?>

</body>
</html>