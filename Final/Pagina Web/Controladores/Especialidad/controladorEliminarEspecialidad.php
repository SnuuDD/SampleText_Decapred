<?php
  session_start();
  require_once("../../util.php");  

  $_GET["especialidad_id"] = htmlspecialchars($_GET["especialidad_id"]);

  if(isset($_GET["especialidad_id"])) {
      if (eliminarEspecialidad($_GET["especialidad_id"])) {
          $_SESSION["mensaje"] = "Se elimino la especialidad";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al eliminar la especialidad";
      }
  }
  header("Status: 301 Moved Permanently");

  header("location:../../consultaEspecialidad.php");
  exit;
?>