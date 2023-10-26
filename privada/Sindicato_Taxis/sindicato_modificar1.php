<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       

$id_sindic_taxi=$_POST["id_sindic_taxi"];
$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$logo = $_POST["logo"];

if(($nombre!="" ) ){
   $reg = array();
   $reg["id_sindic_taxi"] = 1;
   $reg["nombre"] = $nombre;
   $reg["direccion"] = $direccion;
   $reg["logo"] = $logo;


 
   $reg["usuario"] = $_SESSION["sesion_id_sindic_taxi"];   
   $rs1 = $db->AutoExecute("sindicato_taxis", $reg, "UPDATE","id_sindic_taxi'".$id_sindic_taxi."'"); 
   header("Location: Sindicato_Taxis.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DEL SINDICATO DE TAXIS";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='Sindicato_Taxis.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;'
                   value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 