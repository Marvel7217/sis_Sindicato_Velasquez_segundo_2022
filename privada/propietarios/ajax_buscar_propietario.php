<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
       
$paterno = $_POST["paterno"];
$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$ci = $_POST["ci"];

$db->debug=true;
if($paterno  or $nombre or $direccion or $ci){
    $sql3 = $db->Prepare("SELECT *
                          FROM propietarios
                          WHERE paterno LIKE ? 
                          AND nombre LIKE ?
                          AND direccion LIKE ?
                          AND ci LIKE ?  
                
                        ");
        $rs3 = $db->GetAll($sql3, array($paterno."%", $nombre."%", $direccion."%", $ci."%"));
    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>PATERNO</th><th>PATERNO</th><th>NOMBRES</th><th>DIRECCION<th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila['ci'];
                 $str1 = $fila['paterno'];
                 $str2 = $fila['nombre'];
                 $str3 = $fila['direccion'];

            echo"<tr>
                    <td align='center'>".resaltar($ci, $str)."</td>
                    <td>".resaltar($paterno, $str1)."</td>
                    <td>".resaltar($nombre, $str2)."</td>
                    <td>".resaltar($direccion, $str3)."</td>
                    <td align='center'>
                        <form name='formModif".$fila["id_propietario"]."' method='post' action='propietario_modificar.php'>
                        <input type='hidden' name='id_propietario' value='".$fila['id_propietario']."'>
                            <a href='javascript:document.formModif".$fila['id_propietario'].".submit();' title='Modificar Propietario Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>
                            <form name='formElimi".$fila["id_propietario"]."' method='post' action='propietario_eliminar.php'>
                                <input type='hidden' name='id_propietario' value='".$fila["id_propietario"]."'>
                                <a href='javascript:document.formElimi".$fila['id_propietario'].".submit();' title='Eliminar Propietario Sistema' onclick='javascript:return(confirm( Desea realmente Eliminar a la propietario..?))'; location.href='propietario_eliminar.php''>
                                Eliminar>>
                                </a>
                              </form>                        
                            </td>
                         </tr>";
        }
            echo "</table>
            </center>";
    }else{
        echo"<center><b> EL PROPIETARIO NO EXISTE!!</b></center><br>";

    }
}
?> 