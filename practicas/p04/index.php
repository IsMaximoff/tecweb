<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 4</title>
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

        /*--------------------------------------------------------------------------------*/
        // EJERCICIO 2 - comportamiento de variables que almacenan la referencia de otra variable"
        echo "<h2>Ejercicio 2</h2>";
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;

        echo "<p>Muestra del contenido de cada variable</p>";
        echo "\$a = $a <br>";
        echo "\$b = $b <br>";
        echo "\$c = $c <br>";

        /// Modificacion de las variables originales (punto b)
        $a = "PHP server";
        $b = &$a;
        
        echo "<p>Muestra del contenido de cada variable con las asignaciones extra</p>";
        echo "\$a = $a <br>";
        echo "\$b = $b <br>";
        echo "\$c = $c <br>";

        echo '<h4>Explicación:</h4>';
        echo "<p>Al modificar el valor de \$a, indirectamente modificamos también el valor de \$c, ya que esta variable contiene la referencia de a. Esto mismo sucede con la variable \$b. Entonces como las variables \$b y \$c son referencias de a, terminan mostrando el mismo contenido que \$a</p>";
        /*--------------------------------------------------------------------------------*/
        // EJERCICIO 3 -
        echo "<h2>Ejercicio 3</h2>";
        echo "<p>Muestra el contenido de cada variable inmediatamente después de cada aasignación, verificar la evolución de tipo de estas variables (imprime todos los componentes del arreglo):</p>";

        $a = "PHP5";
        echo "\$a = $a <br>";
        
        $z[] = &$a;
        echo "\$z = ";
        print_r($z);
        echo "<br>";
        
        $b = "5a version de PHP";
        echo "\$b = $b";
        echo "<br>";

        @$c = $b * 10;
        echo "\$c = $c";
        echo "<br>";

        $a .= $b;
        echo "\$a = $a";
        echo "<br>";
        
        @$b *= $c;
        echo "\$b = $b";
        echo "<br>";

        $z[0] = "MySQL";
        echo "\$z = ";
        print_r($z);
        echo "<br>";
    ?>
</body>
</html>