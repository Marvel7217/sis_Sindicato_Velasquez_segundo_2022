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
       <a  href='propietarios.php'>Listado de Propietarios</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' 
       style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
       echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo"ROL: ".$_SESSION["sesion_rol"]."</h3>";
        echo" <h1>INSERTAR PROPIETARIO</h1>";

/*$sql = $db->Prepare("SELECT *
                     FROM _personas
                     WHERE _estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);*/
 /*  if ($rs) {*/
        echo"<form action='propietario_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                <tr>
                <th><b>CI</b></th>
                <td><input type='text' name='ci' size='10' ></td>
              </tr>
                  <tr>
                    <th><b>Paterno</b></th>
                    <td><input type='text' name='ap' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  <tr>
                    <th><b>Materno</b></th>
                    <td><input type='text' name='am' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </td>                    
                  </tr>
                  <tr>
                    <th><b>(*)Nombres</b></th><td><input type='text' name='nombre' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </td>
                  </tr>
                  <tr>
                    <th><b>Dirección</b></th>
                    <td><input type='text' name='direccion' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </td>
                  </tr>
                  <tr>
                    <th><b>Telefono</b></th><td><input type='text' name='telef' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>Fecha Nacimiento</b></th>
                    <td><input type='date' name='fec_nac' size='10'></td>
                  </tr>
                 
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR PROPIETARIO'  >
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>