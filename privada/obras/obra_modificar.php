<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;
$id_propietario=$_POST["id_propietario"];
$id_obra= $_POST["id_obra"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='obras.php'>Listado de Obras</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' 
       style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
       echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo"ROL: ".$_SESSION["sesion_rol"]."</h3>";
        echo" <h1>MODIFICAR OBRAS</h1>";

$sql = $db->Prepare("SELECT * 
                     FROM  obras 
                     WHERE id_obra = ?

                  
                        ");
$rs=$db->GetAll($sql, array($id_obra));

$sql1 = $db->Prepare("SELECT CONCAT_WS(' ', ap, am, nombre) AS propietario, id_propietario
                     FROM propietarios 
                     WHERE id_propietario = ?
                  
                        ");
$rs1=$db->GetAll($sql1, array($id_propietario)); 

$sql2 = $db->Prepare("SELECT CONCAT_WS(' ', ap, am, nombre) AS propietario, id_propietario
                     FROM propietarios 
                     WHERE id_propietario <> ?
                  
                        ");
$rs2=$db->GetAll($sql2, array($id_propietario));  
        echo"<form action='obra_modificar1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                <tr>
                    <th>(*)Propietario</th>
                    <td>
                    <select name='id_propietario'>";
                       
                        foreach ($rs1 as $k => $fila) {
                        echo"<option value='".$fila['id_propietario']."'>".$fila['propietario']."</option>";    
                        }  
                        foreach ($rs2 as $k => $fila) {
                        echo"<option value='".$fila['id_propietario']."'>".$fila['propietario']."</option>";    
                            }

                echo"</select>
                    </td>
                </tr>";
                foreach ($rs as $k => $fila) {
            echo"<tr>
                    <th><b>(*)Nombre de Obra</b></th>
                    <td><input type='text' name='nombre' size='10' value='".$fila["nombre"]."'></td>
                </tr>
                <tr>
                    <th><b>(*)CODIGO</b></th>
                    <td><input type='text' name='cod' size='10' value='".$fila["cod"]."'></td>
                </tr>
                <tr>
                    <th><b>(*)DIRECCION</b></th>
                    <td><input type='text' name='direccion' size='10' value='".$fila["direccion"]."'></td>
                </tr>
                
                
                <tr>
                    <td align='center' colspan='2'>  
                    <input type='submit' value='MODIFICAR OBRA'><br>
                    (*)Datos Obligatorios
                    <input type='hidden' name='id_obra' value='".$fila["id_obra"]."'></td>
                   
                </tr>";
                }
                echo"</table>
                </center>";
        echo"</form>" ;
    echo"</body>
         </html>";
 ?>