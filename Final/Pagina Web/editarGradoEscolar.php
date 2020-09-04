<?php
    session_start();
    if(isset($_SESSION["Rol"])){
    require_once("util.php");
    include("Partials/General/_head.html");
    include("Partials/General/_topBar.html");
    include("Partials/General/_sideBar.html");
    include("Partials/General/_topBody.html");
    include("Partials/EditarGradoEscolar/_editarGradoEscolarTitulo.html");
    if(($_SESSION["Modificar plan educativo"]==1)){
        include("Partials/EditarGradoEscolar/_editarGradoEscolarFormularioHead.html");
    
        $gradoEscolar_id = htmlspecialchars($_GET["gradoEscolar_id"]);
        echo"<form action=\"Controladores\GradoEscolar\controladorEditarGradoEscolar.php?gradoEscolar_id=$gradoEscolar_id\" method=\"post\">";
        echo textGradoEscolar($gradoEscolar_id);
        include("Partials/EditarGradoEscolar/_editarGradoEscolarFormularioFoot.html");
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