<?php
    session_start();
    require_once("../../util.php");  
    
    $ingreso_id = htmlspecialchars($_POST["X"]);
    if($_POST["X"]==1){
        echo getDiagnosticoByIdC($_SESSION["idDiagnostico"],$_POST["Y"]); 
    }
    else{
        echo getDiagnosticoByIdC2($_SESSION["idDiagnostico"],$_POST["Y"]);
    }
?>