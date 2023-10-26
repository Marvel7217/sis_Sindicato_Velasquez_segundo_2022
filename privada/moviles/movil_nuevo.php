<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p> ";
       /*
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='moviles.php'>Listado de Moviles</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion'
       value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
       echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo"ROL: ".$_SESSION["sesion_rol"]."</h3>";
         echo"<h1>INSERTAR MOVIL</h1>";*/

//Para cada herencia es una consulta
$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,ap, am, nombres) as socio, id_socio
                     FROM socios
                     WHERE estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);
 /*  if ($rs) {*/
        echo"<form action='movil_nuevo1.php' method='post' name='formu'>";
        echo"<center>
        <h1>INSERTAR MOVIL</h1>
                <table class='listado'>
                  <tr>
                    <th>(*)Socios</th>
                    <td>
                      <select name='id_socio'>
                        <option value=''>--Seleccione--</option>";
                        foreach ($rs as $k => $fila) {
                        echo"<option value='".$fila['id_socio']."'>".$fila['socio']."</option>";    
                        }  

                echo"</select>
                    </td>
                  </tr>";
             echo"<tr>
                    <th><b>(*)Numero de Movil</b></th>
                    <td><input type='text' name='numero' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Placa</b></th>
                    <td><input type='text' name='placa' size='10'></td>
                  </tr>
                  <tr>
                  <th><b>(*)Modelo</b></th>
                  <td><input type='text' name='modelo' size='10'></td>
                </tr>
                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR MOVIL'><br>
                      (*)Datos Obligatorios
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>