<?php
  session_start();
  require_once("../../util.php");  

  $_GET["Relacion_id"] = htmlspecialchars($_GET["Relacion_id"]);
  $_POST["Usuario"] = htmlspecialchars($_POST["Usuario"]);
  $_POST["Rol"] = htmlspecialchars($_POST["Rol"]);

  if(isset($_GET["Relacion_id"]) && isset($_POST["Usuario"])) {
      if (editarRolesUsuarios($_GET["Relacion_id"],$_POST["Usuario"],$_POST["Rol"])) {
          $_SESSION["mensaje"] = "Se edito un rol de un usuario";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al editar un rol de un usuario";
      }
  }else {
    $_SESSION["warning"] = "Ocurrió un error al editar un rol de un usuario";
}
header("Status: 301 Moved Permanently");

  header("location:../../consultarRolesUsuario.php");
  exit;
?>