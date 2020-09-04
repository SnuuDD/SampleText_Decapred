<?php
    session_start();
    //var_dump($_SESSION);
    if(isset($_SESSION["Rol"])){
        require_once("util.php");
        include("Partials/General/_head.html");
        include("Partials/General/_topBar.html");
        include("Partials/General/_sideBar.html");
        include("Partials/General/_topBody.html");
        if(($_SESSION["Consulta escolaridades"]==1) ){
            include("Partials/ConsultaEscolaridad/_escolaridadTitulo.html");
            include("Partials/ConsultaEscolaridad/_fedback.html");
            include("Partials/ConsultaEscolaridad/_consultaEscolaridadHead.html");
            echo "<div class=\"row\">";
                echo "<div class=\"col s12\">";
               
                include("Partials/ConsultaEscolaridad/_consultaEscolaridad.html");    //cambio, para hacer nuestra tabla de consulta de programas dinamica debemos partir en 2 partials este archivo
                $escolaridad = "";
                if(isset($_GET['ingreso_id'])){
                    $_SESSION["ingreso_id"] =htmlspecialchars($_GET['ingreso_id']);
                }
                echo getEscolaridad($escolaridad, $_SESSION["ingreso_id"]);
                
                include("Partials/ConsultaEscolaridad/_consultaEscolaridadFoot.html");
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