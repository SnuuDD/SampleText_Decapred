<?php
    session_start();
    if(isset($_SESSION["Rol"])){
    require_once("util.php");
    include("Partials/General/_head.html");
    include("Partials/General/_topBar.html");
    include("Partials/General/_sideBar.html");
    include("Partials/General/_topBody.html");
    if(($_SESSION["Modificar área"]==1)){
        include("Partials/EditarCoordinaciones/_editarCoordinacionesTitulo.html");
        include("Partials/EditarCoordinaciones/_editarCoordinacionesFormularioHead.html");
        $Coordinaciones_id = htmlspecialchars($_GET["Coordinaciones_id"]);
        echo"<form action=\"Controladores\Coordinaciones\controladorEditarCoordinaciones.php?Coordinaciones_id=$Coordinaciones_id\" method=\"post\">";
        echo textCoordinaciones($Coordinaciones_id);
        include("Partials/EditarCoordinaciones/_editarCoordinacionesFormularioFoot.html");
    }else{
        echo "<div class=\"row\">
        <div class=\"col s12 m12 l12\">
            <div class=\"card red lighten-1\">
                <div class=\"card-content white-text\">
                    <span class=\"card-title\">Usted no tiene permisos para acceder a esta sección</span>
                </div>
            </div>
        </div>
        </div>";
    }
    }else{
        echo "<div class=\"row\">
        <div class=\"col s12 m12 l12\">
            <div class=\"card red lighten-1\">
                <div class=\"card-content white-text\">
                    <span class=\"card-title\">Usted no tiene permisos para acceder a esta sección</span>
                </div>
            </div>
        </div>
    </div>";
    }
    include("Partials/General/_endBody.html");
    include("Partials/General/_endPage.html");
?>  