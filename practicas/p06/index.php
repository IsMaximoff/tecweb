<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 6</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php include 'src/funciones.php'; ?>
    
    <h2>Ejercicio 2</h2>
    <p>Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una
    secuencia compuesta por: impar, par, impar <br> Estos números deben almacenarse en una matriz de Mx3, donde M es el número de filas y
    3 el número de columnas. Al final muestra el número de iteraciones y la cantidad de
    números generados:</p>
    <?php
        secuenciaImparParImpar();
    ?>

    <h2>Ejercicio 3</h2>
    <p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente,
    pero que además sea múltiplo de un número dado. <br> Consideraciones: <br>Crear una variante de este script utilizando el ciclo do-while. <br> El número dado se debe obtener vía GET.</p>
    <?php
        multiplo_While();
        multiplo_DoWhile();
    ?>

    <h2>Ejercicio 4</h2>
    <p>Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’ a la ‘z’. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para poner
        el valor en cada índice.</p>
    <?php
        ASCII_Caracteres();
    ?>

    <h2>Ejercicio 5</h2>
    <p>Identificar una persona de sexo "femenino" cuya edad oscile entre los 18 y 35 años.</p>
    <form action="index.php" method="POST">
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" min="0" required /><br /><br />

        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" required>
            <option value="">Seleccione...</option>
            <option value="femenino">Femenino</option>
            <option value="masculino">Masculino</option>
        </select><br /><br />

        <button type="submit">Verificar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        verificarEdadSexo();
    }
    ?>

</body>
</html>