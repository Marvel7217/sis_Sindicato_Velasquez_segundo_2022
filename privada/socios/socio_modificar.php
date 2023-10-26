<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
//$db->debug=true;

$id_sindic_taxi=$_POST["id_sindic_taxi"];
$id_socio=$_POST["id_socio"];



echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";

         echo"<h1>MODIFICAR SOCIO</h1>";

$sql = $db->Prepare("SELECT *
                     FROM socios
                     WHERE id_socio = ? 
                     AND estado <>'X'                    
                        ");
$rs = $db->GetAll($sql,array($id_socio));

$sql1 = $db->Prepare("SELECT CONCAT_WS(' ', direccion, nombre) AS sindicato, id_sindic_taxi
                     FROM sindicato_taxis 
                     WHERE id_sindic_taxi = ?
                     AND estado='A'                    
                        ");
$rs1=$db->GetAll($sql1, array($id_sindic_taxi)); 

$sql2 = $db->Prepare("SELECT CONCAT_WS(' ', direccion, nombre) AS sindicato, id_sindic_taxi
                     FROM sindicato_taxis 
                     WHERE id_sindic_taxi <> ?
                     AND estado ='A'                    
                        ");
$rs2=$db->GetAll($sql2, array($id_sindic_taxi));

echo"<form action='socio_modificar1.php' method='post' name='formu'>";
echo"<center>
        <table class='listado'>
        <tr>
            <th>(*)sindicato de taxi</th>
            <td>
            <select name='id_sindic_taxi'>";
               
                foreach ($rs1 as $k => $fila) {
                echo"<option value='".$fila['id_sindic_taxi']."'>".$fila['sindicato']."</option>";    
                }  
                foreach ($rs2 as $k => $fila) {
                echo"<option value='".$fila['id_sindic_taxi']."'>".$fila['sindicato']."</option>";    
                    }

        echo"</select>
            </td>
        </tr>";
        foreach ($rs as $k => $fila) {
    echo"<tr>
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
        <th><b>Nombres</b></th>
        <td><input type='text' name='nombres' size='10' onkeyup='this.value=this.value.toUpperCase()' 
        value='".$fila["nombres"]."'>
        </td>
      </tr>
      <tr>
        <th><b>Telefono</b></th>
        <td><input type='text' name='telf' size='10' onkeyup='this.value=this.value.toUpperCase()'
         value='".$fila["telf"]."'>
        </td>
      </tr>
      <tr>
        <th><b>Fecha Nacimiento</b></th>
        <td><input type='date' name='fec_nac' size='10' onkeyup='this.value=this.value.toUpperCase()'
         value='".$fila["fec_nac"]."'>
        </td>
      </tr>
     <tr>
     <th><b>Genero</b></th>";
     if($fila["genero"]='F')
     echo"<td><input type='radio' name='genero' size='10' value='F'checked>Femenino
     <input type='radio' name='genero' size='10' value='M'checked>Masculino<br>
     </td>";
     else
     echo"<td><input type='radio' name='genero' size='10' value='F'checked>Femenino
     <input type='radio' name='genero' size='10' value='M'checked>Masculino<br>
     </td>";
     echo"</tr>

        
        <tr>
            <td align='center' colspan='2'>  
            <input type='submit' value='MODIFICAR SOCIO'><br>
            (*)Datos Obligatorios
            <input type='hidden' name='id_socio' value='".$fila["id_socio"]."'></td>  
        </tr>";
        }
        echo"</table>
        </center>";
echo"</form>" ;
echo"</body>
 </html>";
?>
