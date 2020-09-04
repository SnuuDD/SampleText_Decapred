<?php
  session_start();
  require_once("../../util.php");  

  $_GET["gradoEscolar_id"] = htmlspecialchars($_GET["gradoEscolar_id"]);
  $_POST["gradoEscolar_nombre"] = htmlspecialchars($_POST["gradoEscolar_nombre"]);

  if(isset($_GET["gradoEscolar_id"]) && isset($_POST["gradoEscolar_nombre"])) {
      if (editarGradoEscolar($_GET["gradoEscolar_id"], $_POST["gradoEscolar_nombre"])) {
          $_SESSION["mensaje"] = "Se edito la GradoEscolar";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al editar la GradoEscolar";
      }
  }
  header("Status: 301 Moved Permanently");

  header("location:../../consultaGradoEscolar.php");
  exit;
?>