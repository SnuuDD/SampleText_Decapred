<?php
    require_once("../../util.php");
    include("Partials/General/_head.html");
    include("Partials/General/_topBar.html");
   
    include("Partials/General/_sideBar.html");
    include("Partials/General/_topBody.html");
    if(isset($_POST['Registrar'])){
        $nombre = htmlspecialchars($_POST["nombre"]);

        nuevaPresentacion($nombre);
        include("Partials/AltaPresentacion/_altaPresentacionTitulo.html");
        echo "<div class=\"card-content white-text green lighten-2\">
        <span class=\"card-title\">Registro Exitoso</span>
        </div>";
       

            showQueryPresentacion(getPresentacion());
    }
    include("Partials/General/_endBody.html");
    include("Partials/General/_endPage.html");
?>