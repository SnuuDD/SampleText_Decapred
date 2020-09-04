<?php
  session_start();
  require_once("../../util.php");  

  $_POST["Coordinaciones"] = htmlspecialchars($_POST["Coordinaciones"]);
  $_POST["especialidad_nombre"] = htmlspecialchars($_POST["especialidad_nombre"]);

  if(isset($_POST["especialidad_nombre"])) {
      if (insertarEspecialidad($_POST["especialidad_nombre"], $_POST["Coordinaciones"])) {
          $_SESSION["mensaje"] = "Se agrego una nueva especialidad";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al agregar una nueva  especialidad";
      }
  }
  header("Status: 301 Moved Permanently");

  header("location:../../consultaEspecialidad.php");
  exit;
?>