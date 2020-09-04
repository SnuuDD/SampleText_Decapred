<?php
    session_start();
    if(isset($_SESSION["Rol"])){
    include("util.php");
    include("Partials/General/_head.html");
    include("Partials/General/_topBar.html");
    include("Partials/General/_sideBar.html");
    include("Partials/General/_topBody.html");
    if(($_SESSION["Modificar vinculación de programa de atención con beneficiaria"]==1)){

        $id = htmlspecialchars($_GET["idProgramaAtencionBeneficiaria"]);
        //var_dump($id);
        
        $_SESSION["idRelacion"] = $id;
        $ingreso_id= htmlspecialchars($_SESSION["ingreso_id"]);
        //var_dump($ingreso_id);
        include("Partials/EditarVinculacion/_editarVinculacionTitulo.html"); 
        echo VinculacionEdit($id,$ingreso_id);
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