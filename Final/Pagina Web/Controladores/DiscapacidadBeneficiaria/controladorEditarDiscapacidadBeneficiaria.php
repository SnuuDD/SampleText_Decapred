<?php
  session_start();
  require_once("../../util.php");  

  
  $_POST["DiscapacidadBeneficiaria_fecha"] = htmlspecialchars($_POST["DiscapacidadBeneficiaria_fecha"]);
  $_GET["relacion_id"]=htmlspecialchars($_GET["relacion_id"]);
  $_POST["DiscapacidadBeneficiaria_Tratamiento"] = htmlspecialchars($_POST["DiscapacidadBeneficiaria_Tratamiento"]);

  $id=$_POST["Discapacidad"];
  if ($_POST["Discapacidad"] == 0){
    $_POST["discapacidad_nombre"] = htmlspecialchars($_POST["discapacidad_nombre"]);
    insertarDiscapacidad($_POST["discapacidad_nombre"]);
    $id=getIdDiscapacidad();
  }


  if(isset($_SESSION["ingreso_id"],$_POST["Discapacidad"])) {
      if (editarDiscapacidadBeneficiaria($_SESSION["ingreso_id"],$id,$_POST["DiscapacidadBeneficiaria_fecha"],$_GET["relacion_id"],  $_POST["DiscapacidadBeneficiaria_Tratamiento"] )) {
          $_SESSION["mensaje"] = "Se edito una discapacidad a la beneficiaria";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al editar una discapacidad a la benficiaria";
      }
  }else {
    $_SESSION["warning"] = "Ocurrió un error al agregar una discapacidad a la benficiaria";
}
header("Status: 301 Moved Permanently");

  header("location:../../consultarDiscapacidad.php");
  exit;
?>