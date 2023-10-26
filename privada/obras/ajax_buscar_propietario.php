<?php
session_start();

require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
       
$paterno = $_POST["paterno"];
$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$ci = $_POST["ci"];

//$db->debug=true;

if($paterno or $nombre or $direccion or $ci){
    $sql3 = $db->Prepare("SELECT *
                          FROM propietarios
                          WHERE paterno LIKE ? 
                          AND nombre LIKE ? 
                          AND direccion LIKE ?
                          AND ci LIKE ?                      
                        ");
$rs3 = $db->GetAll($sql3, array($paterno."%", $nombre."%", $direccion."%", $ci."%"));

    if($rs3){
        echo"<center>
              <table width='60%' border='1'>
                <tr>                                   
                  <th>C.I.</th><th>PATERNO</th><th>MATERNO</th><th>NOMBRES<th>?</th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila["ci"];
                 $str1 = $fila["paterno"];
                 $str2 = $fila["nombre"];
                 $str3 = $fila["direccion"];
            echo"<tr>
                    <td align='center'>".resaltar($ci, $str)."</td>
                    <td>".resaltar($paterno, $str1)."</td>
                    <td>".resaltar($nombre, $str2)."</td>
                    <td>".resaltar($direccion, $str3)."</td>
                    <td align='center'>
                      <input type='radio' name='opcion' value='' onClick='buscar_persona(".$fila["id_propietario"].")'>
                    </td>
                  </tr>";
        }
            echo "</table>
            </center>";
    }else{
        echo"<center><b> EL PROPIETARIO NO EXISTE!!</b></center><br>";
        echo"<center>
          <table class='listado'>
          <tr>
            <td><b>(*)CI</b></td>
            <td><input type='text' name='ci1' size='10'></td>
          </tr>
          <tr>
            <td><b>Paterno</b></td>
            <td><input type='text' name='paterno1' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
          </tr>
          <tr>
            <td><b>(*)Nombres</b></td>
            <td><input type='text' name='nombre1' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
          </tr>
          <tr>
            <td><b>Direccion</b></td>
            <td><input type='text' name='direccion1' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
          </tr>
          <tr>
            <td><b>Telefono</b></td>
            <td><input type='text' name='telefono1' size='10'></td>
          </tr>
          <tr>
            <td align='center' colspan='2'>
            <input type='button' value='ADICIONAR PROPIETARIO' onClick='insertar_propietario()' ></td>
          </tr>
        </table>
        </center>
        ";

    }
}
?> 