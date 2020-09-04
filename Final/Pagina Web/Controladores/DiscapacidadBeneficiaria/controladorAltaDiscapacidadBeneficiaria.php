<?php
  session_start();
  require_once("../../util.php");  

  $_POST["Discapacidad"] = htmlspecialchars($_POST["Discapacidad"]);
  $_POST["fecha"] = htmlspecialchars($_POST["fecha"]);
  $_POST["tratamiento"] = htmlspecialchars($_POST["tratamiento"]);
  $id=$_POST["Discapacidad"];
  if ($_POST["Discapacidad"] == 0){
    $_POST["discapacidad_nombre"] = htmlspecialchars($_POST["discapacidad_nombre"]);
    insertarDiscapacidad($_POST["discapacidad_nombre"]);
    $id=getIdDiscapacidad();
  }
  
  //echo $id;

  if(isset($_SESSION["ingreso_id"],$id)) {
      if (insertarDiscapacidadBeneficiaria($_SESSION["ingreso_id"],$id,$_POST["fecha"],$_POST["tratamiento"] )) {
          $_SESSION["mensaje"] = "Se agrego una discapacidad a la beneficiaria";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al agregar una discapacidad a la benficiaria";
      }
  }else {
    $_SESSION["warning"] = "Ocurrió un error al agregar una discapacidad a la benficiaria";
}
header("Status: 301 Moved Permanently");

  header("location:../../consultarDiscapacidad.php");
  exit;
?>