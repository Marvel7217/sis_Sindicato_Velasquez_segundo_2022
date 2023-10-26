<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

$db->debug=true;
$id_persona_1=$_POST["id_persona_1"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
      <p> &nbsp;</p>";

$sql = $db->Prepare("SELECT *
                     FROM personas_1
                     WHERE id_persona_1 = ? 
                     AND estado <>'x'                    
                        ");
$rs = $db->GetAll($sql,array($id_persona_1));

            foreach ($rs as $k => $fila) {                                       
                echo"<form action='persona_modificar1.php' method='post' name='formu'>";
                echo"<center>
                <h1>MODIFICAR PERSONA</h1>
                <table class='listado'>
                <tr>
                <th><b>CI</b></th>
                <td><input type='text' name='ci' size='10' value='".$fila["ci"]."' ></td>
              </tr>
                  <tr>
                    <th><b>Paterno</b></th>
                    <td><input type='text' name='ap' size='10' onkeyup='this.value=this.value.toUpperCase()' 
                    value='".$fila["ap"]."'></td>
                  </tr>
                  <tr>
                    <th><b>Materno</b></th>
                    <td><input type='text' name='am' size='10' onkeyup='this.value=this.value.toUpperCase()' 
                    value='".$fila["am"]."'>
                    </td>                    
                  </tr>
                  <tr>
                    <th><b>(*)Nombres</b></th>
                    <td><input type='text' name='nombres' size='10' onkeyup='this.value=this.value.toUpperCase()' 
                    value='".$fila["nombres"]."'>
                    </td>
                  </tr>
                  <tr>
                    <th><b>Dirección</b></th>
                    <td><input type='text' name='direccion' size='10' onkeyup='this.value=this.value.toUpperCase()'
                     value='".$fila["direccion"]."'>
                    </td>
                  </tr>
                  <tr>
                    <th><b>Telefono</b></th>
                    <td><input type='text' name='telefono' size='10' value='".$fila["telefono"]."'></td>
                  </tr>
                 
              
                     <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='MODIFICAR PERSONA'  >
                      <input type='hidden' name='id_persona_1' value='".$fila["id_persona_1"]."'>

                    </td>
                  </tr>
                  
                </table>
                </center>";
          echo"</form>" ;   

    
            }
echo "</body>
      </html> ";

 ?>