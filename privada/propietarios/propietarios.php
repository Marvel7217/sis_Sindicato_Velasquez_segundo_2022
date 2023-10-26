<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_propietarios.js'> </script>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='propietario_nuevo.php'>Nueva Propietario</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

       echo"<h1>LISTADO DE PROPIETARIOS</h1>";

echo"
<!------INICIO BUSCADOR---------------->
    <center>
    <form action='#'' method='post' name='formu'>
    <table border='1' class='listado'>
      <tr>
        <th>
          <b>Paterno</b><br />
          <input type='text' name='paterno' value='' size='10' onKeyUp='buscar_propietarios()'>
        </th>
        
        <th>
          <b>Nombres</b><br />
          <input type='text' name='nombre' value='' size='10' onKeyUp='buscar_propietarios()'>
        </th>
        <th>
        <th>
          <b>Direccion</b><br />
          <input type='text' name='direccion' value='' size='10' onKeyUp='buscar_propietarios()'>
        </th>
        <th>
          <b>C.I.</b><br />
          <input type='text' name='ci' value='' size='10' onKeyUp='buscar_propietarios()'>
        </th>
      </tr>
    </table>
    </form>
    </center>
    <!------FIN BUSCADOR---------------->";

echo"<div id='propietarios1'> ";
$sql = $db->Prepare("SELECT *
                     FROM propietarios
                     ORDER BY id_propietario DESC                      
                        ");
$rs = $db->GetAll($sql);

   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>C.I.</th><th>PATERNO</th><th>NOMBRES</th><th>DIRECCION</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td align='center'>".$fila['ci']."</td>
                        <td>".$fila['paterno']."</td>
                        <td>".$fila['nombre']."</td>
                        <td>".$fila['direccion']."</td>
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
                            <a href='javascript:document.formElimi".$fila['id_propietario'].".submit();' title='Eliminar Propietario Sistema'
                             onclick='javascript:return(confirm(\"Desea realmente Eliminar al propietario ".$fila["nombre"]." ".$fila["paterno"]."
                              ".$fila["direccion"]." ?\"))'; location.href='persona_eliminar.php''> 
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
echo"</div>";
echo "</body>
      </html> ";

 ?>