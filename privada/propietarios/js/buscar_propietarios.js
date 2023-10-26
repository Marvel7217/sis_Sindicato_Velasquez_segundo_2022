"use strict"
function buscar_propietarios(){
    var d1, d2,d3, d4, ajax, url, param, contenedor;
    contenedor = document.getElementById('propietarios1');
    d1 = document.formu.paterno.value;
    d2 = document.formu.nombre.value;
    d3 = document.formu.direccion.value;
    d4 = document.formu.ci.value;
    ajax = nuevoAjax();
    url = "ajax_buscar_propietario.php"
    param = "paterno="+d1+"&nombre="+d2+"&direccion="+d3+"&ci="+d4;
   // alet(param);
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    ajax.onreadystatechange = function(){
        if (ajax.readyState == 4){
            contenedor.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}