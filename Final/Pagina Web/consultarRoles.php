<?php
    session_start();
    if(isset($_SESSION["Rol"])){
        require_once("util.php");
        include("Partials/General/_head.html");
        include("Partials/General/_topBar.html");
        include("Partials/General/_sideBar.html");
        include("Partials/General/_topBody.html");
        if(($_SESSION["Consultar roles"]==1) ){
            include("Partials/ConsultarRoles/_RolesTitulo.html");
            include("Partials/ConsultarRoles/_fedback.html");
        
            echo "<div class=\"row\">";
                echo "<div class=\"col s12\">";
                include("Partials/ConsultarRoles/_ConsultaRolesHead.html");
                include("Partials/ConsultarRoles/_ConsultaRoles.html");    //cambio, para hacer nuestra tabla de Consultar de programas dinamica debemos partir en 2 partials este archivo
                $Roles = "";
                echo"<div id='rolesResultado'>";
                echo getRoles($Roles);
                echo"</div>";
                include("Partials/ConsultarRoles/_ConsultaRolesFoot.html");
                echo "</div>";
            echo "</div>";
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