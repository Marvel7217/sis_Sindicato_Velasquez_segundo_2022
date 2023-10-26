<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

$categoria = $_REQUEST["categoria"];
$fecha = date("Y-m-d H:i:s");

if($categoria== "T"){
    $sql = $db->Prepare("SELECT CONCAT_WS(' ', ap, am, nomb) AS chofer,Categor_lic as categoria
                        FROM choferes
                        WHERE estado <> 'X'
                        ");
    $rs =$db->GetAll($sql);
}else{
    $sql = $db->Prepare("SELECT CONCAT_WS(' ', ap, am, nomb) AS chofer,
                        CASE
                        WHEN Categor_lic= 'A' THEN 'A'
                        WHEN Categor_lic= 'B' THEN 'B'
                        WHEN Categor_lic= 'C' THEN 'C'
                        END AS categoria
                               FROM choferes 
                               WHERE Categor_lic= ?
                               AND estado <> 'X'
                        ");
$rs =$db->GetAll($sql, array($categoria));
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
        <td align='center' width='80%'><h1>REPORTES DE PERSONAS CON CATEGORIA DE LICENCIA</h1></td>
        </tr>
        </table>";
echo"
        <center>
        <table border='1' cellspacing='0'>
        <tr>
        <th>Nro</th><th>PERSONAS</th><th>CATEGORIA</th>
        </tr>";
        $b=1;
        foreach ($rs as $k => $fila) {
        echo"<tr>
            <td align='center'>".$b."</td>
            <td>".$fila['chofer']."</td>
            <td><i>".$fila['categoria']."</i></td>
        </tr>";
        $b=$b+1;
        }
        echo"</table><br>
        <b>Fecha :</b>".$fecha."<b></b></center>";
    }
    echo "</body>
        </html> ";
?>



