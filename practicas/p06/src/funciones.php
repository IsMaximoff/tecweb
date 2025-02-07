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

<?php
/*EJERCICIO 3 --------------------------------------------------------------------------------------------------------------*/
    function multiplo_While()
    {
        $divisor = (int) $_GET['numero'];
        $iteracion = 0;
        $numeroRand = rand(1, 1000);

        while($numeroRand % $divisor !== 0) {
            $iteracion++;
            $numeroRand = rand(1, 1000);
        }
        $iteracion++;
        echo "<p>USANDO WHILE: Se encontró el número random $numeroRand como divisor de $divisor en $iteracion iteraciones</p>";
        
    }

    function multiplo_DoWhile()
    {
        $divisor = (int) $_GET['numero'];
        $iteracion = 0;

        do{
            $numeroRand = rand(1, 1000);
            $iteracion++;
        }while($numeroRand % $divisor !== 0);

        $iteracion++;
        echo "<p>USANDO DO-WHILE: Se encontró el número random $numeroRand como divisor de $divisor en $iteracion iteraciones</p>";
        
    }
?>

<?php
/*EJERCICIO 4 --------------------------------------------------------------------------------------------------------------*/
    function ASCII_Caracteres() {
        $arreglo = array();
        for ($i = 97; $i <= 122; $i++) {
            $arreglo[$i] = chr($i);
        }

        echo "<table border = '1' cellspacing = '0' cellpading = '5'>"; 
        echo "<tr> <th>ASCII</th> <th>Caracter</th> </tr>";

        foreach($arreglo as $key => $value) {
            echo "<tr>";
            echo "<td>$key</td>";
            echo "<td>$value</td>";
            echo "</tr>";
        }

        echo "</table>";
    }    
?>

<?php
// Verifica si el formulario fue enviado vía POST.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Se obtienen los datos enviados desde el formulario.
    $edad = isset($_POST['edad']) ? (int) $_POST['edad'] : 0;
    $sexo = isset($_POST['sexo']) ? trim($_POST['sexo']) : "";

    // Verifica que se haya ingresado el sexo y la edad.
    if ($sexo === "" || $edad === 0) {
        $mensaje = "Por favor, ingrese datos válidos.";
    } else {
        // Evaluar si es una mujer (femenino) en el rango de edad 18 a 35.
        if ($sexo === "femenino" && $edad >= 18 && $edad <= 35) {
            $mensaje = "Bienvenida, usted está en el rango de edad permitido.";
        } else {
            $mensaje = "Lo siento, usted no cumple con los requisitos de edad o sexo.";
        }
    }

    // Generar la respuesta XHTML.
    // IMPORTANTE: En documentos XHTML, se recomienda incluir la declaración XML y el DOCTYPE.
    echo '<?xml version="1.0" encoding="UTF-8"?>'; 
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
      "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
        <title>Respuesta</title>
      </head>
      <body>
        <h2>Resultado</h2>
        <p><?php echo $mensaje; ?></p>
      </body>
    </html>
    <?php
    exit(); // Finaliza la ejecución, ya que ya se mostró la respuesta.
}
?>

<?php
/*EJERCICIO 4 --------------------------------------------------------------------------------------------------------------*/
?>