<?php
    session_start();
    include("_header.html");
    include("_navbar.html");
    require_once("util.php");

    //$_SESSION["AgregarAreaTrabajo"] = 1;
    if(isset($_SESSION["AgregarAreaTrabajo"])){
        echo "<a class=\"waves-effect waves-light btn\">Agregar Area De Trabajo</a>";
    }

    if(isset($_SESSION["AgregarPrivilegios"])){
        echo "<a class=\"waves-effect waves-light btn\">Agregar Privilegios</a>";
    }

    if(isset($_SESSION["AgregarSeccion"])){
        echo "<a class=\"waves-effect waves-light btn\">Agregar Seccion</a>";
    }

    if(isset($_SESSION["CrearUsuario"])){
        echo "<a class=\"waves-effect waves-light btn\">Crear Usuario</a>";
    }

    if(isset($_SESSION["EliminarAreaTrabajo"])){
        echo "<a class=\"waves-effect waves-light btn\">Eliminar Area de Trabajo</a>";
    }

    if(isset($_SESSION["EliminarSeccion"])){
        echo "<a class=\"waves-effect waves-light btn\">Eliminar Seccion</a>";
    }

    if(isset($_SESSION["EliminarUsuario"])){
        echo "<a class=\"waves-effect waves-light btn\">Eliminar Usuario</a>";
    }

    if(isset($_SESSION["HabilitarPersonal"])){
        echo "<a class=\"waves-effect waves-light btn\">Habilitar Personal</a>";
    }
    
    if(isset($_SESSION["InformacionPersonal"])){
        echo "<a class=\"waves-effect waves-light btn\">Informacion Personal</a>";
    }

    if(isset($_SESSION["ModificarCliente"])){
        echo "<a class=\"waves-effect waves-light btn\">Modificar Cliente</a>";
    }

    if(isset($_SESSION["ModificarInformacionPersonal"])){
        echo "<a class=\"waves-effect waves-light btn\">Modificar Informacion Personal</a>";
    }
    if(isset($_SESSION["NuevaTransaccion"])){
        echo "<a class=\"waves-effect waves-light btn\">Nueva Transaccion</a>";
    }
    if(isset($_SESSION["RealizarSubConsultas"])){
        echo "<a class=\"waves-effect waves-light btn\">Realizar SubConsultas</a>";
    }
    if(isset($_SESSION["TransaccionesRealizadas"])){
        echo "<a class=\"waves-effect waves-light btn\">Transacciones Realizadas</a>";
    }
    if(isset($_SESSION["VisualizarAreaTrabajo"])){
        echo "<a class=\"waves-effect waves-light btn\">Visualizar Area Trabajo</a>";
    }
    if(isset($_SESSION["VisualizarCuenta"])){
        echo "<a class=\"waves-effect waves-light btn\">Visualizar Cuenta</a>";
    }
    if(isset($_SESSION["VisualizarPersonalHabilitado"])){
        echo "<a class=\"waves-effect waves-light btn\">Visualizar Personal Habilitado</a>";
    }
    if(isset($_SESSION["VisualizarUsuariosRegistrados"])){
        echo "<a class=\"waves-effect waves-light btn\">Visualizar Usuarios Registrados</a>";
    }

    
    print "
    <form method='POST' action='transaccioNombre.php'>
        <input type='text' id='tNombre' name='tNombre'>
        <input class='waves-effect waves-light btn' type='submit' value='Registrar'>
    </form>
    
    
    ";
    if(isset($_POST['tNombre'])){
        $t = getTransaccionNombre($_POST['tNombre']);
        print "
            $t
        ";
    }

    

    include("_footer.html");
    


?>