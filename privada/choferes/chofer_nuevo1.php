<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$ap = $_POST["ap"];
$am = $_POST["am"];
$nomb = $_POST["nomb"];
$ci = $_POST["ci"];
$direccion = $_POST["direcc"];
$telefono = $_POST["telf"];
$Categor_lic = $_POST["Categor_lic"];


if(($nomb!="" )and ($ci!="") ){
   $reg = array();
   $reg["id_sindic_taxi"] = 1;
   $reg["ap"] = $ap;
   $reg["am"] = $am;
   $reg["nomb"] = $nomb;
   $reg["ci"] = $ci;
   $reg["telf"] = $telefono;
   $reg["direcc"] = $direccion;
   $reg["Categor_lic"] = $Categor_lic;

   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("choferes", $reg, "INSERT"); 
   header("Location: choferes.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE LOS CHOFERES";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='chofer_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 