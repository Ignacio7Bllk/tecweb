/*function getDatos(){
    var nombre = prompt("Ingrese su nombre");
    var edad = prompt("Ingrese su edad");

    var div1 = document.getElementById("nombre");
    div1.innerHTML = '<h3>Nombre: ' + nombre + '</h3>';

    var div2 = document.getElementById("edad");
    div2.innerHTML = '<h3>Edad: ' + edad + '</h3>';
}
*/

function ejercicio1(){
    var ejercicio1 = document.getElementById("ejercicio1");
    ejercicio1.innerHTML = '<h3>Hola mundo</h3>';

}

function ejercicio2(){
    var nombre = "Ignacio";
    var edad = 20;
    var altura = 1.80;
    var estado = false;

    var div1 = document.getElementById("ejercicio2");
    div1.innerHTML = '<ul>' +
                        '<li>Nombre: ' + nombre + '</li>' +
                        '<li>Edad: ' + edad + '</li>' +
                        '<li>Altura: ' + altura + '</li>' +
                        '<li>Estado: ' + estado + '</li>' +
                    '</ul>';
}

function ejercicio3(){
    var nombre = prompt("Ingrese su nombre");
    var edad = prompt("Ingrese su edad");
    var div1 = document.getElementById("ejercicio3");
    div1.innerHTML = '<p>Hola ' + nombre + ' asi que tienes ' + edad + ' años </p>';
}
