"use strict"
function mostrar(id_persona_1){
    var d1,ventanaCalendario;
    d1=id_persona_1;
    //alert(id_persona);
    ventanaCalendario=window.open("ficha_tec_personas1.php?id_persona_1=" + d1 , "calendario", "width=600, height=550,left=100,top=100,scrollbars=yes,menubars=no,statubar=NO,status=NO,resizable=YES,location=NO")
}