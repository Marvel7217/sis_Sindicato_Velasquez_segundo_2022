<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$cliente = $_POST["cliente"];     
$placa = $_POST["placa"];
$color = $_POST["color"];


$db->debug=true;
if($placa or $cliente or $color ){
    $sql3 = $db->Prepare("SELECT cli.*, mov.*
                          FROM clientes cli
                          INNER JOIN movilidades mov ON cli.id_cliente=mov.id_cliente
                          WHERE mov.placa LIKE ? 
                          AND mov.color LIKE ? 
                          AND cli.nombre LIKE ? 
                   
                        ");
        $rs3 = $db->GetAll($sql3, array($placa."%", $color."%", $cliente."%"));
        $db->debug=true;
    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>CLIENTES</th><th>PLACA</th><th>COLOR</th><th>SELECCIONE</th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila['nombre'];
                 $str1 = $fila['placa'];
                 $str2 = $fila['color'];


                 echo"<tr>
                 <td>".resaltar($cliente, $str)."</td>
                 <td>".resaltar($placa, $str1)."</td>
                 <td>".resaltar($color, $str2)."</td>
                 <td align='center'>
                     <input type='radio' name='opcion' value='' onClick='mostrar(".$fila['id_cliente'].")'>
                     </td>
                  </tr>";
     }
         echo "</table>
         </center>";
 }else{
     echo"<center><b> EL CLIENTE NO EXISTE!!</b></center><br>";

 }
}
?> 