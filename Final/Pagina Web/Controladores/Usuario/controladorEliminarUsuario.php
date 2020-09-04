<?php
  session_start();
  require_once("../../util.php");  

  $_GET["Usuario_id"] = htmlspecialchars($_GET["Usuario_id"]);

  if(isset($_GET["Usuario_id"])) {
      if (eliminarUsuario($_GET["Usuario_id"])) {
          $_SESSION["mensaje"] = "Se elimino un usuario";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al eliminar un usuario";
      }
  }
  header("Status: 301 Moved Permanently");

  header("location:../../usuarios.php");
  exit;
?>