<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");



//$db->debug=true;
$id_socio=$_REQUEST["id_socio"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";

$sql = $db->Prepare("SELECT *
                     FROM moviles
                     WHERE id_socio = ? 
                     AND estado <>'x'                    
                        ");
$rs = $db->GetAll($sql,array($id_socio));
if(!$rs){
  
  $reg = array();
  $reg["estado"] = 'x';
  $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
  $rs1 = $db->AutoExecute("socios", $reg, "UPDATE","id_socio='".$id_socio."'"); 
  header("Location:socios.php");
  exit();
} else {
  require_once("../../libreria_menu.php");

          echo"<div class='mensaje'>";
       $mensage = "NO SE ELIMINARON LOS DATOS DE SOCIOS POR QUE TIENE HERENCIA";
       echo"<h1>".$mensage."</h1>";
       
       echo"<a href='socios.php'>
                 <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;'
                  value='VOLVER>>>>'></input>
            </a>     
           ";
      echo"</div>" ;
  }

            
echo "</body>
      </html> ";

 ?>