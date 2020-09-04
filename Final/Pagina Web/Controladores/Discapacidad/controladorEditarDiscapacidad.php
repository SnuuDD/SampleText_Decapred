<?php
  session_start();
  require_once("../../util.php");  

  $_GET["discapacidad_id"] = htmlspecialchars($_GET["discapacidad_id"]);
  $_POST["discapacidad_nombre"] = htmlspecialchars($_POST["discapacidad_nombre"]);

  if(isset($_GET["discapacidad_id"]) && isset($_POST["discapacidad_nombre"])) {
      if (editarDiscapacidad($_GET["discapacidad_id"], $_POST["discapacidad_nombre"])) {
          $_SESSION["mensaje"] = "Se edito la discapacidad";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al editar la discapacidad";
      }
  }
  header("Status: 301 Moved Permanently");

  header("location:../../consultaDiscapacidad.php");
  exit;
?>