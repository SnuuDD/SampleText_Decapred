<?php
  session_start();
  require_once("../../util.php");  

  $_POST["Escuela"] = htmlspecialchars($_POST["Escuela"]);
  $_POST["GradoEscolar"] = htmlspecialchars($_POST["GradoEscolar"]);
  $_POST["fechaInicio"] = htmlspecialchars($_POST["fechaInicio"]);
  $_POST["fechaFin"] = htmlspecialchars($_POST["fechaFin"]);
  $_POST["tutorNombre"] = htmlspecialchars($_POST["tutorNombre"]);
  $_POST["tutorEmail"] = htmlspecialchars($_POST["tutorEmail"]);
  $_POST["tutorTelefono"] = htmlspecialchars($_POST["tutorTelefono"]);
  $planEducativo=$_POST["GradoEscolar"];
  if ($_POST["GradoEscolar"] == 0){
    $_POST["gradoEscolar_nombre"] = htmlspecialchars($_POST["gradoEscolar_nombre"]);
    insertarGradoEscolar($_POST["gradoEscolar_nombre"]);
    $planEducativo=getLastIdInsert("GradoEscolar","idGradoEscolar");
  }
  $escuela=$_POST["Escuela"];
  if ($_POST["Escuela"] == 0){
    $_POST["escuela_nombre"] = htmlspecialchars($_POST["escuela_nombre"]);
    $_POST["direccion_nombre"] = htmlspecialchars($_POST["direccion_nombre"]);
    $_POST["director_nombre"] = htmlspecialchars($_POST["director_nombre"]);
    $_POST["email"] = htmlspecialchars($_POST["email"]);
    $_POST["telefono"] = htmlspecialchars($_POST["telefono"]);
    insertarEscuela($_POST["escuela_nombre"],$_POST["direccion_nombre"],$_POST["director_nombre"],$_POST["telefono"],$_POST["email"] );
    $escuela=getLastIdInsert("Escuela","idEscuela");
  }
  if(isset($_SESSION["ingreso_id"],$escuela,$planEducativo)) {
      if (insertarEscolaridad($_SESSION["ingreso_id"],$escuela,$planEducativo,
      $_POST["tutorNombre"],$_POST["tutorTelefono"],$_POST["tutorEmail"],
      $_POST["fechaInicio"],$_POST["fechaFin"])) {
          $_SESSION["mensaje"] = "Se agrego una nueva escolaridad";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al agregar una nueva  escolaridad";
      }
  }
  header("Status: 301 Moved Permanently");

    header("location:../../consultaEscolaridad.php");
    exit;
?>