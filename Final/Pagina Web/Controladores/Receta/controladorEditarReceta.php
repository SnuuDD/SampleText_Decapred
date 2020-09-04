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
    $idR = htmlspecialchars($_SESSION["receta_id"]);

    
    
    if((isset($_SESSION["ingreso_id"])) and (isset($_POST["medicamento"])) AND (isset($_POST["fechaI"])) AND (isset($_POST["fechaF"])) AND (isset($_POST["indicaciones"]))
    AND (isset($_POST["dosis"])) AND (isset($_POST["indicaciones"]))) {
        if (editaReceta($idbeneficiaria, $idmedicamento, $fechaI, $fechaF, $indicaciones,$dosis,$idR)) {
            $_SESSION["mensaje"] = "Se ha editado la receta exitosamente";
            //echo "success";
        } else {
            $_SESSION["warning"] = "Ocurrió un error al editar la receta";
        }
    }
    header("Status: 301 Moved Permanently");

    header("location:../../consultarRecetas.php?ingreso_id=".$_SESSION["ingreso_id"]."");
    exit;
    


?>