<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$id_asociacion= $_POST["id_asociacion"];
$instrumento = $_POST["instrumento"];
$codigo = $_POST["codigo"];


if(($id_asociacion!="") and  ($instrumento!="") and ($codigo!="")){
   $reg = array();
   $reg["id_asociacion"] = $id_asociacion;
   $reg["instrumento"] = $instrumento;
   $reg["codigo"] = $codigo;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["instrumento"] = $_SESSION["sesion_id_instrumento"];   
   $rs1 = $db->AutoExecute("instrumentos", $reg, "INSERT"); 
   header("Location: asociacion.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL INATRUMENTOS";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='instrumento_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' 
                  value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 