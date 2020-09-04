<?php
    session_start();
    require_once("../../util.php");

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

    if(isset($_POST["Canalizador"])){
        $idcanalizador = htmlspecialchars($_POST["Canalizador"]);

        $nExpediente = htmlspecialchars($_POST["nExpediente"]);


        $hermanos = htmlspecialchars($_POST["hermanos"]);
        
        $sangre = htmlspecialchars($_POST["Sangre"]);

        $nDisposicion = htmlspecialchars($_POST["nDisposicion"]);

        $motivoI = htmlspecialchars($_POST["motivoI"]);

        $consideraciones = htmlspecialchars($_POST["consideraciones"]);

        if (altaExpediente($sangre, $estado,  $ciudad, $fechahora, $nombre, $apellidoMaterno,  $apellidoPaterno, $fechaN, $curp, $nExpediente, $hermanos,$motivoI,$nDisposicion,$consideraciones,$idcanalizador)) {
            $_SESSION["mensaje"] = "Se ha agregado la beneficiaria";
            //echo "success";
        } else {
            $_SESSION["warning"] = "Ocurrió un error al la beneficiaria";
        }
    }else{
        //Preparar los datos del canalizador nuevo
        $nombreC = htmlspecialchars($_POST["nombreC"]);
        $telefono = htmlspecialchars($_POST["telefono"]);
        $email = htmlspecialchars($_POST["email"]);
        $identificacion = htmlspecialchars($_POST["identificacion"]);
        $numeroI = htmlspecialchars($_POST["numeroI"]);
        $institucion = htmlspecialchars($_POST["Institucion"]);
        $cargo = htmlspecialchars($_POST["cargo"]);

        $nExpediente = htmlspecialchars($_POST["nExpediente"]);


        $hermanos = htmlspecialchars($_POST["hermanos"]);
        
        $sangre = htmlspecialchars($_POST["Sangre"]);

        $nDisposicion = htmlspecialchars($_POST["nDisposicion"]);

        $motivoI = htmlspecialchars($_POST["motivoI"]);

        $consideraciones = htmlspecialchars($_POST["consideraciones"]);
        $motivoVin = "Registro de beneficiaria $nombre $apellidoMaterno $apellidoPaterno";
        if (altaExpediente($sangre, $estado,  $ciudad, $fechahora, $nombre, $apellidoMaterno,  $apellidoPaterno, $fechaN, $curp, $nExpediente, $hermanos,$motivoI,$nDisposicion,$consideraciones,"") and (nuevoCanalizador($institucion,$nombreC,$cargo,$telefono,$email,$identificacion,$numeroI,$motivoVin))) {
            $_SESSION["mensaje"] = "Se ha agregado la beneficiaria y a su canalizador";
            //echo "success";
        } else {
            $_SESSION["warning"] = "Ocurrió un error al la beneficiariay a su canalizador";
        }



    }
    header("Status: 301 Moved Permanently");

    header("location:../../expedientes.php");
    exit;
    

    
    


?>