<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$asociacion = $_POST["asociacion"];     
$instrumento = $_POST["instrumento"];
$codigo = $_POST["codigo"];


$db->debug=true;
if( $instrumento  or $asociacion or $codigo ){
    $sql3 = $db->Prepare("SELECT a.*, i.*
                          FROM  asociacion a
                          INNER JOIN instrumentos i ON i.id_asociacion=a.id_asociacion
                          WHERE i.instrumento LIKE ? 
                          AND i.codigo LIKE ? 
                          AND a.nombre LIKE ? 
                   
                                      
                        ");
        $rs3 = $db->GetAll($sql3, array($instrumento."%", $codigo."%", $asociacion."%"));
        $db->debug=true;
    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>ASOCIACION</th><th>INSTRUMENTO</th><th>CODIGO</th><th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila['nombre'];
                 $str1 = $fila['instrumento'];
                 $str2 = $fila['codigo'];


            echo"<tr>
            <td>".resaltar($asociacion, $str)."</td>
                    <td>".resaltar($instrumento, $str1)."</td>
                    <td>".resaltar($codigo, $str2)."</td>
                    <td align='center'>
                        <form name='formModif".$fila["id_asociacion"]."' method='post' action='opcion_modificar.php'>
                        <input type='hidden' name='id_asociacion' value='".$fila['id_asociacion']."'>
                            <a href='javascript:document.formModif".$fila['id_asociacion'].".submit();' title='Modificar Opciones Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>
                            <form name='formElimi".$fila["id_asociacion"]."' method='post' action='persona_eliminar.php'>
                                <input type='hidden' name='id_asociacion' value='".$fila["id_asociacion"]."'>
                                <a href='javascript:document.formElimi".$fila['id_asociacion'].".submit();' title='Eliminar Opcion Sistema' onclick='javascript:return(confirm( Desea realmente Eliminar a la persona..?))'; location.href='persona_eliminar.php''>
                                Eliminar>>
                                </a>
                              </form>                        
                            </td>
                         </tr>";
        }
            echo "</table>
            </center>";
    }else{
        echo"<center><b> LA ASOCIACION NO EXISTE!!</b></center><br>";

    }
}
?> 