<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;
$id_socio=$_POST["id_socio"];
$id_movil= $_POST["id_movil"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";
       /*
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='moviles.php'>Listado de Usuarios</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' 
       style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
       echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo"ROL: ".$_SESSION["sesion_rol"]."</h3>";
        echo" <h1>MODIFICAR USUARIO</h1>";*/
        echo"<h1>MODIFICAR MOVIL</h1>";

$sql = $db->Prepare("SELECT * 
                     FROM  moviles 
                     WHERE id_movil = ?
                     AND estado = 'A' 
                  
                        ");
$rs=$db->GetAll($sql, array($id_movil));

$sql1 = $db->Prepare("SELECT CONCAT_WS(' ', ap, am, nombres) AS socio, id_socio
                     FROM socios 
                     WHERE id_socio = ?
                     AND estado='A'                    
                        ");
$rs1=$db->GetAll($sql1, array($id_socio)); 

$sql2 = $db->Prepare("SELECT CONCAT_WS(' ', ap, am, nombres) AS socio, id_socio
                     FROM socios 
                     WHERE id_socio <> ?
                     AND estado ='A'                    
                        ");
$rs2=$db->GetAll($sql2, array($id_socio));  
        echo"<form action='movil_modificar1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                <tr>
                    <th>(*)Socio</th>
                    <td>
                    <select name='id_socio'>";
                       
                        foreach ($rs1 as $k => $fila) {
                        echo"<option value='".$fila['id_socio']."'>".$fila['socio']."</option>";    
                        }  
                        foreach ($rs2 as $k => $fila) {
                        echo"<option value='".$fila['id_socio']."'>".$fila['socio']."</option>";    
                            }

                echo"</select>
                    </td>
                </tr>";
                foreach ($rs as $k => $fila) {
            echo"<tr>
                    <th><b>(*)Nomero de Movil</b></th>
                    <td><input type='text' name='numero' size='10' value='".$fila["numero"]."'></td>
                </tr>
                <tr>
                    <th><b>(*)Placa</b></th>
                    <td><input type='text' name='placa' size='10' value='".$fila["placa"]."'></td>
                </tr>
                <tr>
                    <th><b>(*)Modelo</b></th>
                    <td><input type='text' name='modelo' size='10' value='".$fila["modelo"]."'></td>
                </tr>
                
                
                <tr>
                    <td align='center' colspan='2'>  
                    <input type='submit' value='MODIFICAR MOVIL'><br>
                    (*)Datos Obligatorios
                    <input type='hidden' name='id_movil' value='".$fila["id_movil"]."'></td>
                   
                </tr>";
                }
                echo"</table>
                </center>";
        echo"</form>" ;
    echo"</body>
         </html>";
 ?>