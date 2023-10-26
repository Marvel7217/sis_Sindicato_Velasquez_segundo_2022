"use strict"
function buscar_asociacion(){
    var d1, d2, d3, ajax, url, param, contenedor;
    contenedor = document.getElementById('asociacion1');
    d1 = document.formu.asociacion.value;
    d2 = document.formu.instrumento.value;
    d3 = document.formu.codigo.value;
    //alert(d2);
    ajax = nuevoAjax();
    url = 'ajax_buscar_asociacion.php'
    param = 'asociacion='+d1+'&instrumento'+d2+'&codigo='+d3;
    //alert(param)
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4){
            contenedor.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}