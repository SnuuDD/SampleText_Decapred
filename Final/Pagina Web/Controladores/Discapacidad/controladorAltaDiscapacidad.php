<?php
  session_start();
  require_once("../../util.php");  

  $_POST["discapacidad_nombre"] = htmlspecialchars($_POST["discapacidad_nombre"]);

  if(isset($_POST["discapacidad_nombre"])) {
      if (insertarDiscapacidad($_POST["discapacidad_nombre"])) {
          $_SESSION["mensaje"] = "Se agrego una nueva discapacidad";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al agregar una nueva  discapacidad";
      }
  }
  header("Status: 301 Moved Permanently");

  header("location:../../consultaDiscapacidad.php");
  exit;
?>