function ejemplo_1(){
    document.getElementById("ejemplo_1").innerText = "Hola Mundo"; 
}

function ejemplo_2(){
    let nombre = 'Juan';
    let edad = 10;
    let altura = 1.92;
    let casado = false;

    let resultado = `${nombre}<br>${edad}<br>${altura}<br>${casado}`;
    document.getElementById("ejemplo_2").innerHTML = resultado;
}

function ejemplo_3() {
    let nombre = prompt("Ingresa tu nombre:", "");
    let edad = prompt("Ingresa tu edad:", "");

    let resultado = `Hola ${nombre}, así que tienes ${edad} años.`;
    document.getElementById("ejemplo_3").innerHTML = resultado;
}

function ejemplo_4() {
    let valor1 = prompt("Introducir primer número:", "");
    let valor2 = prompt("Introducir segundo número:", "");

    let num1 = parseInt(valor1);
    let num2 = parseInt(valor2);

    if (isNaN(num1) || isNaN(num2)) {
        alert ("Por favor, ingresa valores numéricos válidos.");
        return;
    }

    let suma = num1 + num2;
    let producto = num1 * num2;

    let resultado = `La suma es ${suma} <br> El producto es ${producto}`;
    document.getElementById("ejemplo_4").innerHTML = resultado;
}

function ejemplo_5() {
    let nombre = prompt("Ingresa tu nombre:", "");
    let nota = prompt("Ingresa tu nota", "");

    let notaNum = parseFloat(nota);

    let resultado = "";
    if (notaNum >= 4) {
        resultado = `${nombre} está probado con un ${notaNum}`;
    } else {
        resultado = `${nombre} no ha aprobado. Su nota es ${notaNum}`;
    }

    document.getElementById("ejemplo_5").innerHTML = resultado;
}

function ejemplo_6() {
    var num1 = prompt("Ingresa el primer número:", "");
    var num2 = prompt("Ingresa el segundo número", "");

    num1 = parseInt(num1);
    num2 = parseInt(num2);

    let resultado = "";
    if (num1 > num2) {
        resultado = `El mayor es ${num1}`;
    } else {
        resultado = `El mayor es ${num2}`;
    }
    document.getElementById("ejemplo_6").innerHTML = resultado;
}

function ejemplo_7() {
    var nota1 = prompt("Ingresa 1ra nota:", "");
    var nota2 = prompt("Ingresa 2da nota:", "");
    var nota3 = prompt("Ingresa 3ra nota:", "");

    nota1 = parseInt(nota1);
    nota2 = parseInt(nota2);
    nota3 = parseInt(nota3);

    var promedio = (nota1 + nota2 + nota3) / 3;

    var resultado = "";
    if (promedio >= 7) {
        resultado = 'Aprobado';
    } else if (promedio >=4) {
        resultado = 'Regular';
    } else {
        resultado = 'Reprobado';
    }

    document.getElementById("ejemplo_7").innerHTML = "Promedio: " + promedio + ", Resultado: " + resultado;
}

function ejemplo_8() {
    var valor = prompt("Ingresa un valor comprendido entre 1 y 5:", "");
    valor = parseInt(valor);

    var resultado = "";
    switch (valor) {
        case 1:
            resultado = "uno";
            break;
        case 2:
            resultado = "dos";
            break;
        case 3:
            resultado = "tres";
            break;
        case 4:
            resultado = "cuatro";
            break;
        case 5:
            resultado = "cinco";
            break;
        default:
            resultado = "Debe ingresar un valor comprendido entre 1 y 5.";
    }

    document.getElementById("ejemplo_8").innerHTML = resultado;
}

function ejemplo_9() {
    var color = prompt("Ingresa el color con que quieres pintar el fondo de la ventana (rojo, verde, azul)", "");

    switch (color.toLowerCase()) {
        case 'rojo':
            document.bgColor = '#ff0000';
            break;
        case 'verde':
            document.bgColor = '#00ff00';
            break;
        case 'azul':
            document.bgColor = '#0000ff';
            break;
        default:
            document.getElementById("ejemplo_9").innerHTML = "Color no válido";
            return;
    }

    document.getElementById("ejemplo_9").innerHTML = "El fondo ha cambiado a " + color + ".";
}

function ejemplo_10() {
    var x = 1;
    var suma = 0;
    var valor;

    while (x <= 5) {
        valor = prompt('Ingresa el valor:', '');
        valor = parseInt(valor);

        suma = suma + valor;
        x = x + 1;
    }

    document.getElementById("ejemplo_10").innerHTML = "La suma de los valores es: " + suma + ".";
}

function ejemplo_11() {
    var x = 1;

    while (x <= 100) {
        document.write(x + '<br>');
        x += 1;
    }
}

function ejemplo_12() {
    var valor;

    do {
        valor = prompt("Ingresa un valor entre 0 y 999:", "");
        valor = parseInt(valor);

        document.write("El valor " + valor + " tiene ");

        if (valor < 10 ) {
            document.write("Tiene 1 dígito.");
        } else if (valor < 100) {
            document.write("Tiene 2 dígitos.");
        }else {
            document.write("Tiene 3 dígito.");
        }

        document.write("<br>");
    } while (valor != 0);
}


/*function getDatos()
{
    var nombre = prompt("Nombre: ", "");

    var edad = prompt("Edad: ", 0);

    var div1 = document.getElementById('nombre');
    div1.innerHTML = '<h3> Nombre: '+nombre+'</h3>';

    var div2 = document.getElementById('edad');
    div2.innerHTML = '<h3> Edad: '+edad+'</h3>';
}*/