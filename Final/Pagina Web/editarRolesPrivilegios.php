<?php
    session_start();
    if(isset($_SESSION["Rol"])){
        require_once("util.php");
        include("Partials/General/_head.html");
        include("Partials/General/_topBar.html");
        include("Partials/General/_sideBar.html");
        include("Partials/General/_topBody.html");
        if(($_SESSION["Modificar privilegios de un rol"]==1) ){
            include("Partials/EditarRolesPrivilegios/_editarRolesPrivilegiosTitulo.html");
            include("Partials/EditarRolesPrivilegios/_editarRolesPrivilegiosFormularioHead.html");
                $Relacion_id = htmlspecialchars($_GET["Relacion_id"]);
                $Relacion1_id = htmlspecialchars($_GET["Relacion1_id"]);
                $Relacion2_id = htmlspecialchars($_GET["Relacion2_id"]);
                echo"<form action=\"Controladores\RolesPrivilegios\controladorEditarRolesPrivilegios.php?Relacion_id=$Relacion_id\" method=\"post\">";
            include("Partials/EditarRolesPrivilegios/_editarRolesPrivilegiosFormularioForm.html");
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