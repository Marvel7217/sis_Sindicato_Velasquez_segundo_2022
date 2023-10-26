<?php
//Llamar a una libreria perimite utilizar el base detos
//adodb es una libreria
require_once("adodb/adodb.inc.php");

// Aqui esta definiendo variable_tener cuenta las mayusculas
$conServidor = "localhost";
$conUsuario = "root";
$conClave = "";
$conBasededatos = "Sindicato_Taxis_Seg1";

$db = ADONewConnection("mysqli");

//$db-> debug = true;

$conex = $db->Connect($conServidor, $conUsuario, $conClave, $conBasededatos);
$db->Execute("SET NAMES 'utf8'"); // reconoce las ñ y los asentos
?>