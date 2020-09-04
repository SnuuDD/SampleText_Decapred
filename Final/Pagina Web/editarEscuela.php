<?php
    session_start();
    if(isset($_SESSION["Rol"])){
    require_once("util.php");
    include("Partials/General/_head.html");
    include("Partials/General/_topBar.html");
    include("Partials/General/_sideBar.html");
    include("Partials/General/_topBody.html");
    if(($_SESSION["Modificar escuela"]==1)){

    include("Partials/EditarEscuela/_editarEscuelaTitulo.html");
    include("Partials/EditarEscuela/_editarEscuelaFormularioHead.html");
        $escuela_id = htmlspecialchars($_GET["escuela_id"]);
        echo"<form action=\"Controladores\Escuela\controladorEditarEscuela.php?escuela_id=$escuela_id\" method=\"post\">";
        //echo ;
    include("Partials/EditarEscuela/_editarEscuelaFormularioForm.html");
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