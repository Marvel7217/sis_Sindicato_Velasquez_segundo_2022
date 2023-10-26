<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       

$id_chofer=$_POST["id_chofer"];
$ap = $_POST["ap"];
$am = $_POST["am"];
$nombres = $_POST["nomb"];
$ci = $_POST["ci"];
$direccion = $_POST["direcc"];
$telefono = $_POST["telf"];
$Categor_lic = $_POST["Categor_lic"];

//$db->debug=true;


if(($nombres!="" )and ($ci!="")  ){
   $reg = array();
   $reg["id_sindic_taxi"] = 1;
   $reg["ap"] = $ap;
   $reg["am"] = $am;
   $reg["nomb"] = $nombres;
   $reg["ci"] = $ci;
   $reg["telf"] = $telefono;
   $reg["direcc"] = $direccion;
   $reg["Categor_lic"] = $Categor_lic;


 
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("choferes", $reg, "UPDATE","id_chofer='".$id_chofer."'"); 
   header("Location: choferes.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DE LOS CHOFERES";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='choferes.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;'
                   value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 