<?php
session_start();

require_once("../../conexion.php");

       
$nombre1 = $_POST["nombre1"];
$direccion1 = $_POST["direccion1"];
$telefono1 = $_POST["telefono1"];
$correo1 = $_POST["correo1"];



$reg = array();
$reg["id_sindic_taxi"] = 1;
$reg["nombre"] = $nombre1;
$reg["direccion"] = $direccion1;
$reg["telefono"] = $telefono1;
$reg["correo"] = $correo1;
$reg["fec_insercion"] = date("Y-m-d H:i:s");
$rs1 =$db->AutoExecute("asociacion", $reg, "INSERT"); 


?> 