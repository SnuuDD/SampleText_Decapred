<?php
    session_start();
    if(isset($_SESSION["Rol"])){
    require_once("util.php");
    include("Partials/General/_head.html");
    include("Partials/General/_topBar.html");
    include("Partials/General/_sideBar.html");
    include("Partials/General/_topBody.html");
    
    if(($_SESSION["Editar especialidad"]==1)){
        include("Partials/EditarEspecialidad/_editarEspecialidadTitulo.html");
        include("Partials/EditarEspecialidad/_editarEspecialidadFormularioHead.html");
        $especialidad_id = htmlspecialchars($_GET["especialidad_id"]);
        $Coordinaciones_id = htmlspecialchars($_GET["Coordinaciones_id"]);
        echo"<form action=\"Controladores\Especialidad\controladorEditarEspecialidad.php?especialidad_id=$especialidad_id\" method=\"post\">";
        echo textEspecialidad($especialidad_id);
        echo "
        <div class=\"file-field input-field\">
        <div class=\"input-field col s12\">
          <i class=\"material-icons prefix\"> </i>
            ".crear_selectCoordinaciones($Coordinaciones_id)." 
        </div>
      </div> ";
        include("Partials/EditarEspecialidad/_editarEspecialidadFormularioFoot.html");
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
                <span class=\"card-title\">Usted no ha iniciado sesión, por favor, hagalo</span>
            </div>
        </div>
    </div>
</div>";
}
    include("Partials/General/_endBody.html");
    include("Partials/General/_endPage.html");
?>  