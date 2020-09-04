<?php
  session_start();
  require_once("../../util.php");  

  $_POST["Privilegios"] = htmlspecialchars($_POST["Privilegios"]);
  $_POST["Rol"] = htmlspecialchars($_POST["Rol"]);
  //var_dump($_POST);
  if(isset($_POST["Privilegios"]) and isset($_POST["Rol"])) {
      if (insertarRolesPrivilegios($_POST["Privilegios"],$_POST["Rol"])){
          $_SESSION["mensaje"] = "Se agrego una nuevo rol a un Privilegios";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al agregar un rol a un Privilegios";
      }
  }else {
    $_SESSION["warning"] = "Ocurrió un error al agregar un rol a un Privilegios";
}
header("Status: 301 Moved Permanently");

  header("location:../../consultarRolesPrivilegios.php");
  exit;
?>