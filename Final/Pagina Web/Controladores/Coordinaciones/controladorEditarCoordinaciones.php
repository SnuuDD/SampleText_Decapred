<?php
  session_start();
  require_once("../../util.php");  

  $_GET["Coordinaciones_id"] = htmlspecialchars($_GET["Coordinaciones_id"]);
  $_POST["Coordinaciones_nombre"] = htmlspecialchars($_POST["Coordinaciones_nombre"]);

  if(isset($_GET["Coordinaciones_id"]) && isset($_POST["Coordinaciones_nombre"])) {
      if (editarCoordinaciones($_GET["Coordinaciones_id"], $_POST["Coordinaciones_nombre"])) {
          $_SESSION["mensaje"] = "Se edito la Área";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al editar la Área";
      }
  }
  header("Status: 301 Moved Permanently");

  header("location:../../consultaCoordinaciones.php");
  exit;
?>