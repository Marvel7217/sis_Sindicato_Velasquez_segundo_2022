<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$cliente = $_REQUEST["cliente"];
$fecha = date("Y-m-d H:i:s");

if($cliente== "T"){
    $sql = $db->Prepare("SELECT CONCAT_WS(' ',cli.nombre,cli.ap,cli.am) AS cliente, CONCAT_WS(' ',mov.placa,mov.marca,mov.color) AS movilidad
                        FROM clientes cli
                        INNER JOIN movilidades mov ON mov.id_cliente=cli.id_cliente
                        ");
    $rs =$db->GetAll($sql);
}else{
    $sql = $db->Prepare("SELECT CONCAT_WS(' ',mov.placa,mov.marca,mov.color) AS movilidad, 
                        CASE
                        WHEN nombre= 'jose luis' THEN 'jose luis'
                        WHEN nombre= 'jose carlos' THEN 'jose carlos'
                        WHEN nombre= 'exel moises' THEN 'exel moises'
                        WHEN nombre= 'efrain' THEN 'efrain'
                        WHEN nombre= 'gonzalo' THEN 'gonzalo'
                        END AS cliente
                        FROM clientes cli
                        INNER JOIN movilidades mov  ON mov.id_cliente=cli.id_cliente
                        WHERE cli.nombre=?
                        ");
$rs =$db->GetAll($sql, array($cliente));
}

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
        <td align='center' width='80%'><h1>REPORTES DE CLIENTES CON MOVILIDADES</h1></td>
        </tr>
        </table>";
echo"
        <center>
        <table border='1' cellspacing='0'>
        <tr>
        <th>Nro</th><th>CLIENTE</th><th>MOVILIDADES</th>
        </tr>";
        $b=1;
        foreach ($rs as $k => $fila) {
        echo"<tr>
            <td align='center'>".$b."</td>
            <td>".$fila['cliente']."</td>
            <td><i>".$fila['movilidad']."</i></td>
        </tr>";
        $b=$b+1;
        }
        echo"</table><br>
        <b>Fecha :</b>".$fecha."<b></b></center>";
    }
    echo "</body>
        </html> ";
?>