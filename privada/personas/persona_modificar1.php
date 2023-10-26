<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       

$id_persona_1=$_POST["id_persona_1"];
$ap = $_POST["ap"];
$am = $_POST["am"];
$nombres = $_POST["nombres"];
$ci = $_POST["ci"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];

//$db->debug=true;


if(($nombres!="" )and ($ci!="")  ){
   $reg = array();
   $reg["id_sindic_taxi"] = 1;
   $reg["ap"] = $ap;
   $reg["am"] = $am;
   $reg["nombres"] = $nombres;
   $reg["ci"] = $ci;
   $reg["telefono"] = $telefono;
   $reg["direccion"] = $direccion;


 
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("personas_1", $reg, "UPDATE","id_persona_1='".$id_persona_1."'"); 
   header("Location: personas.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DE LA PERSONA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='personas.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;'
                   value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 