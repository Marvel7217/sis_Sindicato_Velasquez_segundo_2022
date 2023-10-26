<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;
$id_propietario=$_REQUEST["id_propietario"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
$db->debug=true;      


$sql = $db->Prepare("SELECT *
                     FROM obras
                     WHERE id_propietario = ?                   
                        ");
$rs = $db->GetAll($sql,array($id_propietario));
if(!$rs){
    $reg = array("id_propietario"=>$id_propietario);
    $rs1 = $db->Execute("DELETE FROM propietarios  WHERE id_propietario=?", $reg);
    header("Location:propietarios.php");
    exit();
} else {
          echo"<div class='mensaje'>";
       $mensage = "NO SE ELIMINARON LOS DATOS DEL PROPIETARIO POR QUE TIENE HERENCIA";
       echo"<h1>".$mensage."</h1>";
       
       echo"<a href='propietarios.php'>
                 <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;'
                  value='VOLVER>>>>'></input>
            </a>     
           ";
      echo"</div>" ;
  }

            
echo "</body>
      </html> ";

 ?>