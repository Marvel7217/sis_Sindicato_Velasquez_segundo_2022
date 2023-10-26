<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;
echo"<html>
         <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript'>
         function validar() {
            cliente=document.formu.cliente.value;
            if (document.formu.cliente.value== ''){
                alert('Seleccione Cliente');
                document.formu.cliente.focus();
                return;
            }
            ventanaCalendario = window.open('movilidades_clientes1.php?cliente='+cliente, 'calendario', 'width=600,height=550,left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO,status=NO,resizable=YES,location=NO')
        }
        </script>
    </head>
    <body>
    <a href='../../listado_tablas.php'>Listado de tablas</a>
    <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion'
    style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

    echo"<h1>REPORTES DE CLIENTE CON MOVILIDADES</h1>
    <form method='post' name='formu'>";
    echo"<center>
    <table border='1'>
        <tr>
           <th><h3>*Seleccione cliente</th><th>:</th>
           <td>
              <select name='cliente'>
                <option value=''>Seleccione</option>
                <option value='T'>Todo</option>
                <option value='jose luis'>jose luis</option>
                <option value='jose carlos'>jose carlos</option>
                <option value='exel moises'>exel moises</option>
                <option value='efrain'>efrain</option>
                <option value='gonzalo'>gonzalo</option>
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
