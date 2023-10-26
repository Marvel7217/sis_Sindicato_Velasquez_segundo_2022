<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../libreria_menu.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_personas.js'> </script>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='persona_nuevo.php'>Nueva Persona</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

       echo"<h1>LISTADO DE PERSONAS</h1>";

echo"
<!------INICIO BUSCADOR---------------->
    <center>
    <form action='#'' method='post' name='formu'>
    <table border='1' class='listado'>
      <tr>
        <th>
          <b>Parterno</b><br />
          <input type='text' name='paterno' value='' size='10' onKeyUp='buscar_personas()'>
        </th>
        <th>
          <b>Materno</b><br />
          <input type='text' name='materno' value='' size='10' onKeyUp='buscar_personas()'>
        </th>
        <th>
          <b>Nombres</b><br />
          <input type='text' name='nombres' value='' size='10' onKeyUp='buscar_personas()'>
        </th>
        <th>
          <b>C.I.</b><br />
          <input type='text' name='ci' value='' size='10' onKeyUp='buscar_personas()'>
        </th>
      </tr>
    </table>
    </form>
    </center>
    <!------FIN BUSCADOR---------------->";

echo"<div id='personas1'> ";
contarRegistros($db,"personas_1");
paginacion("personas.php?");
/*$sql = $db->Prepare("SELECT *
                     FROM personas_1
                     WHERE estado <> 'X' 
                     ORDER BY id_persona_1 DESC                      
                        ");
$rs = $db->GetAll($sql);*/
$sql3 = $db->Prepare("SELECT *
                     FROM personas_1
                     WHERE estado <> 'X' 
                     AND id_persona_1 > 1
                     ORDER BY id_persona_1 DESC 
                     LIMIT ? OFFSET ?                     
                        ");
$rs = $db->GetAll($sql3, array($nElem,$regIni));

   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>C.I.</th><th>PATERNO</th><th>MATERNO</th><th>NOMBRES</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=0;
                $total=$pag-1;
                $a = $nElem*$total;
                $b= $b+1+$a;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td align='center'>".$fila['ci']."</td>
                        <td>".$fila['ap']."</td>
                        <td>".$fila['am']."</td>
                        <td>".$fila['nombres']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_persona_1"]."' method='post' action='persona_modificar.php'>
                            <input type='hidden' name='id_persona_1' value='".$fila['id_persona_1']."'>
                            <a href='javascript:document.formModif".$fila['id_persona_1'].".submit();' title='Modificar Persona Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_persona_1"]."' method='post' action='persona_eliminar.php'>
                            <input type='hidden' name='id_persona_1' value='".$fila["id_persona_1"]."'>
                            <a href='javascript:document.formElimi".$fila['id_persona_1'].".submit();' title='Eliminar Persona Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar a la persona ".$fila["nombres"]." ".$fila["ap"]." ".$fila["am"]." ?\"))'; location.href='persona_eliminar.php''> 
                              Eliminar>>
                            </a>
                          </form>                        
                        </td>
                     </tr>";
                     $b=$b+1;
            }
             echo"</table>
          </center>";
    }
echo"</div>";
echo"<!--PAGINACION-------------------------------------------------->";
echo"<table border='0' align='center'>
    <tr>
      <td>";
       if(!empty($urlback)){
        echo"<a href=".$urlback." style='font-family:verdana;font-size:9px;cursor:pointer'; >&laquo;Anterior</a>";
       }
       if(!empty($paginas)){
        foreach($paginas as $k=> $pagg){
          if($pagg["npag"]==$pag){
            if($pag != '1'){
              echo"|";
            }
            echo"<b style='color:#FB992F;font-size:12px;'>";
          } else
          echo"</b> | <a href=".$pagg["pagV"]." style='cursor:pointer;'>";echo $pagg["npag"]; echo"</a>";

        }
      }
      if(($nPags >$nBotones) and (!empty($urlnext))and ($pag<$nPags)){
        echo" |<a href=".$urlnext." style='font-family: Verdana;font-size: 9px;cursor:pointer'>Siguiente&raquo;</a>";
      }
       echo"</td>
       </tr>
    </table>";
  echo"<!---PAGINACION----------------------------------------->";
echo "</body>
      </html> ";

 ?>