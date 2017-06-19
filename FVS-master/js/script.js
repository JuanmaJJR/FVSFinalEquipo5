// JavaScript source code
var xmlhttp = new XMLHttpRequest();
var xmlhttp2 = new XMLHttpRequest();
var url = "js/php.php";
var url2 = "js/jsongeneral.json";
var myArr;
var arrayG;
var select1,select2,select3,select4,select5;
var titulo1,titulo2,titulo3,titulo4,titulo5;
var formRespuesta;

xmlhttp2.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var documentJson2 = JSON.parse(this.responseText);
        arrayG = documentJson2;
        myFunction(myArr["formulario"],arrayG["formulario"]);        
    }
}

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var documentJson = JSON.parse(this.responseText);
        myArr = documentJson;
        xmlhttp2.open("GET", url2, true);
        xmlhttp2.send();
    }
}
xmlhttp.open("GET", url, true);
xmlhttp.send();





function myFunction(arr,arrG) {

    var contenido = document.getElementById("box-container");
    formRespuesta = document.createElement("form");
    formRespuesta.setAttribute("action", "js/insert.php");
    formRespuesta.setAttribute("method","post");
    contenido.appendChild(formRespuesta);
	
    select1 = document.createElement("div");
    select1.setAttribute("id","g");
    titulo1 = document.createElement("h2");
    titulo1.setAttribute("id","general");
    var nodo1 = document.createTextNode("General");
    titulo1.appendChild(nodo1);
    select1.appendChild(titulo1);

    select2 = document.createElement("div");
    select2.setAttribute("id","e");
    titulo2 = document.createElement("h2");
    titulo2.setAttribute("id","energia");
    var nodo2 = document.createTextNode("Energía");
    titulo2.appendChild(nodo2);
    select2.appendChild(titulo2);

    select3 = document.createElement("div");
    select3.setAttribute("id","t");
    titulo3 = document.createElement("h2");
    titulo3.setAttribute("id","transporte");
    var nodo3 = document.createTextNode("Transporte");
    titulo3.appendChild(nodo3);
    select3.appendChild(titulo3);

    select4 = document.createElement("div");
    select4.setAttribute("id","a");
    titulo4 = document.createElement("h2");
    titulo4.setAttribute("id","agua");
    var nodo4 = document.createTextNode("Agua");
    titulo4.appendChild(nodo4);
    select4.appendChild(titulo4);


    select5 = document.createElement("div");
    select5.setAttribute("id","m");
    titulo5 = document.createElement("h2");
    titulo5.setAttribute("id","materiales");
    var nodo5 = document.createTextNode("Materiales");
    titulo5.appendChild(nodo5);
    select5.appendChild(titulo5);

    cargarDatos(arr,arrG);
}

