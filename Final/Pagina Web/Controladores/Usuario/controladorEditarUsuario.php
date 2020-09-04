<?php
  session_start();
  require_once("../../util.php");  

  $_GET["Usuario_id"] = htmlspecialchars($_GET["Usuario_id"]);
  $_POST["Usuario_nombre"] = htmlspecialchars($_POST["Usuario_nombre"]);
  $_POST["Usuario_Usuario"] = htmlspecialchars($_POST["Usuario_Usuario"]);
  $_POST["Usuario_password"] = htmlspecialchars($_POST["Usuario_password"]);

  if(isset($_GET["Usuario_id"]) && isset($_POST["Usuario_nombre"])) {
      if (editarUsuario($_GET["Usuario_id"],$_POST["Usuario_nombre"],$_POST["Usuario_Usuario"],$_POST["Usuario_password"])) {
          $_SESSION["mensaje"] = "Se edito un usuario";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al editar un usuario";
      }
  }else {
    $_SESSION["warning"] = "Ocurrió un error al editar un usuario";
}
header("Status: 301 Moved Permanently");

  header("location:../../usuarios.php");
  exit;
?>