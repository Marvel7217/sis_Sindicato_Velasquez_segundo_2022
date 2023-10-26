<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;
$id_obra=$_REQUEST["id_obra"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";

  $reg = array("id_obra"=>$id_obra);

 
  $rs1 = $db->Execute("DELETE 
                      FROM obras 
                      WHERE id_obra=?",
                      $reg); 
  header("Location:obras.php");
  exit();


 ?>