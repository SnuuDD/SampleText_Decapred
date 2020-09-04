<?php
  session_start();
  require_once("../../util.php");  

  $_POST["usuario_nombre"] = htmlspecialchars($_POST["usuario_nombre"]);
  $_POST["email"] = htmlspecialchars($_POST["email"]);
  $_POST["password"] = htmlspecialchars($_POST["password"]);
  
  if(isset($_POST["usuario_nombre"]) and isset($_POST["email"]) and ($_POST["password"])) {
      if (insertarUsuario($_POST["usuario_nombre"],$_POST["email"],$_POST["password"])){
          $_SESSION["mensaje"] = "Se agrego una nuevo usuario";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al agregar una nuevo usuario";
      }
  }else {
    $_SESSION["warning"] = "Ocurrió un error al agregar una nuevo usuario";
}
header("Status: 301 Moved Permanently");

  header("location:../../usuarios.php");
  exit;
?>