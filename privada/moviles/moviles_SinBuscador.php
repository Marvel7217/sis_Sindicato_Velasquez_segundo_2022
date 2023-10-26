<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='movil_nuevo.php'>Nuevo Movil</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' 
       style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
       echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo"ROL: ".$_SESSION["sesion_rol"]."</h3>";
         echo"<h1>LISTADO DE MOVILES</h1>";

 $sql = $db->Prepare("SELECT CONCAT_WS(' ', s.ap, s.am, s.nombres) AS persona, m.* 
         FROM socios s, moviles m
         WHERE s.id_socio = m.id_socio
         AND s.estado <> 'X' 
         AND m.estado <> 'X' 
         ORDER BY s.id_socio DESC                      
            ");
$rs = $db->GetAll($sql);
if ($rs) {
    echo"<center>
          <table class='listado'>
            <tr>                                   
              <th>Nro</th><th>CHOFER</th></th><th>NumeroMovil</th><th>PLACA</th></th><th>MODELO</th>
              <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
            </tr>";
            $b=1;
        foreach ($rs as $k => $fila) {                                       
            echo"<tr>
                    <td align='center'>".$b."</td>
                    <td>".$fila['persona']."</td> 
                    <td>".$fila['numero']."</td>                        
                    <td>".$fila['placa']."</td>
                    <td>".$fila['modelo']."</td>
                    <td align='center'>
                      <form name='formModif".$fila["id_movil"]."' method='post' action='movil_modificar.php'>
                        <input type='hidden' name='id_movil' value='".$fila['id_movil']."'>
                        <input type='hidden' name='id_socio' value='".$fila['id_movil']."'>
                        <a href='javascript:document.formModif".$fila['id_movil'].".submit();' title='Modificar Movil de Sistema'>
                          Modificar>>
                        </a>
                      </form>
                    </td>
                    <td align='center'>  
                      <form name='formElimi".$fila["id_movil"]."' method='post' action='movil_eliminar.php'>
                        <input type='hidden' name='id_movil' value='".$fila["id_movil"]."'>
                        <a href='javascript:document.formElimi".$fila['id_movil'].".submit();' 
                        title='Eliminar Movil de Sistema'
                         onclick='javascript:return(confirm(\"Desea realmente Eliminar el movil ".$fila["numero"]." ?\"))'; 
                         location.href='movil_eliminar.php''> 
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