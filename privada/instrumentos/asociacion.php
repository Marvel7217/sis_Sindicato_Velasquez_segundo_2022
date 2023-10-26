<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_asociacion.js'> </script>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='instrumento_nuevo.php'>Nuevo Instrumento</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

   
       echo"<h1>ASOCIACIONES</h1>";   
       $sql = $db->Prepare("SELECT CONCAT_WS(' ',a.nombre) AS asociacion, i.instrumento,i.codigo,i.id_asociacion,a.id_asociacion,a.nombre
       FROM asociacion a, instrumentos i
       WHERE a.id_asociacion = i.id_asociacion
                
   ");  
   $rs = $db->GetAll($sql);

echo"
<!------INICIO BUSCADOR---------------->
    <center>
    <form action='#'' method='post' name='formu'>
    <table border='1' class='listado'>
    <tr>
    <th>
     <b>Asociacion</b><br />
    <select name='asociacion' onChange='buscar_asociacion()'>
    <option value=''>Seleccione</option>
    <option value='AAPICULTORESAAA'>AAPICULTORESAAA</option>
    <option value='APICULTORESTJA'>APICULTORESTJA</option>
    <option value='APICULTORES_BERMEJO'>APICULTORES_BERMEJO</option>     
</select>
</th> 
    
        <th>
          <b>Instrumento</b><br />
          <input type='text' name='instrumento' value='' size='10' onKeyUp='buscar_asociacion()'>
        </th>
        <th>
          <b>Codigo</b><br />
          <input type='text' name='codigo' value='' size='10' onKeyUp='buscar_asociacion()'>
        </th>

    </table>
    </form>
    </center>
    <!------FIN BUSCADOR---------------->";

echo"<div id='asociacion1'> ";


   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                <th>Nro</th><th>ASOCIACION</th><th>ISNTRUMENTO</th><th>CODIGO</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                <td align='center'>".$b."</td>
                        <td align='center'>".$fila['asociacion']."</td>
                        <td>".$fila['instrumento']."</td>
                        <td>".$fila['codigo']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_asociacion"]."' method='post' action='opcion_modificar.php'>
                            <input type='hidden' name='id_asociacion' value='".$fila['id_asociacion']."'>
                            <input type='hidden' name='id_asociacion' value='".$fila['id_asociacion']."'>
                            <a href='javascript:document.formModif".$fila['id_asociacion'].".submit();' title='Modificar Opcion Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_asociacion"]."' method='post' action='opcion_eliminar.php'>
                            <input type='hidden' name='id_asociacion' value='".$fila["id_asociacion"]."'>
                            <a href='javascript:document.formElimi".$fila['id_asociacion'].".submit();' 
                            title='Eliminar opcion Sistema'
                             onclick='javascript:return(confirm(\"Desea realmente Eliminar al opcion ".$fila["nombre"]." ?\"))'; 
                             location.href=='opcion_eliminar.php''> 
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