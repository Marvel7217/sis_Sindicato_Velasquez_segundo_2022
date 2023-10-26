<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

$db->debug=true;
$id_usuario=$_REQUEST["id_usuario"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
$db->debug=true;      


$sql = $db->Prepare("SELECT *
                     FROM usuarios
                     WHERE id_usuario = ? 
                     AND estado <>'x'                    
                        ");
$rs = $db->GetAll($sql,array($id_usuario));
if(!$rs){
  $reg = array();
  $reg["estado"] = 'x';
 
  $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
  $rs1 = $db->AutoExecute("usuarios", $reg, "UPDATE","id_usuario='".$id_usuario."'"); 
  header("Location:usuarios.php");
  exit();
} else {
  require_once("../../libreria_menu.php");
          echo"<div class='mensaje'>";
       $mensage = "NO SE ELIMINARON LOS DATOS DEL USUARIO POR QUE TIENE HERENCIA";
       echo"<h1>".$mensage."</h1>";
       
       echo"<a href='usuarios.php'>
                 <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;'
                  value='VOLVER>>>>'></input>
            </a>     
           ";
      echo"</div>" ;
  }

            
echo "</body>
      </html> ";

 ?>