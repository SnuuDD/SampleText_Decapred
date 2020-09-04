<?php
    session_start();
    require_once("../../util.php");
    $ingreso_id= htmlspecialchars($_SESSION["ingreso_id"]);

    $programa= htmlspecialchars($_POST["programa"]);

    $motivo = htmlspecialchars($_POST["motivo"]);

    $observaciones = htmlspecialchars($_POST["observaciones"]);

    $fechaR =  htmlspecialchars($_POST["fechaR"]);
    $fechaR = str_replace('/', '-', $fechaR);  
    $fechaR = date("Y-m-d",strtotime($fechaR));
    
    

    
    
    if((isset($_POST["programa"])) and (isset($_POST["motivo"])) AND (isset($_POST["fechaR"]))) {
        if (altaVinculacionPrograma($ingreso_id,$programa,$fechaR, $observaciones, $motivo)) {
            $_SESSION["mensaje"] = "Se ha agregado el programa";
            //echo "success";
        } else {
            $_SESSION["warning"] = "Ocurrió un error al agregar el programa";
        }
    }
    header("Status: 301 Moved Permanently");

    header("location:../../consultarProgramas.php?ingreso_id=".$ingreso_id."");
    exit;
    


?>