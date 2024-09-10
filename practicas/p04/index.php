<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
    ?>

    
    <h2>Ejercicio 2</h2>
    <h4>Proporcionar los valores de $a, $b, $c como sigue:</h4>
    <p>$a = “ManejadorSQL”;<br>
        $b = 'MySQL’;<br>
        $c = &$a;</p>

    
        <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c =&$a;


echo'<h4>a. Ahora muestra el contenido de cada variable</h4>';


echo'varible $a= '.$a .'<br>';
echo 'Variable $b= '.$b.'<br>';
echo 'variable $c= '.$c.'<br>';


echo'<h4>b. Agrega al código actual las siguientes asignaciones:</h4>';
echo'<p>$a = “PHP server”; <br> $b = &$a;</p>';

$a= "PHP server";
$b=&$a;

echo'<h4>c. Vuelve a mostrar el contenido de cada uno</h4>';
echo'Variable $a= '.$a.'<br>';
echo 'variable $b= '.$b.'<br>';
echo 'variable$c= '.$c.'<br>';

//Descripcion
echo'<h4>d. Describe en y muestra en la página obtenida qué ocurrió en el segundo bloque de
asignaciones</h4>';

echo'$a se cambia a "PHP server". Esto actualiza el valor de $a y también
afecta a $b porque $b se asigna por referencia a $a. Entonces, $b ahora muestra
"PHP server" junto con $c que tambien mustra "PHP server" .';
unset($a,$b,$c);
?>

<h2>
    Ejercicio 3
</h2>
<h4>Muestra el contenido de cada variable inmediatamente después de cada asignación,
verificar la evolución del tipo de estas variables (imprime todos los componentes de los
arreglo)</h4>

<?php
echo'$a = “PHP5”;<br>';
$a="PHP5 ";
echo'Variable $a= '.$a.'<br><br>';


echo'$z[]=&$a;<br>';
$z[]=&$a;
echo 'Variable $z= ';
print_r($z);
echo'<br><br>';

echo'$b = “5a version de PHP ”;<br>';
$b = "5a version de PHP";
echo 'Variable $b= '.$b.'<br><br>';


echo'$c = $b*10;<br>';
$x = intval($b);  
$c = $x * 10;
echo 'Variavle $c= ';
print_r($c);
echo '<br><br>';

echo'$a .= $b; <br>';
$a .= $b;
echo'variable $a= '.$a.'<br><br>';
/*
echo'$b *= $c;<br>';
$b *= $c;
*/

echo '$z[0] = "MySQL"<br>';
$z[0] = "MySQL";
echo 'Variable $z= ';
print_r($z);
?>

<h2>Ejercicio 4</h2>
<h4>
Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de
la matriz $GLOBALS o del modificador global de PHP.
</h4>
<?php


function MVariables() {
    global $a, $z, $b;
    echo 'Variable $a= : '.$a.'<br>';
    echo 'Variable $b=: '.$b.'<br>';
    
    echo 'Variable $z= : ';
    print_r($z);
}
MVariables();
unset($a,$b,$z);
?>


</body>
</html>