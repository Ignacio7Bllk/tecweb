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


function ejercicio4(){
    var valor1 = parseInt(prompt("Ingrese el primer valor"));
    var valor2 = parseInt(prompt("Ingrese el segundo valor"));
    var suma = valor1 + valor2;
    var producto = valor1 * valor2;
    
    var div1 = document.getElementById("ejercicio4");
    div1.innerHTML ='La suma de '+valor1+' + '+valor2+' es igual a '+suma+'<br>El producto de '+valor1+' * '+valor2+' es igual a '+producto;

}


function ejercicio5(){
    var nombre=prompt("Ingrese su nombre:’, ‘");
    var nota=prompt("Ingrese su nota: ");

    if(nota >=4){
        // Obtiene el elemento HTML con el id "ejercicio5" y lo asigna a la variable div1
        var div1=document.getElementById("ejercicio5");
        // Modifica el contenido de div1
        div1.innerHTML='<p>'+nombre+' ha aprobado con una nota de '+nota+'</p>';

    }


}

function ejercicio6(){
    var num1, num2;
    num1 = prompt("Ingrese el primer número");
    num2 = prompt("Ingrese el segundo número");
    num1 =parseInt(num1);
    num2 =parseInt(num2);

    var div1 = document.getElementById("ejercicio6");
    if(num1>num2){
        div1.innerHTML='<p>El mayor es '+ num1 +' </p>';
    }else{
        div1.innerHTML='<p>El mayor es '+ num2 +' </p>';
    }
}

function ejercicio7(){

    var nota1, nota2, nota3;
    nota1 = prompt("Ingrese la nota 1: ");
    nota2 = prompt ("Ingrese la nota 2: ");
    nota3 = prompt ("Ingrese la nota 3: ");

    nota1=parseInt (nota1);
    nota2=parseInt (nota2);
    nota3=parseInt (nota3);

    var pro;
    pro=(nota1+nota2+nota3)/3;

    var div1 = document.getElementById("ejercicio7");
    if (pro>=7){
        div1.innerHTML='<p>aprobado</p>'
    }else{
        if(pro>=4){
            div1.innerHTML='<p>regular</p>'
        }else{
            div1.innerHTML='<p>reprobado</p>'
        }
    }

}

function ejercicio8(){
    var valor;
    valor = prompt("Ingrese un número comprendido entre 1 y 5: ");
    valor=parseInt(valor);

    var div1 = document.getElementById("ejercicio8");
    
    switch (valor) {
        case 1:
            div1.innerHTML='<p>uno</p>';
            break;
        case 2:
            div1.innerHTML='<p>dos</p>';
            break;
        case 3:
            div1.innerHTML='<p>tres</p>';
            break;
        case 4:
            div1.innerHTML='<p>cuatro</p>';
            break;
        case 5:
            div1.innerHTML='<p>cinco</p>';
            break;
        default:
            div1.innerHTML='<p>debe ingresar un valor comprendido entre 1 y 5</p>';
            break;
    }
}


function ejercicio9(){
    var col;
    col = prompt("Ingrese un color para pintar el fondo de la página: (rojo, verde, azul)");

    var div1 = document.getElementById("ejercicio9");
    div1.style.width = "100%";
    div1.style.height = "100vh"; 

    switch(col){
        case "rojo":
            div1.style.backgroundColor = '#FF0000';
            break;
        case "verde":
            div1.style.backgroundColor = '#00FF00';
            break;
        case "azul":
            div1.style.backgroundColor = '#0000FF';
            break;
        default:
            div1.innerHTML='<p>Debe ingresar un color válido</p>';
            break;
    }
}

function ejercicio10(){
    var x;
    x=50;
    var resultado="";
    var div1 = document.getElementById("ejercicio10");
    while(x<=100){
        resultado="<p>"+resultado+x+"<br></p>";
        x=x+1;
    }
    div1.innerHTML=resultado;
}

function ejercicio11(){
    var x = 1;
    var suma = 0;
    var valor;
    while (x <= 5) {
        valor = prompt("Ingresar el valor: ");
        valor = parseInt(valor);
        suma = suma + valor;
        x = x + 1;
    }
    var div1 = document.getElementById("ejercicio11");
    div1.innerHTML = "<p>La suma de los valores es " + suma + "<br></p>";
}

function ejercicio12(){
    var valor;
    var div1 = document.getElementById("ejercicio12"); 
    var resultado = ""; 
    do {
        valor = prompt("Ingresa un valor entre 0 y 999:");
        valor = parseInt(valor);
        if (valor === 0) break;
        resultado += "<p>El valor " + valor + " tiene ";
        if (valor < 10) {
            resultado += "1 dígito";
        } else if (valor < 100) {
            resultado += "2 dígitos";
        } else {
            resultado += "3 dígitos";
        }
        resultado += "</p>"; 
    } while (valor != 0);
    div1.innerHTML = resultado;
}

function ejercicio13(){
    var f;
    var resultado='';
    var div1 = document.getElementById('ejercicio13');
    div1.innerHTML='<p>';
    for(f=1;f<=20;f++){
        resultado=resultado+f+' ';
    }
    div1.innerHTML+=resultado+'</p>';
}

/************************************** */
function ejercicio14(){
    var div1 =document.getElementById('ejercicio14');
    div1.innerHTML='<p>Cuidado<br>Ingresa tu documento correctamente</p>';
    div1.innerHTML+='<p>Cuidado<br>Ingresa tu documento correctamente</p>';
    div1.innerHTML+='<p>Cuidado<br>Ingresa tu documento correctamente</p>';
}

function ejercicio15(){
    function mostrarMensaje(){
        var div1 =document.getElementById('ejercicio15');
        div1.innerHTML+='<p>Cuidado<br>Ingresa2 tu documento correctamente</p>';
    }
    mostrarMensaje();
    mostrarMensaje();
    mostrarMensaje();
}

function ejercicio16(){
    var div1 =document.getElementById('ejercicio16');
    var resultado='';
    function mostrarRango(x1,x2){
        var inicio;
        for(inicio=x1;inicio<=x2;inicio++){
            resultado+=inicio+' ';
        }
    }
    var valor1,valor2;
    valor1=prompt('Ingresar el valor inferior: ','');
    valor1=parseInt(valor1);
    valor2=prompt('Ingresar el valor superior: ','');
    valor2=parseInt(valor2);
    mostrarRango(valor1,valor2);
    div1.innerHTML='<p>'+resultado+'</p>';
}

function ejercicio17(){
    function convertirCastellano(x){
        if(x==1){
            return "uno";
        }else if(x==2){
            return "dos";
        }else if(x==3){
            return "tres";
        }else if(x==4){
            return "cuatro";
        }else if(x==5){
            return "cinco";
        }else{
            return "valor incorrecto";
        }
    }
    var valor;
    valor=prompt('Ingresa un valor entre 1 y 5','');
    var r=convertirCastellano(valor);
    var div1=document.getElementById('ejercicio17');
    div1.innerHTML='<p>'+r+'</p>';
}

function ejercicio18(){
    function convertirCastellano(x){
        switch(x){
            case 1:return "uno";
            case 2:return "dos";
            case 3:return "tres";
            case 4:return "cuatro";
            case 5:return "cinco";
            default: return "valor incorrecto";
        }
    }
    var valor;
    valor=prompt('Ingresa un valor entre 1 y 5','');
    valor=parseInt(valor);
    var r=convertirCastellano(valor);
    var div1=document.getElementById('ejercicio18');
    div1.innerHTML='<p>'+r+'</p>';
}