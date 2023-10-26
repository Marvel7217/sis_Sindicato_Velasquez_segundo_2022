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
       <p> &nbsp;</p> ";
      /* <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='socios.php'>Listado de Usuarios</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' 
       style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
       echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo"ROL: ".$_SESSION["sesion_rol"]."</h3>";
         echo"<h1>INSERTAR SOCIO</h1>";*/

//Para cada herencia es una consulta

$sql = $db->Prepare("SELECT CONCAT_WS(' ' , nombre,direccion,logo) as sindicato, id_sindic_taxi
                     FROM sindicato_taxis
                     WHERE estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);
 /*  if ($rs) {*/
 
        echo"<form action='socio_nuevo1.php' method='post' name='formu'>";
        echo"<center>
        <h1>INSERTAR SOCIO</h1>
                <table class='listado'>

                  <tr>
                    <th>(*)Sindicato</th>
                    <td>
                      <select name='id_sindic_taxi'>
                        <option value=''>--Seleccione--</option>";
                        foreach ($rs as $k => $fila) {
                        echo"<option value='".$fila['id_sindic_taxi']."'>".$fila['sindicato']."</option>";    
                        }  

                echo"</select>
                    </td>
                  </tr>";
             echo"<tr>
                    <th><b>(*)Nombre de Socio</b></th>
                    <td><input type='text' name='nombres' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Paterno</b></th>
                    <td><input type='text' name='ap' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>Materno</b></th>
                    <td><input type='text' name='am' size='10'></td>
                  </tr>}
                  <tr>
                    <th><b>CI</b></th>
                    <td><input type='text' name='ci' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>TELEFONO</b></th>
                    <td><input type='text' name='telf' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>FECHA DE NACIMIENTO</b></th>
                    <td><input type='date' name='fec_nac' size='10'></td>
                  </tr>

                  <tr>
                    <th><b>Genero</b></th>";
                    if($fila["genero"]='F')
                    echo"<td><input type='radio' name='genero' size='10' value='F'checked>Femenino
                    <input type='radio' name='genero' size='10' value='M'checked>Masculino<br>
                    </td>";
                    else
                    echo"<td><input type='radio' name='genero' size='10' value='F'checked>Femenino
                    <input type='radio' name='genero' size='10' value='M'checked>Masculino<br>
                    </td>";
                    echo"</tr>
                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR SOCIO'><br>
                      (*)Datos Obligatorios
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>