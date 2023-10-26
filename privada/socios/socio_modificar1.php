<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";

 $id_sindic_taxi= $_POST["id_sindic_taxi"];      
 $id_socio = $_POST["id_socio"];


$ci = $_POST["ci"];
$ap = $_POST["ap"];
$am = $_POST["am"];
$nombres = $_POST["nombres"];
$telf = $_POST["telf"];
$fec_nac = $_POST["fec_nac"];
$genero = $_POST["genero"];


if(($id_sindic_taxi!="") and  ($nombres!="") and ($ci!="")and ($ap!="")and ($am!="")and ($telf!="")and ($fec_nac!="")and ($genero!="")){
   $reg = array();
   $reg["id_sindic_taxi"] = $id_sindic_taxi;
   $reg["nombres"] = $nombres;
   $reg["ci"] = $ci;
   $reg["ap"] = $ap;
   $reg["am"] = $am;
   $reg["telf"] = $telf;
   $reg["fec_nac"] = $fec_nac;
   $reg["genero"] = $genero;

   $reg["usuario"] = $_SESSION["sesion_id_socio"];   
   $rs = $db->AutoExecute("socios", $reg, "UPDATE", "id_socio='".$id_socio."'"); 
   header("Location: socios.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DEL USUARIO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='socios.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'>
                  </input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 