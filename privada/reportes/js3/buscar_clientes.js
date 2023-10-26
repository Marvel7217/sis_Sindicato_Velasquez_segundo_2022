"use strict"
function buscar_clientes(){
    var d1, d2,d3, ajax, url, param, contenedor;
    contenedor = document.getElementById('cliente1');
    d1 = document.formu.cliente.value;
    d2 = document.formu.placa.value;
    d3 = document.formu.color.value;
    ajax = nuevoAjax();
    url = "ajax_buscar_movilidades.php"
    param = "cliente="+d1+"&placa="+d2+"&color="+d3;
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