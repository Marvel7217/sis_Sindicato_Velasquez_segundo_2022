"use strict"
function buscar_movil(){
    var d1, d2, d3,d4, ajax, url, param, contenedor;
    contenedor = document.getElementById('moviles1');
    d1 = document.formu.socio.value;
    d2 = document.formu.numero.value;
    d3 = document.formu.placa.value;
    d4 = document.formu.modelo.value;
    //alert(d1);
    ajax = nuevoAjax();
    url = 'ajax_buscar_movil.php'
    param = 'socio='+d1+'&numero='+d2+'&placa='+d3+'&modelo='+d4;
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