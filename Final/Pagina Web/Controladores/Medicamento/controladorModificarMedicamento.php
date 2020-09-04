<?php
    session_start();
    require_once("../../util.php");

        $id=$_SESSION["medicamento_id"];
        $nombre = htmlspecialchars($_POST["nombre"]);
        $ingrediente = htmlspecialchars($_POST['ingrediente']);
        $presentacion = htmlspecialchars($_POST['Presentacion']);
        if (modificarMedicamento($id,$nombre,$ingrediente,$presentacion)) {
            $_SESSION["mensaje"] = "Se ha editado correctamente";
        } else {
            $_SESSION["warning"] = "Ocurrió un error al modificar";
        }
        header("Status: 301 Moved Permanently");

    header("location:../../consultaMedicamento.php");
    exit;
?>