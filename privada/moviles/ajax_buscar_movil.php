<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$socio = $_POST["socio"];     
$numero = $_POST["numero"];
$placa = $_POST["placa"];
$modelo = $_POST["modelo"];


$db->debug=true;
if($numero or $socio or $placa or $modelo ){
    $sql3 = $db->Prepare("SELECT m.*, s.*
                          FROM moviles m
                          INNER JOIN socios s ON m.id_socio=s.id_socio
                          WHERE m.numero LIKE ? 
                          AND m.placa LIKE ? 
                          AND m.modelo LIKE ? 
                          AND s.socio LIKE ? 
                          AND m.estado <> 'X'
                          AND s.estado <> 'X'                     
                        ");
        $rs3 = $db->GetAll($sql3, array($numero."%", $placa."%", $socio."%", $modelo."%"));

    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>SOCIOS</th><th>NUMERO</th><th>PLACA</th><th>MODELO</th><th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila['socio'];
                 $str1 = $fila['numero'];
                 $str2 = $fila['placa'];
                 $str3 = $fila['modelo'];


            echo"<tr>
            <td>".resaltar($socio, $str)."</td>
                    <td>".resaltar($numero, $str1)."</td>
                    <td>".resaltar($placa, $str2)."</td>
                    <td>".resaltar($modelo, $str3)."</td>
                    <td align='center'>
                        <form name='formModif".$fila["id_socio"]."' method='post' action='movil_modificar.php'>
                        <input type='hidden' name='id_socio' value='".$fila['id_socio']."'>
                            <a href='javascript:document.formModif".$fila['id_socio'].".submit();' title='Modificar Moviles Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>
                            <form name='formElimi".$fila["id_socio"]."' method='post' action='movil_eliminar.php'>
                                <input type='hidden' name='id_socio' value='".$fila["id_socio"]."'>
                                <a href='javascript:document.formElimi".$fila['id_socio'].".submit();' title='Eliminar movil Sistema' onclick='javascript:return(confirm( Desea realmente Eliminar a la movil..?))'; location.href='movil_eliminar.php''>
                                Eliminar>>
                                </a>
                              </form>                        
                            </td>
                         </tr>";
        }
            echo "</table>
            </center>";
    }else{
        echo"<center><b> EL MOVIL NO EXISTE!!</b></center><br>";

    }
}
?> 