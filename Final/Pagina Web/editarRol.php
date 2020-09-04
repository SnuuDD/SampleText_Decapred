<?php
    session_start();
    if(isset($_SESSION["Rol"])){
        require_once("util.php");
        include("Partials/General/_head.html");
        include("Partials/General/_topBar.html");
        include("Partials/General/_sideBar.html");
        include("Partials/General/_topBody.html");
        if(($_SESSION["Modificar rol"]==1) ){
                include("Partials/EditarRol/_editarRolTitulo.html");
            include("Partials/EditarRol/_editarRolFormularioHead.html");
                $Rol_id = htmlspecialchars($_GET["Rol_id"]);
                echo"<form action=\"Controladores\Roles\controladorEditarRol.php?Rol_id=$Rol_id\" method=\"post\">";
            include("Partials/EditarRol/_editarRolFormularioForm.html");
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