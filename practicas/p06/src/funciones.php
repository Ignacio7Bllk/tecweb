<?php
function Multiplo($num) {

if(is_numeric($num)){


    if ($num % 5 == 0 && $num % 7 == 0) {
        echo '<h3>R= El número ' . $num . ' SÍ es múltiplo de 5 y 7.</h3>';
    } else {
        echo '<h3>R= El número ' . $num . ' NO es múltiplo de 5 y 7.</h3>';
    }

}
}
?>

<?php
function GenMatriz() {
    $matriz = [];
    $iteracion = 0;

    do {
        $iteracion++;
        $fila = [rand(1, 999), rand(1, 999), rand(1, 999)];

        $matriz[] = $fila;
    } while (!($fila[0] % 2 != 0 && $fila[1] % 2 == 0 && $fila[2] % 2 != 0));

    echo "<h2>Solución:</h2>";
    foreach ($matriz as $fila) {
        echo implode(", ", $fila) . "<br>";
    }
    
    $numGen = $iteracion * 3;
    echo "<h3>$numGen números generados en $iteracion iteraciones.</h3>";
}
?>