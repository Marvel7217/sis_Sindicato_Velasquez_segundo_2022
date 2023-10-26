<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript'>
         function buscar() {
          var d1, contenedor, url;
          contenedor = document.getElementById('propietarios');
          contenedor2 = document.getElementById('propietario_seleccionado');
          contenedor3 = document.getElementById('propietario_insertada');
          d1 = document.formu.paterno.value;
          d2 = document.formu.nombre.value;
          d3 = document.formu.direccion.value;
          d4 = document.formu.ci.value;
          ajax = nuevoAjax();
          url = 'ajax_buscar_propietario.php'
          param = 'paterno='+d1+'&nombre='+d2+'&direccion='+d3+'&ci='+d4;
          ajax.open('POST', url, true);
          ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
          ajax.onreadystatechange = function(){
              if (ajax.readyState == 4){
                  contenedor.innerHTML = ajax.responseText;
                  contenedor2.innerHTML = '';
                  contenedor3.innerHTML = '';
              }
          }
          ajax.send(param);
      }

          function buscar_propietario(id_propietario) {
            var d1, contenedor, url;
            contenedor = document.getElementById('propietario_seleccionado');
            contenedor2 = document.getElementById('propietarios');
            document.formu.id_propietario.value = id_propietario;

            d1 = id_propietario;
          
            ajax = nuevoAjax();
            url = 'ajax_buscar_propietario1.php';
            param = 'id_propietario='+d1;
            ajax.open('POST', url, true);
            ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4){
                    contenedor.innerHTML = ajax.responseText;
                    contenedor2.innerHTML = '';
                }
            }
            ajax.send(param);
        }


        function insertar_propietario() {
          var d1, contenedor, url;
          contenedor = document.getElementById('propietario_seleccionado');
          contenedor2 = document.getElementById('propietarios');
          contenedor3 = document.getElementById('propietario_insertada');
          d1 = document.formu.paterno1.value;
          d2 = document.formu.nombre1.value;
          d3 = document.formu.ci1.value;
          d4 = document.formu.direccion1.value;
          d5 = document.formu.telefono1.value;
          if (d3 == '') {
                alert('El ci es incorrecto o el campo esta vacio');
                document.formu.ci1.focus();
                return;
            }
          if  ((d1=='')) {
                alert('Por favor introduzca un Apellido');
                document.formupaterno.focus();
                return;
            }
          if  (d2 == '') {
                alert('El nombre es incorrecto o el campo esta vacio');
                document.formu.nombres1.focus();
                return;
          }
          ajax = nuevoAjax();
          url = 'ajax_inserta_propietario.php'
          param = paterno='+d1+'&am1='+d2+'&nombres1='+d3+'&ci1='+d4+'&direccion1='+d5+'&telefono1='+d6;
          ajax.open('POST', url, true);
          ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
          alert('llega');
          ajax.onreadystatechange = function(){
              if (ajax.readyState == 4){
                  contenedor.innerHTML = '';
                  contenedor2.innerHTML = '';
                  contenedor3.innerHTML = ajax.responseText;
              }
          }
          ajax.send(param);
      }

      </script>
    </head>";
    echo"<body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='obras.php'>Listado de Obras</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
      <h1>INSERTAR OBRA</h1>";
      
      $sql = $db->Prepare("SELECT CONCAT_WS(' ' ,paterno, nombre) AS propietario, id_propietario 
                     FROM propietarios
                      
                        ");
$rs = $db->GetAll($sql);
   //if ($rs) {*/
        echo"<form action='propietario_nuevo1.php' method='post' name='formu'>";
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>(*)Selecciona a la propietarios</th>
                    <td>
                      <table>
                        <tr> 
                          <td>
                            <b>Parterno</b><br />
                            <input type='text' name='paterno' value='' size='10' onKeyUp='buscar()'>
                          </td>
                          <td>
                            <b>Nombre</b><br />
                            <input type='text' name='nombre' value='' size='10' onKeyUp='buscar()'>
                          </td>
                          <td>
                            <b>Direccion</b><br />
                            <input type='text' name='direccion' value='' size='10' onKeyUp='buscar()'>
                          </td>
                          <td>
                            <b>C.I.</b><br />
                            <input type='text' name='ci' value='' size='10' onkeyUp='buscar()'>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>";
            echo"<tr>
                  <td colspan='6' align='center'>
                    <table width='100%'>
                      <tr>
                        <td colspan='3' align='center'>
                        <div id='propietarios'> </div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td colspan='6' align='center'>
                    <table width='100%'>
                      <tr>
                        <td colspan='3'>
                          <divropietario'> </div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td colspan='6' align='center'>
                  <table width='100%'>
                    <tr>
                      <td colspan='3'>
                        <input type='hidden' name='id_propietario'>
                        <divropietario'> </div>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>";
            echo"<tr>
                  <th><b>(*)Nombre de Obra</b></th>
                  <td><input type='text' name='nombre' size='10'></td>
                </tr>
                <tr>
                  <th><b>(*)Cod</b></th>
                  <td><input type='text' name='cod' size='10'></td>
                </tr>
                <tr>
                  <th><b>(*)Monto</b></th>
                  <td><input type='text' name='monto' size='10'></td>
                </tr>
                <tr>
                  <th><b>(*)Fecha Inicio</b></th>
                  <td><input type='date' name='f_inicio' size='10'></td>
                </tr>
                <tr>
                  <th><b>(*)Fecha Final</b></th>
                  <td><input type='date' name='f_fin' size='10'></td>
                </tr>
                <tr>
                  <th><b>(*)Descripcion</b></th>
                  <td><input type='text' name='descripcion' size='10'></td>
                </tr>
                <tr>
                  <th><b>(*)Direccion</b></th>
                  <td><input type='text' name='direccion' size='10'></td>
                </tr>
                <tr>
                  <td align='center' colspan='2'>
                  <input type='submit' value='ADICIONAR USUARIO'><br>
                  (*)Datos Obligarios 
                </td>
              </tr>
            </table>
          </center>";
    echo"</form>" ;
    /*}*/                      
echo "</body>
      </html> ";

 ?>