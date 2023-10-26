<?php
session_start();

require_once("../../conexion.php");

       
$ap1 = $_POST["paterno1"];
$nombres1 = $_POST["nombre1"];
$ci1 = $_POST["ci1"];
$direccion1 = $_POST["direccion1"];
$telefono1 = $_POST["telefono1"];


$reg = array();
$reg["id_sindic_taxi"] = 1;
$reg["paterno"] = $ap1;
$reg["nombre"] = $nombres1;
$reg["ci"] = $ci1;
$reg["direccion"] = $direccion1;
$reg["telefono"] = $telefono1;
$rs1 =$db->AutoExecute("propietarios", $reg, "INSERT"); 


?> 