<?php
  session_start();
  require_once("../../util.php");  

  $_POST["gradoEscolar_nombre"] = htmlspecialchars($_POST["gradoEscolar_nombre"]);

  if(isset($_POST["gradoEscolar_nombre"])) {
      if (insertarGradoEscolar($_POST["gradoEscolar_nombre"])) {
          $_SESSION["mensaje"] = "Se agrego una nueva GradoEscolar";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al agregar una nueva  GradoEscolar";
      }
  }
  header("Status: 301 Moved Permanently");

  header("location:../../consultaGradoEscolar.php");
  exit;
?>