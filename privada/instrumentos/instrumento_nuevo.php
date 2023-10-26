<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript'>
         function buscar() {
          var d1, contenedor, url;
          contenedor = document.getElementById('asociacion');
          contenedor2 = document.getElementById('asociacion_seleccionado');
          contenedor3 = document.getElementById('asociacion_insertada');
          d1 = document.formu.nombre.value;
          d2 = document.formu.direccion.value;
          d3 = document.formu.telefono.value;
          d4 = document.formu.correo.value;
          ajax = nuevoAjax();
          url = 'ajax_buscar_asociacion0.php'
          param = 'nombre='+d1+'&direccion='+d2+'&telefono='+d3+'&correo='+d4;
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

          function buscar_asociacion(id_asociacion) {
            var d1, contenedor, url;
            contenedor = document.getElementById('asociacion_seleccionado');
            contenedor2 = document.getElementById('asociacion');
            document.formu.id_asociacion.value = id_asociacion;

            d1 = id_asociacion;
          
            ajax = nuevoAjax();
            url = 'ajax_buscar_asociacion1.php';
            param = 'id_asociacion='+d1;
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


        function insertar_asociacion() {
          var d1, contenedor, url;
          contenedor = document.getElementById('asociacion_seleccionado');
          contenedor2 = document.getElementById('asociacion');
          contenedor3 = document.getElementById('asociacion_insertada');
          d1 = document.formu.nombre1.value;
          d2 = document.formu.direccion1.value;
          d3 = document.formu.telefono1.value;
          d4 = document.formu.correo1.value;
          if (d4 == '') {
                alert('El correo es incorrecto o el campo esta vacio');
                document.formu.correo1.focus();
                return;
            }
          if  ((d1=='') && (d2=='')) {
                alert('Por favor introduzca un Nombre');
                document.formu.nombre1.focus();
                return;
            }
          if  (d3 == '') {
                alert('El telefono es incorrecto o el campo esta vacio');
                document.formu.telefono1.focus();
                return;
          }
          ajax = nuevoAjax();
          url = 'ajax_inserta_asociacion.php'
          param = 'nombre1='+d1+'direccion1='+d2+'&telefono1='+d3+'&correo1='+d4;
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
       <a  href='asociacion.php'>Listado de Usuarios</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
      <h1>INSERTAR USUARIO</h1>";
      
      $sql = $db->Prepare("SELECT CONCAT_WS(' ' ,nombre, direccion, telefono) AS asociacion, id_asociacion 
                     FROM asociacion                    
                        ");
$rs = $db->GetAll($sql);
   //if ($rs) {*/
        echo"<form action='instrumento_nuevo1.php' method='post' name='formu'>";
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>(*)Selecciona a la asociacion</th>
                    <td>
                      <table>
                        <tr> 
                          <td>
                            <b>Nombre</b><br />
                            <input type='text' name='nombre' value='' size='10' onKeyUp='buscar()'>
                          </td>
                          <td>
                            <b>Direccion</b><br />
                            <input type='text' name='direccion' value='' size='10' onKeyUp='buscar()'>
                          </td>
                          <td>
                            <b>Telefono</b><br />
                            <input type='text' name='telefono' value='' size='10' onKeyUp='buscar()'>
                          </td>
                          <td>
                            <b>Correo</b><br />
                            <input type='text' name='correo' value='' size='10' onkeyUp='buscar()'>
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
                        <div id='asociacion'> </div>
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
                          <div id='asociacion_seleccionado'> </div>
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
                        <input type='hidden' name='id_asociacion'>
                        <div id='asociacion_insertada'> </div>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>";
            echo"<tr>
                  <th><b>(*)Nombre de instrumento</b></th>
                  <td><input type='text' name='instrumento' size='10'></td>
                </tr>
                <tr>
                  <th><b>(*)Codigo</b></th>
                  <td><input type='text' name='codigo' size='10'></td>
                </tr>
                <tr>
                  <td align='center' colspan='2'>
                  <input type='submit' value='ADICIONAR ISNTRUMENTO'><br>
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