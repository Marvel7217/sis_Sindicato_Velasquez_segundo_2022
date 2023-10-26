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
       <a  href='chofer_nuevo.php'>Nuevo Chofer</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' 
       style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
       echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
        echo"ROL: ".$_SESSION["sesion_rol"]."</h3>";
        echo" <h1>CHOFERES</h1>";

$sql = $db->Prepare("SELECT *
                     FROM choferes
                     WHERE estado <> 'X' 
                     ORDER BY id_chofer DESC                      
                        ");
$rs = $db->GetAll($sql);
if ($rs) {
    echo"<center>
          <table class='listado'>
            <tr>                                   
              <th>Nro</th><th>C.I.</th><th>PATERNO</th><th>MATERNO</th><th>NOMBRES</th><th>GENERO</th><th>CATEGORIA LICENCIA</th>
              <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
            </tr>";
            $b=1;
        foreach ($rs as $k => $fila) {                                       
            echo"<tr>
                    <td align='center'>".$b."</td>
                    <td align='center'>".$fila['ci']."</td>
                    <td>".$fila['ap']."</td>
                    <td>".$fila['am']."</td>
                    <td>".$fila['nomb']."</td>
                    <td>".$fila['genero']."</td>
                    <td>".$fila['Categor_lic']."</td>

                    <td align='center'>
                      <form name='formModif".$fila["id_chofer"]."' method='post' action='chofer_modificar.php'>
                        <input type='hidden' name='id_chofer' value='".$fila['id_chofer']."'>
                        <a href='javascript:document.formModif".$fila['id_chofer'].".submit();' title='Modificar Chofer Sistema'>
                          Modificar>>
                        </a>
                      </form>
                    </td>
                    <td align='center'>  
                      <form name='formElimi".$fila["id_chofer"]."' method='post' action='chofer_eliminar.php'>
                        <input type='hidden' name='id_chofer' value='".$fila["id_chofer"]."'>
                        <a href='javascript:document.formElimi".$fila['id_chofer'].".submit();' title='Eliminar Chofer Sistema'
                         onclick='javascript:return(confirm(\"Desea Realmente Eliminar al chofer".$fila["nomb"]." ".$fila["ap"]."
                          ".$fila["am"]." ?\"))'; location.href='chofer_eliminar.php''> 
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