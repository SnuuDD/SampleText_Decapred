<?php
  session_start();
  require_once("../../util.php");  
  $_GET["Rol_id"] = htmlspecialchars($_GET["Rol_id"]);
  $_POST["Rol_nombre"] = htmlspecialchars($_POST["Rol_nombre"]);
  $_POST["Rol_descripcion"] = htmlspecialchars($_POST["Rol_descripcion"]);
  if(isset($_GET["Rol_id"]) && isset($_POST["Rol_nombre"])) {
      if (editarRol($_GET["Rol_id"],$_POST["Rol_nombre"],$_POST["Rol_descripcion"])) {
          $_SESSION["mensaje"] = "Se edito un Rol";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al editar un Rol";
      }
  }else {
    $_SESSION["warning"] = "Ocurrió un error al editar un Rol";
}
header("Status: 301 Moved Permanently");

  header("location:../../consultarRoles.php");
  exit;
?>