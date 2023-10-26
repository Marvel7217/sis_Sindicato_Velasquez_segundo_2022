<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
  
$id_sindic_taxi = $_POST["id_sindic_taxi"];
$nombres = $_POST["nombres"];
$ap = $_POST["ap"];
$am = $_POST["am"];


if(($id_sindic_taxi!="") and  ($nombres!="") and ($ap!="")and ($am!="")){
   $reg = array();
   $reg["id_sindic_taxi"] = $id_sindic_taxi;
   $reg["nombres"] = $nombres;
   $reg["ap"] = $ap;
   $reg["am"] = $am;

   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["socio"] = $_SESSION["sesion_id_socio"];   
   $rs1 = $db->AutoExecute("socios", $reg, "INSERT"); 
   header("Location: socios.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL USUARIO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='socio_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;'
                   value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 