"use strict"
function buscar_tapizados(){
    var d1, d2,d3, ajax, url, param, contenedor;
    contenedor = document.getElementById('tapizados1');
    d1 = document.formu.monto.value;
    d2 = document.formu.objeto.value;
    d3 = document.formu.tipo.value;
    ajax = nuevoAjax();
    url = "ajax_buscar_tapizado.php"
    param = "monto="+d1+"&objeto="+d2+"&tipo="+d3;
    //alert(param);
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    ajax.onreadystatechange = function(){
        if (ajax.readyState == 4){
            contenedor.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}