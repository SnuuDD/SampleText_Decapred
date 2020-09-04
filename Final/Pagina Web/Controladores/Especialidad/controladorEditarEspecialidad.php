<?php
  session_start();
  require_once("../../util.php");  

  $_GET["especialidad_id"] = htmlspecialchars($_GET["especialidad_id"]);
  $_POST["especialidad_nombre"] = htmlspecialchars($_POST["especialidad_nombre"]);
  $_POST["Coordinaciones"] = htmlspecialchars($_POST["Coordinaciones"]);

  if(isset($_GET["especialidad_id"]) && isset($_POST["especialidad_nombre"])) {
      if (editarEspecialidad($_GET["especialidad_id"], $_POST["Coordinaciones"],$_POST["especialidad_nombre"],)) {
          $_SESSION["mensaje"] = "Se edito la especialidad";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al editar la especialidad";
      }
  }
  header("Status: 301 Moved Permanently");

  header("location:../../consultaEspecialidad.php");
  exit;
?>