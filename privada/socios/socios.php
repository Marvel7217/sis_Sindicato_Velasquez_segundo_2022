<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");


//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
   

        <p> &nbsp;</p>";

$sql = $db->Prepare("SELECT *
                     FROM socios
                     WHERE estado <> 'X' 
                     ORDER BY id_socio DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
        <h1>LISTADO DE SOCIOS</h1>
        <a  href='socio_nuevo.php'>Nuevo Socio>>>>></a>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>CI</th><th>PATERNO</th><th>MATERNO</th><th>NOMBRE</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td align='center'>".$fila['ci']."</td>
                        <td>".$fila['ap']."</td>
                        <td>".$fila['am']."</td>
                        <td>".$fila['nombres']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_socio"]."' method='post' action='socio_modificar.php'>
                          <input type='hidden' name='id_socio' value='".$fila['id_socio']."'>
                          <input type='hidden' name='id_sindic_taxi' value='".$fila['id_socio']."'>
                            <a href='javascript:document.formModif".$fila['id_socio'].".submit();' title='Modificar socio'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_socio"]."' method='post' action='socio_eliminar.php'>
                            <input type='hidden' name='id_socio' value='".$fila["id_socio"]."'>
                            <a href='javascript:document.formElimi".$fila['id_socio'].".submit();' title='Eliminar socio de Sistema'
                             onclick='javascript:return(confirm(\"Desea realmente Eliminar  ".$fila["nombres"]." ".$fila["ap"]." 
                             ".$fila["am"]." ?\"))'; location.href='sindicato_eliminar.php''> 
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

echo "</body>
      </html> ";

 ?>