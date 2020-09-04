<?php
  session_start();
  require_once("../../util.php");  
  
  $_POST["Usuario"] = htmlspecialchars($_POST["Usuario"]);
  $_POST["Rol"] = htmlspecialchars($_POST["Rol"]);
  if(isset($_POST["Usuario"]) and isset($_POST["Rol"])) {
    
      if (insertarRolesUsuarios($_POST["Usuario"],$_POST["Rol"])){
          $_SESSION["mensaje"] = "Se agrego una nuevo rol a un usuario";

      } else {
          $_SESSION["warning"] = "Ocurrió un error al agregar un rol a un usuario";

      }
  }else {
    $_SESSION["warning"] = "Ocurrió un error al agregar un rol a un usuario";

  }
  header("Status: 301 Moved Permanently");

  header("location:../../consultarRolesUsuario.php");
  exit;
?>