<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$tapiceria = $_REQUEST["tapiceria"];
$fecha = date("Y-m-d H:i:s");

if($tapiceria== "T"){
    $sql = $db->Prepare("SELECT CONCAT_WS(' ',tapic.nombre,tapic.direccion) AS tapiceria, CONCAT_WS(' ',tapiz.monto_estimado,tapiz.objeto,tapiz.tipo_tapizado,tapiz.color,tapiz.diseno) AS tapizado
                        FROM tapiceria tapic
                        INNER JOIN tapizados tapiz ON tapic.id_tapiceria=tapiz.id_tapiceria
                        ");
    $rs =$db->GetAll($sql);
}else{
    $sql = $db->Prepare("SELECT CONCAT_WS(' ',tapiz.monto_estimado,tapiz.objeto,tapiz.tipo_tapizado,tapiz.color,tapiz.diseno) AS tapizado, 
                        CASE
                        WHEN nombre= 'Tapiceria Mary' THEN 'Tapiceria Mary'
                        WHEN nombre= 'Tapiceria L&M' THEN 'Tapiceria L&M'
                        WHEN nombre= 'Tapiceria ABC' THEN 'Tapiceria ABC'
                        END AS tapiceria
                        FROM tapiceria tapic
                        INNER JOIN tapizados tapiz ON tapic.id_tapiceria=tapiz.id_tapiceria
                        WHERE tapic.nombre=?
                        ");
$rs =$db->GetAll($sql, array($tapiceria));
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
        <td align='center' width='80%'><h1>REPORTES DE TAPICERIA CON TAPIZADOS</h1></td>
        </tr>
        </table>";
echo"
        <center>
        <table border='1' cellspacing='0'>
        <tr>
        <th>Nro</th><th>TAPICERIA</th><th>TAPIZADOS</th>
        </tr>";
        $b=1;
        foreach ($rs as $k => $fila) {
        echo"<tr>
            <td align='center'>".$b."</td>
            <td>".$fila['tapiceria']."</td>
            <td><i>".$fila['tapizado']."</i></td>
        </tr>";
        $b=$b+1;
        }
        echo"</table><br>
        <b>Fecha :</b>".$fecha."<b></b></center>";
    }
    echo "</body>
        </html> ";
?>



