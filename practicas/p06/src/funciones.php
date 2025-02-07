<?php
    if(isset($_GET['numero']))
    {
        $num = $_GET['numero'];
        if ($num%5==0 && $num%7==0)
        {
            echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
        }
        else
        {
            echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
        }
    }
?>


<?php
/*EJERCICIO 2 --------------------------------------------------------------------------------------------------------------*/
    function secuenciaImparParImpar()
    {
        $matriz = array();
        $iteraciones = 0;
        $numGenerados = 0;
        $secuenciaImparParImpar = false;

        do {
            $fila = array();
            
            for ($i = 0; $i < 3; $i++) {
                $numeroRandom = rand(1, 1000);
                $fila[] = $numeroRandom;
            }

            $matriz[] = $fila;
            $iteraciones++;
            $numGenerados += 3;
            
            if( ($fila[0] %2 != 0) && ($fila[1] %2 == 0) && ($fila[2] %2 != 0) ) {
                $secuenciaImparParImpar = true;
            }

        } while (!$secuenciaImparParImpar);

        echo "<h3> Matriz </h3>";
        foreach ($matriz as $fila) {
            echo implode(", ", $fila) . "<br>";
        }

        echo "<p>$numGenerados números obtenidos en $iteraciones iteraciones </p>";
    }
?>
