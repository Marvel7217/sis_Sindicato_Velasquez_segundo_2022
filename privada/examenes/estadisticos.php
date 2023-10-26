<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

$db->debug=true;


echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript'>
         var ventanaCalendario=false
         function reporte1() {
          ventanaCalendario= window.open('socios_moviles_pdf.php' , 'calendario','width=600,height=550,left=100,top=100,scrollbars=yes,menubars=no,satatusbar=NO,status=NO,resizable=YES,location=NO')
         }
         </script>
         <script type='text/javascript'>
         var ventanaCalendario=false
         function reporte2() {
          ventanaCalendario= window.open('Highcharts/examples/column-basic/index.php', 'calendario','width=600,height=550,left=100,top=100,scrollbars=yes,menubars=no,satatusbar=NO,status=NO,resizable=YES,location=NO')
         }
         </script>

    </head>
    <body>
       <p> &nbsp;</p>";  
      
            echo"<h1>EVALUACION DEL TERCER BIMESTRE</h1>";

    echo"<center>
          <table class='listado'>
            <tr>                                   
              <th>Seleccionar</th>
            </tr>";
                                    
            echo"<tr>
                    <td>
                    <input type='radio' name='seleccionar' onclick='javascript:reporte1()'> Reporte en PDF
                    </td>        
                 </tr>
                 <tr>
                    <td>
                    <input type='radio' name='seleccionar' onclick='javascript:reporte2()'> Columna
                    </td>
                </tr>";

        echo "</table>
        </center>"; 
echo "</body>
  </html> ";
?> 