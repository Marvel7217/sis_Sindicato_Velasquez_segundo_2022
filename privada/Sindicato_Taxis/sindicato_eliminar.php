<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;
$id_sindic_taxi=$_REQUEST["id_sindic_taxi"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
$db->debug=true;      


$sql = $db->Prepare("SELECT *
                     FROM socios
                     WHERE id_sindic_taxi = ? 
                     AND estado <>'x'                    
                        ");
$rs = $db->GetAll($sql,array($id_sindic_taxi));
$sql1 = $db->Prepare("SELECT *
                     FROM pasajeros
                     WHERE id_sindic_taxi = ? 
                     AND estado <>'x'                    
                        ");
$rs1 = $db->GetAll($sql1,array($id_sindic_taxi));
$sql2 = $db->Prepare("SELECT *
                     FROM personas
                     WHERE id_sindic_taxi = ? 
                     AND estado <>'x'                    
                        ");
$rs2 = $db->GetAll($sql2,array($id_sindic_taxi));
$sql3 = $db->Prepare("SELECT *
                     FROM personas_1
                     WHERE id_sindic_taxi = ? 
                     AND estado <>'x'                    
                        ");
$rs3 = $db->GetAll($sql3,array($id_sindic_taxi));
$sql4 = $db->Prepare("SELECT *
                     FROM secretarias
                     WHERE id_sindic_taxi = ? 
                     AND estado <>'x'                    
                        ");
$rs4 = $db->GetAll($sql4,array($id_sindic_taxi));
$sql5 = $db->Prepare("SELECT *
                     FROM viajes
                     WHERE id_sindic_taxi = ? 
                     AND estado <>'x'                    
                        ");
$rs5 = $db->GetAll($sql5,array($id_sindic_taxi));

if(!$rs && !$rs1&&  !$rs2&&  !$rs3&& !$rs4&&  !$rs5){
  $reg = array();
  $reg["estado"] = 'x';
 
  $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
  $rs1 = $db->AutoExecute("sindicato_taxis", $reg, "UPDATE","id_sindic_taxi='".$id_sindic_taxi."'"); 
  header("Location:Sindicato_Taxis.php");
  exit();
} else {
          echo"<div class='mensaje'>";
       $mensage = "NO SE ELIMINARON LOS DATOS DE LA PERSONA POR QUE TIENE HERENCIA";
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