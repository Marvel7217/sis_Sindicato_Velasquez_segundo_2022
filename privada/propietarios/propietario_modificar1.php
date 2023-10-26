<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       

$id_propietario=$_POST["id_propietario"];
$ap = $_POST["ap"];
$am = $_POST["am"];
$nombre = $_POST["nombre"];
$ci = $_POST["ci"];
$direccion = $_POST["direccion"];
$telef = $_POST["telef"];

//$db->debug=true;

if(($nombre!="" )and ($ci!="")  ){
   $reg = array();
   $reg["id_sindic_taxi"] = 1;
   $reg["ap"] = $ap;
   $reg["am"] = $am;
   $reg["nombre"] = $nombre;
   $reg["ci"] = $ci;
   $reg["telef"] = $telef;
   $reg["direccion"] = $direccion;


 
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("propietarios", $reg, "UPDATE","id_propietario='".$id_propietario."'"); 
   header("Location: propietarios.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DEL PROPIETARIO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='propietarios.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;'
                   value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 