<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html>
      <head>
          <script type='text/javascript'>
          var ventanaCalendario=false
          function imprimir(){
            if(confirm(' Desea Imprimir ?')){
                window.print();
            }
        }
        </script>
    </head>
    <body style='cursor:pointer;cursor:hand' onClick='imprimir();'>";
    $sql=$db->Prepare("SELECT CONCAT_WS('',p.nombre,p.ap,p.am) as propietario, o.nombre,o.direccion 
                                    FROM propietarios p
                                    INNER JOIN obras o ON p.id_propietario=o.id_propietario
                               
                                ");
    $rs=$db->GetAll($sql);
    $sql1=$db->Prepare("SELECT *
                        FROM sindicato_taxis
                        WHERE id_sindic_taxi=1
                        AND estado<>'x'
                        ");
    $rs1=$db->GetAll($sql1);

    $nombre=$rs1[0]["nombre"];
    $logo=$rs1[0]["logo"];
    $fecha=date("y-m-d H:i:s");
    if($rs){
        echo"<table width='100%' border='0'>
             <tr>
                <td><img src='../sindicato_taxis/logos/{$logo}' width='30%'></td>
                <td text-align='center' width='70%'><h1>REPORTE DE PROPIETARIOS-OBRAS</h1></td>
            </tr>
        </table>";
    echo"
    <center>
     <table border ='1' cellspacing='0'>
      <tr>
       <th>Nro</th><th>NOMBRE DE OBRA</th><th>DIRECCION</th>
    </tr>";
    $b=1;
    foreach($rs as $k=>$fila){
        echo"<tr>
               <td align='center'>".$b."</td>
               <td>".$fila['propietario']."</td>
               <td><i>".$fila['nombre']."</i></td>
               <td><i>".$fila['direccion']."</i></td>
            </tr>";
        $b=$b+1;
    }
    echo"</table><br>
    <b>Fecha: </b>".$fecha."</center>";             
    }
    echo"</body>
    </html>";
?>