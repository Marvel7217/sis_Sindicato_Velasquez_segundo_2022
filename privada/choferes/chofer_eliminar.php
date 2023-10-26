<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

$db->debug = true;
$id_chofer = $_REQUEST["id_chofer"];

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
$db->debug = true;

// Comprobamos si el chofer existe y no ha sido marcado como eliminado
$sql = $db->Prepare("SELECT *
                     FROM choferes
                     WHERE id_chofer = ? 
                     AND estado <> 'x'                    
                        ");
$rs = $db->GetAll($sql, array($id_chofer));

if (!$rs) {
  $reg = array();
  $reg["estado"] = 'x';
  $reg["usuario"] = $_SESSION["sesion_id_usuario"];
  $rs = $db->AutoExecute("choferes", $reg, "UPDATE", "id_chofer='".$id_chofer."'");
  
  if ($rs) {
      header("Location: choferes.php");
      exit();
  } else {
      // Manejar un error si es necesario
      echo "Hubo un error al realizar el borrado lógico.";
  }
} else {
  echo "<div class='mensaje'>";
  $mensaje = "NO SE ELIMINARON LOS DATOS DE LOS CHOFERES PORQUE TIENE HERENCIA";
  echo "<h1>".$mensaje."</h1>";
  echo "<a href='choferes.php'>
           <input type='button' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;'
           value='VOLVER>>>>'></input>
        </a>";
  echo "</div>";
}


echo "</body>
      </html> ";
?>
