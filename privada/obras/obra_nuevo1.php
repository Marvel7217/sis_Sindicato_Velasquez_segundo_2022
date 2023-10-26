<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$id_propietario = $_POST["id_propietario"];
$id_obra= $_POST["id_obra"];
$nombre = $_POST["nombre"];
$cod = $_POST["cod"];
$direccion = $_POST["direccion"];


if(($id_propietario!="") and  ($nombre!="") and ($cod!="") and ($direccion!="")){
   $reg = array();
   $reg["id_propietario"] = $id_propietario;
   $reg["nombre"] = $nombre;
   $reg["cod"] = $cod;
   $reg["direccion"] = $direccion;
   $reg["usuario"] = $_SESSION["sesion_id_obra"]; 
   $rs = $db->AutoExecute("obras", $reg, "INSERT", "id_obra='".$id_obra."'"); 
   header("Location: obras.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE LA OBRA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='obra_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' 
                  value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 