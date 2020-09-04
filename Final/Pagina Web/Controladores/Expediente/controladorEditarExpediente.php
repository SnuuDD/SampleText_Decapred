<?php
    session_start();
    require_once("../../util.php");
    $id = htmlspecialchars($_SESSION["id"]);
    $fecha = htmlspecialchars($_POST["fecha"]);
    $fecha = str_replace('/', '-', $fecha);  


    $hora = htmlspecialchars($_POST["hora"]);

    $fechahora = date('Y-m-d H:i:s', strtotime("$fecha $hora"));
    
    $nombre = htmlspecialchars($_POST["nombre"]);

    $apellidoPaterno = htmlspecialchars($_POST["apellidoPaterno"]);

    $apellidoMaterno = htmlspecialchars($_POST["apellidoMaterno"]);

    $fechaN = htmlspecialchars($_POST["fechaN"]);
    $fechaN = str_replace('/', '-', $fechaN); 
    //var_dump($_POST["Sangre"]);
    //var_dump($_POST["Canalizador"]);
    //var_dump($_POST);
    $estado = htmlspecialchars($_POST["Estado"]);

    $ciudad = htmlspecialchars($_POST["ciudad"]);

    $curp = htmlspecialchars($_POST["curp"]);


    $nExpediente = htmlspecialchars($_POST["nExpediente"]);


    $hermanos = htmlspecialchars($_POST["hermanos"]);
    
    $sangre = htmlspecialchars($_POST["Sangre"]);

    $nDisposicion = htmlspecialchars($_POST["nDisposicion"]);

    $motivoI = htmlspecialchars($_POST["motivoI"]);

    $consideraciones = htmlspecialchars($_POST["consideraciones"]);

    if (editBeneficiaria($id,$sangre, $estado,  $ciudad, $fechahora, $nombre, $apellidoMaterno,  $apellidoPaterno, $fechaN, $curp, $nExpediente, $hermanos,$motivoI,$nDisposicion,$consideraciones)) {
        $_SESSION["mensaje"] = "Se ha modificado a la beneficiaria";
        //cho "success";
    } else {
        $_SESSION["warning"] = "Ocurrió un error al modificar a la beneficiaria";
    }
    



    
    header("Status: 301 Moved Permanently");

    header("location:../../expedientes.php");
    exit;
    

    
    


?>