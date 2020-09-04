<?php
    session_start();
    if(isset($_SESSION["Rol"])){

    include("util.php");

    include("Partials/General/_head.html");
    include("Partials/General/_topBar.html");
    include("Partials/General/_sideBar.html");
    include("Partials/General/_topBody.html");
    if(($_SESSION["Modificar un contacto en directorio"]==1)){
        $id = htmlspecialchars($_GET["canalizador_id"]);
        $institucion = htmlspecialchars($_GET["i"]);
        $_SESSION["idC"] = $_GET["canalizador_id"];
        include("Partials/EditarCanalizador/_editarCanalizadorTitulo.html"); 
        echo editCanalizador($id);
        //x
        echo crear_selectInstituciones("idInstitucion", "nombre", "Institucion",$institucion);
        echo editCanalizador2($id);
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
                <span class=\"card-title\">Usted no ha iniciado sesión, por favor, hágalo</span>
            </div>
        </div>
    </div>
</div>";
}
    include("Partials/General/_endBody.html");
    include("Partials/General/_endPage.html");
?>