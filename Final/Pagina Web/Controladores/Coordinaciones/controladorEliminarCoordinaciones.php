<?php
  session_start();
  require_once("../../util.php");  

  $_GET["Coordinaciones_id"] = htmlspecialchars($_GET["Coordinaciones_id"]);

  if(isset($_GET["Coordinaciones_id"])) {
      if (eliminarCoordinaciones($_GET["Coordinaciones_id"])) {
          $_SESSION["mensaje"] = "Se elimino la Área";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al eliminar la Área";
      }
  }
  header("Status: 301 Moved Permanently");

  header("location:../../consultaCoordinaciones.php");
  exit;
?>