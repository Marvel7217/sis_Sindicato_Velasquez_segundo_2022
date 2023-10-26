"use strict"
function mostrar(id_tapizado){
    var d1,ventanaCalendario;
    d1=id_tapizado;
    //alert(id_persona);
    ventanaCalendario=window.open("ficha_tec_tapizados1.php?id_tapizado=" + d1 , "calendario", "width=600, height=550,left=100,top=100,scrollbars=yes,menubars=no,statubar=NO,status=NO,resizable=YES,location=NO")
}