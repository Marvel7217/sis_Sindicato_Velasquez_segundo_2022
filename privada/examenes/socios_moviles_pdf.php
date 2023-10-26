<?php
ob_start();
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html>
      <head>
    </head>
    <body>";
    $sql=$db->Prepare("SELECT CONCAT_WS('',cho.nomb,cho.ap,cho.am) as chofer,moch.fec_ini
    FROM choferes cho
    INNER JOIN moviles_choferes moch ON cho.id_chofer=moch.id_chofer
    WHERE cho.estado ='A' 
    AND moch.estado='A'");                        
                                    $rs=$db->GetAll($sql);
    $sql1=$db->Prepare("SELECT *
                        FROM Sindicato_Taxis
                        WHERE id_sindic_taxi=1
                        AND estado<>'x'
                        ");
    $rs1=$db->GetAll($sql1);

    $nombre=$rs1[0]["nombre"];
    $logo=$rs1[0]["logo"];
    $fecha=date("y-m-d H:i:s");
    if($rs){
        echo"<table border='0' width='100%' >
             <tr>
                <td><img src='http://".$_SERVER['HTTP_HOST']."/sis_Sindicato_Velasquez_segundo_2022/privada/sindicato_taxis/logos/{$logo}' width='100%'></td>
           
                <td align='center' width='80%'><h1>REPORTE DE CHOFERES-FECHAS DE VIAJE</h1></td>
            </tr>
        </table>";
    echo"
    <center>
     <table border ='1' cellspacing='0'>
      <tr>
      <th>Nro</th><th>CHOFERES</th><th>FECHAS DE VIAJE</th>
    </tr>";
    $b=1;
    foreach($rs as $k=>$fila){
        echo"<tr>
               <td align='center'>".$b."</td>
               <td>".$fila['chofer']."</td>
               <td><i>".$fila['fec_ini']."</i></td>
            </tr>";
        $b=$b+1;
    }
    echo"</table><br>
    <b>Fecha: </b>".$fecha."</center>";             
    }
    echo"</body>
    </html>";



    $html=ob_get_clean();

    require_once("../dompdf/autoload.inc.php");
    use Dompdf\Dompdf;
    $dompdf =new Dompdf();

    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnable' => true));
    $dompdf->setOptions($options);

    $dompdf->loadHtml($html);
    $dompdf->setPaper('letter');
    //$dompdf->setPaper('A4','landscape');

    $dompdf->render();

    $dompdf->stream("archivo.pdf",array("Attachment"=> false));
?>
