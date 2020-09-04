<?php
  session_start();
  require_once("../../util.php");  

  $_GET["escuela_id"] = htmlspecialchars($_GET["escuela_id"]);
  $_POST["escuela_nombre"] = htmlspecialchars($_POST["escuela_nombre"]);
  $_POST["Escuela_direccion"] = htmlspecialchars($_POST["Escuela_direccion"]);
  $_POST["Escuela_director"] = htmlspecialchars($_POST["Escuela_director"]);
  $_POST["Escuela_correo"] = htmlspecialchars($_POST["Escuela_correo"]);
  $_POST["Escuela_telefono"] = htmlspecialchars($_POST["Escuela_telefono"]);
  //var_dump($_POST) ;

  if(isset($_GET["escuela_id"]) && isset($_POST["escuela_nombre"])) {
      if (editarEscuela($_GET["escuela_id"], $_POST["escuela_nombre"],$_POST["Escuela_direccion"],$_POST["Escuela_director"],$_POST["Escuela_telefono"],$_POST["Escuela_correo"] )) {
          $_SESSION["mensaje"] = "Se edito la escuela";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al editar la escuela";
      }
  }
  header("Status: 301 Moved Permanently");

  header("location:../../consultaEscuela.php");
  exit;
?>