<?php
    session_start();
    if(isset($_SESSION["Rol"])){

    include("util.php");
    
    include("Partials/General/_head.html");
    include("Partials/General/_topBar.html");
    include("Partials/General/_sideBar.html");
    include("Partials/General/_topBody.html");
    if(($_SESSION["Modificar programa de atención"]==1)){

    $id = htmlspecialchars($_GET["programa_id"]);
    $_SESSION["idP"] = $_GET["programa_id"];
    include("Partials/EditarPrograma/_editarProgramaTitulo.html"); 
    echo ProgramasEdit($id);

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