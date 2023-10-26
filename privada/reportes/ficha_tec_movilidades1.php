<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$id_cliente = $_REQUEST["id_movilidad"];


$sql = $db->Prepare("SELECT cli.*,mov.*
                    FROM clientes cli
                    INNER JOIN movilidades mov ON cli.id_cliente=mov.id_cliente
                    WHERE cli.id_cliente = ?
                ");
$rs =$db->GetAll($sql, array($id_cliente));

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
        <td align='center' width='80%'><h1>FICHA TECNICA DE CLIENTE</h1></td>
        </tr>
        </table>";
echo"
        <center>
        <table border='1' cellspacing='0'>";
        $b=1;
        foreach ($rs as $k => $fila) {
    echo"<tr>
     <th align='right'>NOMBRE CLIENTE</th><th>:</th>
     <td><input type='text' name='nombre' value='".$fila["nombre"]."' disabled=''> </td>
    </tr>
  <tr>
  <th align='right'>PLACA</th><th>:</th>
  <td><input type='text' name='placa' value='".$fila["placa"]."' disabled=''> </td>
 </tr>
 <tr>
 <th align='right'>MARCA</th><th>:</th>
 <td><input type='text' name='marca' value='".$fila["marca"]."' disabled=''> </td>
</tr>
<tr>
<th align='right'>COLOR</th><th>:</th>
<td><input type='text' name='color' value='".$fila["color"]."' disabled=''> </td>
</tr>

<tr>";
 

  echo "</td>
  </tr>
  </table>";
  $b=$b+1;
}
}
echo "</body>
 </html>";
?>