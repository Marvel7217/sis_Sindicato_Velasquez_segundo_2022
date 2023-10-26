<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='obras.php'>Listado de Obras</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion'
       value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
       echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo"ROL: ".$_SESSION["sesion_rol"]."</h3>";
         echo"<h1>INSERTAR OBRAS</h1>";
//Para cada herencia es una consulta
$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,ap, am, nombre) as propietario, id_propietario
                     FROM propietarios
                      
                        ");
$rs = $db->GetAll($sql);
 /*  if ($rs) {*/
        echo"<form action='obra_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*)Persona</th>
                    <td>
                      <select name='id_propietario'>
                        <option value=''>--Seleccione--</option>";
                        foreach ($rs as $k => $fila) {
                        echo"<option value='".$fila['id_propietario']."'>".$fila['propietario']."</option>";    
                        }  

                echo"</select>
                    </td>
                  </tr>";
             echo"<tr>
                    <th><b>(*)Nombre de Obra</b></th>
                    <td><input type='text' name='nombre' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)</b>CODIGO</th>
                    <td><input type='text' name='cod' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)</b>DIRECCION</th>
                    <td><input type='text' name='direccion' size='10'></td>
                  </tr>
               
                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR OBRA'><br>
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