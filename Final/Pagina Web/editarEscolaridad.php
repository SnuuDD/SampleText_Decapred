<?php
    session_start();
    if(isset($_SESSION["Rol"])){
    require_once("util.php");
    include("Partials/General/_head.html");
    include("Partials/General/_topBar.html");
    include("Partials/General/_sideBar.html");
    include("Partials/General/_topBody.html");
    if(($_SESSION["Modificar escolaridad"]==1)){

        include("Partials/EditarEscolaridad/_editarEscolaridadTitulo.html");
        
        include("Partials/EditarEscolaridad/_editarEscolaridadFormularioHead.html");
        $escolaridad_id = htmlspecialchars($_GET["escolaridad_id"]);
        $beneficiaria_id = htmlspecialchars($_GET["beneficiaria_id"]);
        $escuela_id = htmlspecialchars($_GET["escuela_id"]);
        $gradoEscolar_id = htmlspecialchars($_GET["gradoEscolar_id"]);

        
        echo"
            <form id='regForm' action=\"Controladores\Escolaridad\controladorEditarEscolaridad.php?escolaridad_id=$escolaridad_id\" method=\"post\">
        ";

    include("Partials/EditarEscolaridad/_editarEscolaridadFormulario.html");

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