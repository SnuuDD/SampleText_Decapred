<?php
  session_start();
  require_once("../../util.php");  

  $_GET["escuela_id"] = htmlspecialchars($_GET["escuela_id"]);

  if(isset($_GET["escuela_id"])) {
      if (eliminarEscuela($_GET["escuela_id"])) {
          $_SESSION["mensaje"] = "Se elimino la escuela";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al eliminar la escuela";
      }
  }
  header("Status: 301 Moved Permanently");

  header("location:../../consultaEscuela.php");
  exit;
?>