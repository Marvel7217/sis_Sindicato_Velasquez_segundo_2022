<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");


$db->debug=true;
$id_movil=$_REQUEST["id_movil"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
$db->debug=true;      


$sql = $db->Prepare("SELECT *
                     FROM moviles_choferes
                     WHERE id_movil = ? 
                     AND estado <>'x'                    
                        ");
$rs = $db->GetAll($sql,array($id_movil));
if(!$rs){
  $reg = array();
  $reg["estado"] = 'x';
 
  $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
  $rs1 = $db->AutoExecute("moviles", $reg, "UPDATE","id_movil='".$id_movil."'"); 
  header("Location:moviles.php");
  exit();
} else {
  require_once("../../libreria_menu.php");
          echo"<div class='mensaje'>";
       $mensage = "NO SE ELIMINARON LOS DATOS DEL MOVIL POR QUE TIENE HERENCIA";
       echo"<h1>".$mensage."</h1>";
       
       echo"<a href='moviles.php'>
                 <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;'
                  value='VOLVER>>>>'></input>
            </a>     
           ";
      echo"</div>" ;
  }

            
echo "</body>
      </html> ";

 ?>