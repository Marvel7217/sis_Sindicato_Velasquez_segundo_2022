<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_movil.js'> </script>
       </head>
       <body>
     
      
       <p> &nbsp;</p>";

   
      
       $sql = $db->Prepare("SELECT CONCAT_WS(' ',s.nombres,s.ap,s.am) AS socio,m.*
       FROM socios s, moviles m
       WHERE s.id_socio = m.id_movil
       AND s.estado <> 'X' 
       AND m.estado <> 'X'
                    
   ");  
   $rs = $db->GetAll($sql);

echo"
<!------INICIO BUSCADOR---------------->
    <center>
    <h1>LISTA DE MOVILES</h1>  
    <a  href='movil_nuevo.php'>Nuevo Movil>>>>></a>
    <form action='#'' method='post' name='formu'>
    <table border='1' class='listado'>
    <tr>
    <th>
     <b>Socios</b><br />
    <select name='socio' onChange='buscar_movil()'>
    <option value=''>Seleccione</option>";
                        foreach ($rs as $k => $fila) {
                        echo"<option value='".$fila['id_socio']."'>".$fila['socio']."</option>";    
                        }  
                        echo"</select>
</th> 
    
        <th>
          <b>Numero</b><br />
          <input type='int' name='numero' value='' size='10' onKeyUp='buscar_movil()'>
        </th>
        <th>
          <b>Placa</b><br />
          <input type='text' name='placa' value='' size='10' onKeyUp='buscar_movil()'>
        </th>
        <th>
          <b>Modelo</b><br />
          <input type='text' name='modelo' value='' size='10' onKeyUp='buscar_movil()'>
        </th>

    </table>
    </form>
    </center>
    <!------FIN BUSCADOR---------------->";

echo"<div id='moviles1'> ";


   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                <th>Nro</th><th>NUMERO</th><th>PLACA</th><th>MODELO</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                <td align='center'>".$b."</td>
                        <td align='center'>".$fila['numero']."</td>
                        <td>".$fila['placa']."</td>
                        <td>".$fila['modelo']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_movil"]."' method='post' action='movil_modificar.php'>
                            <input type='hidden' name='id_movil' value='".$fila['id_movil']."'>
                            <input type='hidden' name='id_socio' value='".$fila['id_movil']."'>
                            <a href='javascript:document.formModif".$fila['id_movil'].".submit();' title='Modificar Opcion Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_movil"]."' method='post' action='movil_eliminar.php'>
                            <input type='hidden' name='id_movil' value='".$fila["id_movil"]."'>
                            <a href='javascript:document.formElimi".$fila['id_movil'].".submit();' 
                            title='Eliminar opcion Sistema'
                             onclick='javascript:return(confirm(\"Desea realmente Eliminar al opcion ".$fila["usuario"]." ?\"))'; 
                             location.href=='movil_eliminar.php''> 
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