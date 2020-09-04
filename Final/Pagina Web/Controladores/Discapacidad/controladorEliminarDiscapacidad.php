<?php
  session_start();
  require_once("../../util.php");  

  $_GET["discapacidad_id"] = htmlspecialchars($_GET["discapacidad_id"]);

  if(isset($_GET["discapacidad_id"])) {
      if (eliminarDiscapacidad($_GET["discapacidad_id"])) {
          $_SESSION["mensaje"] = "Se elimino la discapacidad";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al eliminar la discapacidad";
      }
  }
  header("Status: 301 Moved Permanently");

  header("location:../../consultaDiscapacidad.php");
  exit;
?>