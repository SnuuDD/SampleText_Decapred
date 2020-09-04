<?php
    session_start();
    require_once("../../util.php");
    $Coordinaciones= htmlspecialchars($_POST["Coordinacioness"]);

    $nombre = htmlspecialchars($_POST["nombre"]);

    $fechaI =  htmlspecialchars($_POST["fechaI"]);
    $fechaI = str_replace('/', '-', $fechaI);  
    $fechaI = date("Y-m-d",strtotime($fechaI));
    $fechaF =  htmlspecialchars($_POST["fechaF"]);
    $fechaF = str_replace('/', '-', $fechaF); 
    $fechaF = date("Y-m-d",strtotime($fechaF));
    
    $objetivo = htmlspecialchars($_POST["objetivo"]);

    
    
    if((isset($_POST["Coordinacioness"])) and (isset($_POST["nombre"])) AND (isset($_POST["fechaI"])) AND (isset($_POST["fechaF"])) AND (isset($_POST["objetivo"]))) {
        if (altaPrograma($Coordinaciones, $nombre, $fechaI, $fechaF, $objetivo)) {
            $_SESSION["mensaje"] = "Se ha agregado el programa";
            //echo "success";
        } else {
            $_SESSION["warning"] = "Ocurrió un error al agregar el programa";
        }
    }
    header("Status: 301 Moved Permanently");

    header("location:../../consultaPrograma.php");
    exit;
    


?>