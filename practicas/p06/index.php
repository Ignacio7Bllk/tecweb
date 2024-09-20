<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 6</title>
</head>
<?php
include 'src/funciones.php';
?>
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



<h1>Ejercicio 4</h1>
<p>Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’
a la ‘z’. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para poner
el valor en cada índice. Es decir:</p>
<p>[97] => a</p>
<p>[98] => b</p>
<p>[99] => c</p>
<p>...</p>
<p>[122] => z</p>
<ul>
    <li>Crea el arreglo con un ciclo for</li>
    <li>Lee el arreglo y crea una tabla en XHTML con echo y un ciclo foreach</li>
</ul>
<p>foreach ($arreglo as $key => $value) {<br>&nbsp # code...<br>}</p>
<?php
Arreglo();
?>


</body>
</html>