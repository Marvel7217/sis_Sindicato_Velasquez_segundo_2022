<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
       
$paterno = $_POST["paterno"];
$materno = $_POST["materno"];
$nombres = $_POST["nombres"];
$ci = $_POST["ci"];

//$db->debug=true;
if($paterno or $materno or $nombres or $ci){
    $sql3 = $db->Prepare("SELECT *
                          FROM choferes
                          WHERE ap LIKE ? 
                          AND am LIKE ? 
                          AND nomb LIKE ?
                          AND ci LIKE ?  
                          AND estado <> 'X'                     
                        ");
        $rs3 = $db->GetAll($sql3, array($paterno."%", $materno."%", $nombres."%", $ci."%"));
    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>C.I.</th><th>PATERNO</th><th>MATERNO</th><th>NOMBRES<th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila['ci'];
                 $str1 = $fila['ap'];
                 $str2 = $fila['am'];
                 $str3 = $fila['nomb'];

            echo"<tr>
                    <td align='center'>".resaltar($ci, $str)."</td>
                    <td>".resaltar($paterno, $str1)."</td>
                    <td>".resaltar($materno, $str2)."</td>
                    <td>".resaltar($nombres, $str3)."</td>
                    <td align='center'>
                        <form name='formModif".$fila["id_chofer"]."' method='post' action='chofer_modificar.php'>
                        <input type='hidden' name='id_chofer' value='".$fila['id_chofer']."'>
                            <a href='javascript:document.formModif".$fila['id_chofer'].".submit();' title='Modificar Chofer Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>
                            <form name='formElimi".$fila["id_chofer"]."' method='post' action='Chofer_eliminar.php'>
                                <input type='hidden' name='id_chofer' value='".$fila["id_chofer"]."'>
                                <a href='javascript:document.formElimi".$fila['id_chofer'].".submit();' title='Eliminar Chofer Sistema' onclick='javascript:return(confirm( Desea realmente Eliminar el chofer..?))'; location.href='chofer_eliminar.php''>
                                Eliminar>>
                                </a>
                              </form>                        
                            </td>
                         </tr>";
        }
            echo "</table>
            </center>";
    }else{
        echo"<center><b> EL CHOFER NO EXISTE!!</b></center><br>";

    }
}
?> 