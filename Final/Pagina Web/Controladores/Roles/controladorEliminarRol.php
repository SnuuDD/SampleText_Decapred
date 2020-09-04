<?php
  session_start();
  require_once("../../util.php");  

  $_GET["Rol_id"] = htmlspecialchars($_GET["Rol_id"]);

  if(isset($_GET["Rol_id"])) {
      if (eliminarRol($_GET["Rol_id"])) {
          $_SESSION["mensaje"] = "Se elimino un rol";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al eliminar un rol";
      }
  }
  header("Status: 301 Moved Permanently");

  header("location:../../consultarRoles.php");
  exit;
?>