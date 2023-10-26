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
        

$sql = $db->Prepare("SELECT CONCAT_WS(' ', p.ap, p.am, p.nombres) AS persona, u.* 
                     FROM personas_1 p, usuarios u
                     WHERE p.id_persona_1 = u.id_persona_1
                     AND p.estado <> 'x' 
                     AND u.estado <> 'x' 
                     ORDER BY u.id_usuario DESC                      
                        ");
$rs = $db->GetAll($sql);

   if ($rs) {
        echo"<center>
        <h1>LISTADO DE USUARIOS</h1>
        <a  href='usuario_nuevo.php'>Nuevo Usuario>></a>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>PERSONA</th><th>USUARIO</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['persona']."</td>                        
                        <td>".$fila['usuario1']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_usuario"]."' method='post' action='usuario_modificar.php'>
                            <input type='hidden' name='id_usuario' value='".$fila['id_usuario']."'>
                            <input type='hidden' name='id_persona_1' value='".$fila['id_usuario']."'>
                            <a href='javascript:document.formModif".$fila['id_usuario'].".submit();' title='Modificar Usuario Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_usuario"]."' method='post' action='usuario_eliminar.php'>
                            <input type='hidden' name='id_usuario' value='".$fila["id_usuario"]."'>
                            <a href='javascript:document.formElimi".$fila['id_usuario'].".submit();' 
                            title='Eliminar Usuario Sistema'
                             onclick='javascript:return(confirm(\"Desea realmente Eliminar al usuario ".$fila["usuario1"]." ?\"))'; 
                             location.href='usuario_eliminar.php''> 
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