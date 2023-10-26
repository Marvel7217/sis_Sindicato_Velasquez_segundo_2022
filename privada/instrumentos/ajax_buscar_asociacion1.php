<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
       
$id_asociacion = $_POST["id_asociacion"];

$db->debug=true;
$sql3 = $db->Prepare("SELECT *
                      FROM asociacion
                      WHERE id_asociacion = ? 
                  
                    ");
$rs3 = $db->GetAll($sql3, array($id_asociacion));

echo"<center>
      <table width='60%' border='1'>
        <tr>                                   
          <th colspan='4'>Datos Asociacion</th>
        </tr>
    ";
foreach ($rs3 as $k => $fila) { 
    echo"<tr>                                      
            <td align='center'>".$fila["nombre"]."</td>
            <td>".$fila["direccion"]."</td>
            <td>".$fila["telefono"]."</td>
            <td>".$fila["correo"]."</td>
        </tr>";
  }
echo"</table>
    </center>";
?> 