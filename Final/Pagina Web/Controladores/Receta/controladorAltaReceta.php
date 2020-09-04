<?php
    session_start();
    require_once("../../util.php");


    $idbeneficiaria= htmlspecialchars($_SESSION["ingreso_id"]);

    $idmedicamento = htmlspecialchars($_POST["medicamento"]);

    $fechaI =  htmlspecialchars($_POST["fechaI"]);
    $fechaI = str_replace('/', '-', $fechaI);  
    $fechaI = date("Y-m-d",strtotime($fechaI));
    $fechaF =  htmlspecialchars($_POST["fechaF"]);
    $fechaF = str_replace('/', '-', $fechaF); 
    $fechaF = date("Y-m-d",strtotime($fechaF));
    
    $indicaciones = htmlspecialchars($_POST["indicaciones"]);

    $dosis = htmlspecialchars($_POST["dosis"]);


    
    
    if((isset($_SESSION["ingreso_id"])) and (isset($_POST["medicamento"])) AND (isset($_POST["fechaI"])) AND (isset($_POST["fechaF"])) AND (isset($_POST["indicaciones"]))
    AND (isset($_POST["dosis"])) AND (isset($_POST["indicaciones"]))) {
        if (altaReceta($idbeneficiaria, $idmedicamento, $fechaI, $fechaF, $indicaciones,$dosis)) {
            $_SESSION["mensaje"] = "Se ha agregado la receta";
            //echo "success";
        } else {
            $_SESSION["warning"] = "Ocurrió un error al agregar la receta";
        }
    }
    header("Status: 301 Moved Permanently");

    header("location:../../consultarRecetas.php?ingreso_id=".$_SESSION["ingreso_id"]."");
    exit;
    


?>