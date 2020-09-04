<?php
  session_start();
  require_once("../../util.php");  

  $_GET["escolaridad_id"] = htmlspecialchars($_GET["escolaridad_id"]);
  $_POST["Escuela"] = htmlspecialchars($_POST["Escuela"]);
  $_POST["GradoEscolar"] = htmlspecialchars($_POST["GradoEscolar"]);
  $_POST["Escolaridad_fechaInicio"] = htmlspecialchars($_POST["Escolaridad_fechaInicio"]);
  $_POST["Escolaridad_fechaFin"] = htmlspecialchars($_POST["Escolaridad_fechaFin"]);

  $_POST["Escolaridad_nombreTutor"] = htmlspecialchars($_POST["Escolaridad_nombreTutor"]);
  $_POST["Escolaridad_correoElectronico"] = htmlspecialchars($_POST["Escolaridad_correoElectronico"]);
  $_POST["Escolaridad_telefono"] = htmlspecialchars($_POST["Escolaridad_telefono"]);
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
  if(isset($_SESSION["ingreso_id"])) {
      if (editarEscolaridad($_GET["escolaridad_id"],$_SESSION["ingreso_id"],$escuela,$planEducativo,
      $_POST["Escolaridad_nombreTutor"],$_POST["Escolaridad_telefono"],$_POST["Escolaridad_correoElectronico"],
      $_POST["Escolaridad_fechaInicio"],$_POST["Escolaridad_fechaFin"])) {
          $_SESSION["mensaje"] = "Se edito una escolaridad";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al editar la escolaridad";
      }
  }else {
    $_SESSION["warning"] = "Ocurrió un error al editar la escolaridad";
}
header("Status: 301 Moved Permanently");

  header("location:../../consultaEscolaridad.php");
  exit;
?>