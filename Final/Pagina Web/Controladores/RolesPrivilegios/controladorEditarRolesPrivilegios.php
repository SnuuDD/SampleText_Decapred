<?php

  session_start();
  require_once("../../util.php");  

  $_GET["Relacion_id"] = htmlspecialchars($_GET["Relacion_id"]);
  $_POST["Privilegios"] = htmlspecialchars($_POST["Privilegios"]);
  $_POST["Rol"] = htmlspecialchars($_POST["Rol"]);
  //var_dump($_POST);

  if(isset($_GET["Relacion_id"]) && isset($_POST["Privilegios"])) {
      if (editarRolesPrivilegios($_GET["Relacion_id"],$_POST["Privilegios"],$_POST["Rol"])) {
          $_SESSION["mensaje"] = "Se edito un privilegio de un rol";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al editar un privilegio de un rol";
      }
  }else {
    $_SESSION["warning"] = "Ocurrió un error al editar un privilegio de un rol";
  }
  header("Status: 301 Moved Permanently");
header("location:../../consultarRolesPrivilegios.php");
exit;
?>