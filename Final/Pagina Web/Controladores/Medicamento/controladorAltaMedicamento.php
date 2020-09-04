<?php
    session_start();
    require_once("../../util.php");
   
        $nombre = htmlspecialchars($_POST["nombre"]);
        $ingrediente = htmlspecialchars($_POST['ingrediente']);
        $presentacion = htmlspecialchars($_POST['Presentacion']);

        if (nuevoMedicamento($nombre,$ingrediente,$presentacion)) {
            $_SESSION["mensaje"] = "Se ha agregado el Medicamento";
            header("Status: 301 Moved Permanently");

            header("location:../../consultaMedicamento.php");
            exit;
        } else {
            $_SESSION["warning"] = "Ocurrió un error al agregar el Medicamento";
        }
    
?>