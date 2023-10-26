<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
       
$monto = $_POST["monto"];
$objeto = $_POST["objeto"];
$tipo = $_POST["tipo"];

$db->debug=true;
if($monto or $objeto or $tipo ){
    $sql3 = $db->Prepare("SELECT *
                          FROM tapizados
                          WHERE monto_estimado LIKE ? 
                          AND objeto LIKE ? 
                          AND tipo_tapizado LIKE ?
               
                        ");
        $rs3 = $db->GetAll($sql3, array($monto."%", $objeto."%", $tipo."%"));
    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>MONTO</th><th>OBJETO</th><th>TIPO TAPIZADO<th>SELECCIONE</th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila['monto_estimado'];
                 $str1 = $fila['objeto'];
                 $str2 = $fila['tipo_tapizado'];

            echo"<tr>
                    <td>".resaltar($monto, $str)."</td>
                    <td>".resaltar($objeto, $str1)."</td>
                    <td>".resaltar($tipo, $str2)."</td>
                    <td align='center'>
                        <input type='radio' name='opcion' value='' onClick='mostrar(".$fila['id_tapizado'].")'>
                        </td>
                     </tr>";
        }
            echo "</table>
            </center>";
    }else{
        echo"<center><b> EL TAPIZADO NO EXISTE!!</b></center><br>";

    }
}
?> 