<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
       
$id_propietario = $_POST["id_propietario"];

$db->debug=true;
$sql3 = $db->Prepare("SELECT *
                      FROM propietarios
                      WHERE id_propietario = ?                 
                    ");
$rs3 = $db->GetAll($sql3, array($id_propietario));

echo"<center>
      <table width='60%' border='1'>
        <tr>                                   
          <th colspan='4'>Datos Propietario</th>
        </tr>
    ";
foreach ($rs3 as $k => $fila) { 
    echo"<tr>                                      
            <td align='center'>".$fila["ci"]."</td>
            <td>".$fila["paterno"]."</td>
            <td>".$fila["nombre"]."</td>
            <td>".$fila["direccion"]."</td>
        </tr>";
  }
echo"</table>
    </center>";
?> 