<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$id_tapizado = $_REQUEST["id_tapizado"];


$sql = $db->Prepare("SELECT tapiz.monto_estimado,tapiz.objeto,tapiz.tipo_tapizado,tapiz.color,tapiz.diseno,tapic.nombre,tapic.direccion
                    FROM tapiceria tapic
                    INNER JOIN tapizados tapiz ON tapic.id_tapiceria=tapiz.id_tapiceria
                    WHERE id_tapizado = ?
                ");
$rs =$db->GetAll($sql, array($id_tapizado));

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
        <td align='center' width='80%'><h1>FICHA TECNICA DE TAPIZADO</h1></td>
        </tr>
        </table>";
echo"
        <center>
        <table border='1' cellspacing='0'>";
        $b=1;
        foreach ($rs as $k => $fila) {
    echo"<tr>
     <th align='right'>MONTO ESTIMADO</th><th>:</th>
     <td><input type='text' name='monto_estimado' value='".$fila["monto_estimado"]."' disabled=''> </td>
    </tr>
  <tr>
  <th align='right'>OBJETO</th><th>:</th>
  <td><input type='text' name='objeto' value='".$fila["objeto"]."' disabled=''> </td>
 </tr>
 <tr>
 <th align='right'>Tipo de Tapizado</th><th>:</th>
 <td><input type='text' name='tipo_tapizado' value='".$fila["tipo_tapizado"]."' disabled=''> </td>
</tr>
<tr>
<th align='right'>COLOR</th><th>:</th>
<td><input type='text' name='color' value='".$fila["color"]."' disabled=''> </td>
</tr>
<tr>
<th align='right'>DISENO</th><th>:</th>
<td><input type='text' name='diseno' value='".$fila["diseno"]."' disabled=''> </td>
</tr>
<tr>
<th align='right'>DIRECCION</th><th>:</th>
<td><input type='text' name='direccion' value='".$fila["direccion"]."' disabled=''> </td>
</tr>
<tr>
<th align='right'>NOMBRE</th><th>:</th>
<td><input type='text' name='nombre' value='".$fila["nombre"]."' disabled=''> </td>
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


