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

</body>
</html>