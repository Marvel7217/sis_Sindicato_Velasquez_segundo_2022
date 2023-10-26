<?php
session_start();

require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
       
$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];

$db->debug=true;

if($nombre or $direccion or $telefono or $correo){
    $sql3 = $db->Prepare("SELECT *
                          FROM asociacion
                          WHERE nombre LIKE ? 
                          AND direccion LIKE ? 
                          AND telefono LIKE ?
                          AND correo LIKE ?                    
                        ");
$rs3 = $db->GetAll($sql3, array($nombre."%", $direccion."%", $telefono."%", $correo."%"));

    if($rs3){
        echo"<center>
              <table width='60%' border='1'>
                <tr>                                   
                  <th>NOMBRE</th><th>DIRECCION</th><th>TELEFONO</th><th>CORREO<th>?</th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila["nombre"];
                 $str1 = $fila["direccion"];
                 $str2 = $fila["telefono"];
                 $str3 = $fila["correo"];
            echo"<tr>
                    <td align='center'>".resaltar($correo, $str)."</td>
                    <td>".resaltar($nombre, $str1)."</td>
                    <td>".resaltar($direccion, $str2)."</td>
                    <td>".resaltar($telefono, $str3)."</td>
                    <td align='center'>
                      <input type='radio' name='opcion' value='' onClick='buscar_asociacion(".$fila["id_asociacion"].")'>
                    </td>
                  </tr>";
        }
            echo "</table>
            </center>";
    }else{
        echo"<center><b> LA ASOCIACION NO EXISTE!!</b></center><br>";
        echo"<center>
          <table class='listado'>
          <tr>
            <td><b>(*)NOMBRE</b></td>
            <td><input type='text' name='nombre1' size='10'></td>
          </tr>
          <tr>
            <td><b>DIRECCION</b></td>
            <td><input type='text' name='direccion1' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
          </tr>
          <tr>
            <td><b>TELEFONO</b></td>
            <td><input type='text' name='telefono1' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
          </tr>
          <tr>
            <td><b>(*)CORREO</b></td>
            <td><input type='text' name='correo1' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
          </tr>
          <tr>
            <td align='center' colspan='2'>
            <input type='button' value='ADICIONAR ASOCIACION' onClick='insertar_asociacion()' ></td>
          </tr>
        </table>
        </center>
        ";

    }
}
?> 