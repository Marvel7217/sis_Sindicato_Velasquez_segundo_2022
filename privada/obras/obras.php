<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../libreria_menu.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>";
         contarRegistros($db,"obras");
        paginacion("obras.php?");


       /* $sql3 = $db->Prepare("SELECT CONCAT_WS(' ', p.ap,p.nombre) AS propietario, o.* 
        FROM propietarios p, obras o
        WHERE p.id_propietario = o.id_propietario
        ORDER BY o.id_obra DESC  
                                      
                        ");
$rs = $db->GetAll($sql3, array($nElem,$regIni));*/

$sql3 = $db->Prepare("SELECT CONCAT_WS(' ', p.ap,p.nombre) AS propietario, o.* 
                     FROM propietarios p, obras o
                     WHERE p.id_propietario = o.id_propietario
                     AND o.id_obra > 1
                     ORDER BY o.id_obra DESC
                     LIMIT ? OFFSET ? 
           
                        ");
$rs = $db->GetAll($sql3,array($nElem,$regIni));
   if ($rs) {
        echo"<center>
        <p> &nbsp;</p>
        <h1>LISTADO DE OBRAS</h1>
              <table class='listado'>
              <a  href='obra_nuevo.php'>Nueva Obras>>>></a>
                <tr>                                   
                  <th>Nro</th><th>PROPIETARIO</th><th>Nombre de Obra</th><th>CODIGO</th><th>DIRECCION</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=0;
                $total=$pag-1;
                $a = $nElem*$total;
                $b= $b+1+$a;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['propietario']."</td>                        
                        <td>".$fila['nombre']."</td>
                        <td>".$fila['cod']."</td>
                        <td>".$fila['direccion']."</td>

                        <td align='center'>
                          <form name='formModif".$fila["id_obra"]."' method='post' action='obra_modificar.php'>
                            <input type='hidden' name='id_obra' value='".$fila['id_obra']."'>
                            <input type='hidden' name='id_propietario' value='".$fila['id_obra']."'>
                            <a href='javascript:document.formModif".$fila['id_obra'].".submit();' title='Modificar Obras Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_obra"]."' method='post' action='obra_eliminar.php'>
                            <input type='hidden' name='id_obra' value='".$fila["id_obra"]."'>
                            <a href='javascript:document.formElimi".$fila['id_obra'].".submit();' 
                            title='Eliminar Obras de Sistema'
                             onclick='javascript:return(confirm(\"Desea realmente Eliminar a la Obra:  ".$fila["nombre"]." ?\"))'; 
                             location.href='obra_eliminar.php''> 
                              Eliminar>>
                            </a>
                          </form>                        
                        </td>
                     </tr>";
                     $b=$b+1;
            }
             echo"</table>
          </center>";
    }

echo"<!--PAGINACION-------------------------------------------------->";
echo"<table border='0' align='center'>
    <tr>
      <td>";
       if(!empty($urlback)){
        echo"<a href=".$urlback." style='font-family:verdana;font-size:9px;cursor:pointer'; >&laquo;Anterior</a>";
       }
       if(!empty($paginas)){
        foreach($paginas as $k=> $pagg){
          if($pagg["npag"]==$pag){
            if($pag != '1'){
              echo"|";
            }
            echo"<b style='color:#FB992F;font-size:12px;'>";
          } else
          echo"</b> | <a href=".$pagg["pagV"]." style='cursor:pointer;'>";echo $pagg["npag"]; echo"</a>";

        }
      }
      if(($nPags >$nBotones) and (!empty($urlnext))and ($pag<$nPags)){
        echo" |<a href=".$urlnext." style='font-family: Verdana;font-size: 9px;cursor:pointer'>Siguiente&raquo;</a>";
      }
       echo"</td>
       </tr>
    </table>";
  echo"<!---PAGINACION----------------------------------------->";
  echo "</body>
      </html> ";

 ?>