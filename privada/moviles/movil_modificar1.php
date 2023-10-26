<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$id_socio= $_POST["id_socio"];
$id_movil = $_POST["id_movil"];
$numero = $_POST["numero"];
$placa = $_POST["placa"];
$modelo = $_POST["modelo"];


if(($id_socio!="") and  ($numero!="") and ($placa!="")and ($modelo!="")){
   $reg = array();
   $reg["id_socio"] = $id_socio;
   $reg["numero"] = $numero;
   $reg["placa"] = $placa;
   $reg["modelo"] = $modelo;

   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs = $db->AutoExecute("moviles", $reg, "UPDATE", "id_movil='".$id_movil."'"); 
   header("Location: moviles.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DE LOS MOVILES";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='moviles.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'>
                  </input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 