<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;
$id_persona_1=$_POST["id_persona_1"];
$id_usuario= $_POST["id_usuario"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       
  
       <p> &nbsp;</p>";
         echo"<h1>MODIFICAR USUARIO</h1>";

$sql = $db->Prepare("SELECT * 
                     FROM  usuarios 
                     WHERE id_usuario = ?
                     AND estado = 'A' 
                  
                        ");
$rs=$db->GetAll($sql, array($id_usuario));

$sql1 = $db->Prepare("SELECT CONCAT_WS(' ', ap, am, nombres) AS persona, id_persona_1
                     FROM personas_1 
                     WHERE id_persona_1 = ?
                     AND estado='A'                    
                        ");
$rs1=$db->GetAll($sql1, array($id_persona_1)); 

$sql2 = $db->Prepare("SELECT CONCAT_WS(' ', ap, am, nombres) AS persona, id_persona_1
                     FROM personas_1 
                     WHERE id_persona_1 <> ?
                     AND estado ='A'                    
                        ");
$rs2=$db->GetAll($sql2, array($id_persona_1));  
        echo"<form action='usuario_modificar1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                <tr>
                    <th>(*)Persona</th>
                    <td>
                    <select name='id_persona_1'>";
                       
                        foreach ($rs1 as $k => $fila) {
                        echo"<option value='".$fila['id_persona_1']."'>".$fila['persona']."</option>";    
                        }  
                        foreach ($rs2 as $k => $fila) {
                        echo"<option value='".$fila['id_persona_1']."'>".$fila['persona']."</option>";    
                            }

                echo"</select>
                    </td>
                </tr>";
                foreach ($rs as $k => $fila) {
            echo"<tr>
                    <th><b>(*)Nombre de usuario</b></th>
                    <td><input type='text' name='usuario1' size='10' value='".$fila["usuario1"]."'></td>
                </tr>
                <tr>
                    <th><b>(*)Clave</b></th>
                    <td><input type='password' name='clave' size='10'></td>
                </tr>
                
                <tr>
                    <td align='center' colspan='2'>  
                    <input type='submit' value='MODIFICAR USUARIO'><br>
                    (*)Datos Obligatorios
                    <input type='hidden' name='id_usuario' value='".$fila["id_usuario"]."'></td>
                   
                </tr>";
                }
                echo"</table>
                </center>";
        echo"</form>" ;
    echo"</body>
         </html>";
 ?>