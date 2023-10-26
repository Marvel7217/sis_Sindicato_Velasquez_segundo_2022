<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;


echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript'>
         var ventanaCalendario=false
         function imprimir() {
            ventanaCalendario=window.open('socios_moviles1.php','calendario','width=600,height=550, left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO,satatus=NO,resizable=YES,location=NO')
         }
         </script>

         <script type='text/javascript'>
         var ventanaCalendario=false
         function generar_pdf() {
          ventanaCalendario= window.open('socios_moviles_fechas_pdf.php' , 'calendario','width=600,height=550,left=100,top=100,scrollbars=yes,menubars=no,satatusbar=NO,status=NO,resizable=YES,location=NO')
         }
         </script>
    </head>
       </head>
        <body>
        <a  href='../../listado_tablas.php'>Listado de tablas</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
        echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo"ROL: ".$_SESSION["sesion_rol"]."</h3>";
            echo"<h1>REPORTE DE SOCIOS DE MOVILES</h1>";


$sql = $db->Prepare("SELECT CONCAT_WS('',soc.nombres,soc.ap,soc.am) as socio,mo.modelo,mcho.fec_ini,mcho.fec_fin
                     FROM socios soc
                     INNER JOIN moviles mo ON soc.id_socio=mo.id_socio
                     INNER JOIN moviles_choferes mcho ON mcho.id_movil=mo.id_movil
                     WHERE soc.estado ='A' 
                     AND mo.estado='A' 
                     AND mcho.estado='A'                  
                        ");
$rs = $db->GetAll($sql);
if ($rs) {
    echo"<center>
          <table class='listado'>
            <tr>                                   
              <th>Nro</th><th>SOCIOS</th><th>MODELO DE MOVIL</th><th>FECHA INICIO</th><th>FECHA FIN</th>
              
            </tr>";
            $b=1;
        foreach ($rs as $k => $fila) {                                       
            echo"<tr>
                    <td align='center'>".$b."</td>
                    
                    <td>".$fila['socio']."</td>
                    <td>".$fila['modelo']."</td>
                    <td>".$fila['fec_ini']."</td>
                    <td>".$fila['fec_fin']."</td>
                    
                   
                 </tr>";
                 $b=$b+1;
        }
        echo "</table>
        <h2>
        <input type='radio' name'seleccionar' onclick='javascript:imprimir()''> Imprimir
        </h2>
        <h2>
        <input type='radio' name'seleccionar1' onclick='javascript:generar_pdf()''>Generar pdf
        </h2>
        </center>";
        }
 
echo "</body>
  </html> ";

?> 