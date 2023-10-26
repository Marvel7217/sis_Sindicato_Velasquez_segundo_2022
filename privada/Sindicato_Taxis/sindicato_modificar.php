<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;
$id_sindic_taxi=$_POST["id_sindic_taxi"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='sindicato.php'>Listado</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' 
       value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
       echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo"ROL: ".$_SESSION["sesion_rol"]."</h3>";
         echo"<h1>MODIFICAR PERSONA</h1>";

$sql = $db->Prepare("SELECT *
                     FROM sindicato_taxis
                     WHERE id_sindic_taxi = ? 
                     AND estado <>'x'                    
                        ");
$rs = $db->GetAll($sql,array($id_sindic_taxi));

            foreach ($rs as $k => $fila) {                                       
                echo"<form action='sindicato_modificar1.php' method='post' name='formu'>";
                echo"<center>
                <table class='listado'>
                <tr>
                <th><b>NOMBRE</b></th>
                <td><input type='text' name='nombre' size='10' value='".$fila["nombre"]."' ></td>
              </tr>
                  <tr>
                    <th><b>DIRECCION</b></th>
                    <td><input type='text' name='direccion' size='10' onkeyup='this.value=this.value.toUpperCase()' 
                    value='".$fila["direccion"]."'></td>
                  </tr>
                  <tr>
                    <th><b>LOGO</b></th>
                    <td><input type='text' name='logo' size='10' onkeyup='this.value=this.value.toUpperCase()' 
                    value='".$fila["logo"]."'>
                    </td>                    
                  </tr>
                  
                     <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='MODIFICAR SINDICATO'  >
                      <input type='hidden' name='id_sindic_taxi' value='".$fila["id_sindic_taxi"]."'>

                    </td>
                  </tr>
                  
                </table>
                </center>";
          echo"</form>" ;   

    
            }
echo "</body>
      </html> ";

 ?>