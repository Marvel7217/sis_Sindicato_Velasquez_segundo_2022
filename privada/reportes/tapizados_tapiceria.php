<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;
echo"<html>
         <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript'>
         function validar() {
            tapiceria=document.formu.tapiceria.value;
            if (document.formu.tapiceria.value== ''){
                alert('Seleccione Tapiceria');
                document.formu.tapiceria.focus();
                return;
            }
            ventanaCalendario = window.open('tapizados_tapiceria1.php?tapiceria='+tapiceria, 'calendario', 'width=600,height=550,left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO,status=NO,resizable=YES,location=NO')
        }
        </script>
    </head>
    <body>
    <a href='../../listado_tablas.php'>Listado de tablas</a>
    <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion'
    style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

    echo"<h1>REPORTES DE TAPICERIA CON TAPIZADOS</h1>
    <form method='post' name='formu'>";
    echo"<center>
    <table border='1'>
        <tr>
           <th><h3>*Seleccione tapiceria</th><th>:</th>
           <td>
              <select name='tapiceria'>
                <option value=''>Seleccione</option>
                <option value='T'>Todos</option>
                <option value='Tapiceria Mary'>Tapiceria Mary-B/Morros Blancos</option>
                <option value='Tapiceria L&M'>Tapiceria L&M-B/Juan XXIII</option>
                <option value='Tapiceria ABC'>Tapiceria ABC-B/La Loma</option>
            </select>
        </td>
    </tr>   
    <tr>
    <td align='center' colspan='6'>
        <input type='hidden' name='accion' value=''>
        <input type='button' value='Aceptar' onclick='validar();' class='boton2'>
        </td>
    </tr>
    </table>
    </form>
    </center>";

echo "</body>
</html>";
?>