function cargarDatos(arr,arrG) {
    for (i = 0; i < arrG.length; i++) {
        var divPregunta = document.createElement("div");
        divPregunta.setAttribute("class", "preguntas");
        select1.appendChild(divPregunta);
            titulo1.style.display = "flex";
            formRespuesta.appendChild(select1);
            var pPregunta = document.createElement("p");
            divPregunta.appendChild(pPregunta)
            var nodoPregunta = document.createTextNode(arrG[i].textopregunta);
            pPregunta.appendChild(nodoPregunta);
            var divRespuestas = document.createElement("div");
            divRespuestas.setAttribute("class", "respuestas");
            var sep = document.createElement("hr");
            divPregunta.appendChild(sep);
            for (var xd = 0; xd < arrG[i].respuesta.length; xd++) {
                var nombre = i + "-" + xd;
                if(arrG[i].respuestamultiple == "radio"){
                    var inputRespuesta = document.createElement("input");
                    inputRespuesta.setAttribute("type", "radio");
                    inputRespuesta.setAttribute("id",nombre);
                } else {
                    var inputRespuesta = document.createElement("input");
                    inputRespuesta.setAttribute("type", "checkbox");
                    inputRespuesta.setAttribute("id",nombre);
                }
                inputRespuesta.setAttribute("name", arrG[i].idpregunta);
                inputRespuesta.setAttribute("value", arrG[i].respuesta[xd].idrespuesta);
                var label = document.createElement("label");
                label.setAttribute("for",nombre);
                inputRespuesta.setAttribute("onchange","mostrarGeneral("+arrG[i].respuesta[xd].idrespuesta + "," + arrG[i].idpregunta + ")");
                var labelText = document.createTextNode(arrG[i].respuesta[xd].textorespuesta);
                label.appendChild(labelText);
                label.innerHTML += "<br>";
                divRespuestas.appendChild(inputRespuesta);
                divRespuestas.appendChild(label);  
            }

            if(arrG[i].dependiente == null ) {
                    divPregunta.style.display = "flex";
                    divPregunta.setAttribute("id",arrG[i].idpregunta);
            } else {
                divPregunta.setAttribute("class","preguntas dependiente");
                divPregunta.setAttribute("id",arrG[i].idpregunta);
            }
            divPregunta.appendChild(divRespuestas);
    }
    for (i = 0; i < arr.length; i++) {
        var divPregunta = document.createElement("div");
        divPregunta.setAttribute("class", "preguntas");
            if(arr[i].categoria == "Energia") {
                select2.appendChild(divPregunta);
                titulo2.style.display = "flex";
                formRespuesta.appendChild(select2);
            } else if(arr[i].categoria == "Transporte"){
                select3.appendChild(divPregunta);
                titulo3.style.display = "flex";
                formRespuesta.appendChild(select3);
            } else if(arr[i].categoria == "Agua"){
                select4.appendChild(divPregunta);
                titulo4.style.display = "flex";
                formRespuesta.appendChild(select4);
            } else if(arr[i].categoria == "Materiales"){
                select5.appendChild(divPregunta);
                titulo5.style.display = "flex";
                formRespuesta.appendChild(select5);
            }
            var pPregunta = document.createElement("p");
            divPregunta.appendChild(pPregunta)
            var nodoPregunta = document.createTextNode(arr[i].textopregunta);
            pPregunta.appendChild(nodoPregunta);
            var divRespuestas = document.createElement("div");
            divRespuestas.setAttribute("class", "respuestas");
            var sep = document.createElement("hr");
            divPregunta.appendChild(sep);
            var count = 10000;
            for (var xd = 0; xd < arr[i].respuesta.length; xd++) {
                var nombre = i + "-" + count;
                if(arr[i].respuestamultiple == "radio"){
                    var inputRespuesta = document.createElement("input");
                    inputRespuesta.setAttribute("type", "radio");
                    inputRespuesta.setAttribute("id",nombre);
                } else {
                    var inputRespuesta = document.createElement("input");
                    inputRespuesta.setAttribute("type", "checkbox");
                    inputRespuesta.setAttribute("id",nombre);
                }
                inputRespuesta.setAttribute("name", arr[i].idpregunta);
                inputRespuesta.setAttribute("value", arr[i].respuesta[xd].idrespuesta);
                var label = document.createElement("label");
                label.setAttribute("for",nombre);
                inputRespuesta.setAttribute("onchange","mostrar("+arr[i].respuesta[xd].idrespuesta + "," + arr[i].idpregunta + ")");
                var labelText = document.createTextNode(arr[i].respuesta[xd].textorespuesta);
                label.appendChild(labelText);
                label.innerHTML += "<br>";
                divRespuestas.appendChild(inputRespuesta);
                divRespuestas.appendChild(label);  
                count++;
            }

            if(arr[i].dependiente == null ) {
                    divPregunta.style.display = "flex";
                    divPregunta.setAttribute("id",arr[i].idpregunta);
            } else {
                divPregunta.setAttribute("class","preguntas dependiente");
                divPregunta.setAttribute("id",arr[i].idpregunta);
            }
            divPregunta.appendChild(divRespuestas);    
    }
    var divBoton = document.createElement("div");
    divBoton.setAttribute("id","divBoton");
    var boton = document.createElement("input");
    boton.setAttribute("type","submit");
    boton.setAttribute("value","Enviar");
    boton.setAttribute("id","botonFormulario");
    divBoton.appendChild(boton);
    formRespuesta.appendChild(divBoton);
}


function mostrar(id,preg){
    var array = myArr["dependencias"];
    
    for(i = 0 ; i < array.length ; i++) {
         if(array[i].idDepende == id && array[i].idPregunta != preg) {
            document.getElementById(array[i].idPregunta).style.display = "flex";
        } else if(array[i].idDepende != id && preg == array[i].idPreguntaDepende){
            document.getElementById(array[i].idPregunta).style.display = "none";
        }  
    } 
}   

function mostrarGeneral(id,preg){
    var array = arrayG["dependencias"];
    
    for(i = 0 ; i < array.length ; i++) {
         if(array[i].idDepende == id && array[i].idPregunta != preg) {
            document.getElementById(array[i].idPregunta).style.display = "flex";
        } else if(array[i].idDepende != id && preg == array[i].idPreguntaDepende){
            document.getElementById(array[i].idPregunta).style.display = "none";
        }  
    } 
}