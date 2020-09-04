<?php
  session_start();
  require_once("../../util.php");  

  $_GET["relacion_id"] = htmlspecialchars($_GET["relacion_id"]);

  if(isset($_GET["relacion_id"])) {
      if (eliminarDiscapacidadBenefciaria($_GET["relacion_id"])) {
          $_SESSION["mensaje"] = "Se elimino la discapacidad de la beneficiaria";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al eliminar la discapacidad de la beneficiaria";
      }
  }
  header("Status: 301 Moved Permanently");

  header("location:../../consultarDiscapacidad.php");
  exit;
?>