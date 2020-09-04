<?php
  session_start();
  require_once("../../util.php");  

  $_POST["Coordinaciones_nombre"] = htmlspecialchars($_POST["Coordinaciones_nombre"]);

  if(isset($_POST["Coordinaciones_nombre"])) {
      if (insertarCoordinaciones($_POST["Coordinaciones_nombre"])) {
          $_SESSION["mensaje"] = "Se agrego una nueva Área";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al agregar una nueva  Área";
      }
  }
  header("Status: 301 Moved Permanently");

  header("location:../../consultaCoordinaciones.php");
  exit;
?>