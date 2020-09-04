<?php
  session_start();
  require_once("../../util.php");  

  $_POST["roles_nombre"] = htmlspecialchars($_POST["roles_nombre"]);
  $_POST["roles_descripcion"] = htmlspecialchars($_POST["roles_descripcion"]);
  if(isset($_POST["roles_nombre"]) && isset($_POST["roles_descripcion"])) {
      if (insertarRol($_POST["roles_nombre"],$_POST["roles_descripcion"])){
          $_SESSION["mensaje"] = "Se agrego una nuevo rol";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al agregar una nuevo rol";
      }
  }else {
    $_SESSION["warning"] = "Ocurrió un error al agregar una nuevo rol";
}
header("Status: 301 Moved Permanently");

  header("location:../../consultarRoles.php");
  exit;
?>