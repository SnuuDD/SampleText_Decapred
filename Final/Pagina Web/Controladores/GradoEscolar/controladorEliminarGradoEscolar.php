<?php
  session_start();
  require_once("../../util.php");  

  $_GET["gradoEscolar_id"] = htmlspecialchars($_GET["gradoEscolar_id"]);

  if(isset($_GET["gradoEscolar_id"])) {
      if (eliminarGradoEscolar($_GET["gradoEscolar_id"])) {
          $_SESSION["mensaje"] = "Se elimino el Plan Educativo";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al eliminar el Plan Educativo";
      }
  }
  header("Status: 301 Moved Permanently");

  header("location:../../consultaGradoEscolar.php");
  exit;
?>