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



/*function getDatos()
{
    var nombre = prompt("Nombre: ", "");

    var edad = prompt("Edad: ", 0);

    var div1 = document.getElementById('nombre');
    div1.innerHTML = '<h3> Nombre: '+nombre+'</h3>';

    var div2 = document.getElementById('edad');
    div2.innerHTML = '<h3> Edad: '+edad+'</h3>';
}*/