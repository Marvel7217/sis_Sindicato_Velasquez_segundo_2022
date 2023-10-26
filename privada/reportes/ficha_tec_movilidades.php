<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js3/buscar_clientes.js'> </script>
         <script type='text/javascript' src='js3/mostrar.js'> </script>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

       echo"<h1>FICHA TECNICA DE CLIENTE</h1>";
       $sql = $db->Prepare("SELECT CONCAT_WS(' ',cli.nombre) AS clienteo,mov.placa,mov.color
       FROM clientes cli, movilidades mov
       WHERE cli.id_cliente = mov.id_movilidad
     
   ");  
   $rs = $db->GetAll($sql);

echo"
<!------INICIO BUSCADOR---------------->
<center>
<form action='#'' method='post' name='formu'>
<table border='1' class='listado'>
<tr>
<th>
 <b>clientes</b><br />
 <select name='cliente' onChange='buscar_clientes()'>
 <option value=''>Seleccione</option>
 <option value='jose luis'>jose luis</option>
 <option value='jose carlos'>jose carlos</option>
 <option value='exel moises'>exel moises</option>
 <option value='efrain'>efrain</option>
 <option value='gonzalo'>gonzalo</option>
     
   
</select>
</th> 
        <th>
          <b>Placa</b><br />
          <input type='text' name='placa' value='' size='10' onKeyUp='buscar_clientes()'>
        </th>
        <th>
          <b>Color</b><br />
          <input type='text' name='color' value='' size='10' onKeyUp='buscar_clientes()'>
        </th>
     
      </tr>
    </table>
    </form>
    </center>
    <!------FIN BUSCADOR---------------->";
    echo"<div id='cliente1'> ";
    echo"</div>";
    echo"</body>
         </html> ";
         
    ?>