<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

$fecha1 = $_REQUEST["fecha1"];
$fecha2 = $_REQUEST["fecha2"];

$fecha11 =DATE($fecha1);
$fecha22 =DATE ($fecha2);

$sql = $db->Prepare("SELECT CONCAT_WS(' ', nombres, ap, am) as persona, fec_insercion
                FROM personas_1
                WHERE fec_insercion BETWEEN ? AND ?
                AND estado <> 'X'
                ");
$rs =$db->GetAll($sql, array($fecha1, $fecha2));

$sql1 = $db->Prepare("SELECT *
                    FROM sindicato_taxis
                    WHERE id_sindic_taxi = 1
                    AND estado <> 'X'
                    ");
$rs1 = $db->GetAll($sql1);
$nombre = $rs1[0]["nombre"];
$logo = $rs1[0]["logo"];
echo"<html1>
    <head>
        <script type='text/javascript'>
        var ventanaCalendario=false
        function imprimir() {
        if (confirm('Desea Imprimir ?')){
        window.print();
        }
    }
 </script>
</head>
<body style='cursor:pointer;cursor:hand' onClick='imprimir();'>";

if ($rs) {
        echo"<table width='100%'' border='0'>
        <tr>
        <td ><img src='../Sindicato_Taxis/logos/{$logo}' width='70%' ></td>
        <td align='center' width='80%'><h1>REPORTES DE PERSONAS CON FECHAS DE
        INSERCION</h1></td>
        </tr>
        </table>";
echo"
        <center>
        <table border='1' cellspacing='0'>
        <tr>
        <th>Nro</th><th>PERSONAS</th><th>FECHA DE INSERCION</th>
        </tr>";
        $b=1;
        foreach ($rs as $k => $fila) {
        echo"<tr>
            <td align='center'>".$b."</td>
            <td>".$fila['persona']."</td>
            <td><i>".$fila['fec_insercion']."</i></td>

        </tr>";
        $b=$b+1;
        }
        echo"</table><br>
        <b>DEL :</b>".$fecha11."<b>AL :</b>".$fecha22."
        </center>";
    }
    echo "</body>
        </html> ";
?>



