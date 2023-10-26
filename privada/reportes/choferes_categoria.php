<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;
echo"<html>
         <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript'>
         function validar() {
            categoria=document.formu.categoria.value;
            if (document.formu.categoria.value== ''){
                alert('Seleccione el chofer');
                document.formu.categoria.focus();
                return;
            }
            ventanaCalendario = window.open('choferes_categoria1.php?categoria='+categoria, 'calendario', 'width=600,height=550,left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO,status=NO,resizable=YES,location=NO')
        }
        </script>
    </head>
    <body>
    <a href='../../listado_tablas.php'>Listado de tablas</a>
    <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion'
    style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

    echo"<h1>REPORTES DE CHOFERES CON CATEGORIA DE LICENCIA</h1>
    <form method='post' name='formu'>";
    echo"<center>
    <table border='1'>
        <tr>
           <th><h3>*Seleccione categoria</th><th>:</th>
           <td>
              <select name='categoria'>
                <option value=''>Seleccione</option>
                <option value='T'>Todos</option>
                <option value='A'>Categoria A</option>
                <option value='B'>Categoria B</option>
                <option value='C'>Categoria C</option>
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
