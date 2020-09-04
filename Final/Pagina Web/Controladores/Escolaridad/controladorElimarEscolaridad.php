<?php
  session_start();
  require_once("../../util.php");  

  $_GET["escolaridad_id"] = htmlspecialchars($_GET["escolaridad_id"]);

  if(isset($_GET["escolaridad_id"])) {
      if (eliminarEscolaridad($_GET["escolaridad_id"])) {
          $_SESSION["mensaje"] = "Se elimino la escolaridad";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al eliminar la escolaridad";
      }
  }
  header("Status: 301 Moved Permanently");

  header("location:../../consultaEscolaridad.php");
  exit;
?>