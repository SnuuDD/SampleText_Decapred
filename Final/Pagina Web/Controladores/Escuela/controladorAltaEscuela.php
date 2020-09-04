<?php
  session_start();
  require_once("../../util.php");  

  $_POST["escuela_nombre"] = htmlspecialchars($_POST["escuela_nombre"]);
  $_POST["direccion_nombre"] = htmlspecialchars($_POST["direccion_nombre"]);
  $_POST["director_nombre"] = htmlspecialchars($_POST["director_nombre"]);
  $_POST["email"] = htmlspecialchars($_POST["email"]);
  $_POST["telefono"] = htmlspecialchars($_POST["telefono"]);
  if(isset($_POST["escuela_nombre"])) {
      if (insertarEscuela($_POST["escuela_nombre"],$_POST["direccion_nombre"],$_POST["director_nombre"],$_POST["telefono"],$_POST["email"] )){
          $_SESSION["mensaje"] = "Se agrego una nueva escuela";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al agregar una nueva  escuela";
      }
  }
  header("Status: 301 Moved Permanently");

  header("location:../../consultaEscuela.php");
  exit;
?>