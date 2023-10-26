<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       



$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$logo = $_POST["logo"];



if(($nombre!="" )and ($direccion!="") ){
   $reg = array();
   $reg["id_sindic_taxi"] = 1;
   $reg["nombre"] = $nombre;
   $reg["direccion"] = $direccion;
   $reg["logo"] = $logo;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_sindic_taxi"];   
   $rs1 = $db->AutoExecute("sindicato_taxis", $reg, "INSERT"); 
   header("Location: Sindicato_Taxis.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL SINDICATO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='sindicato_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' 
                  value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 