<?php
//Funcion para conectarse a base de datos

function conectar_bd() {

      $conexion_bd = mysqli_connect("localhost","root","","rbac");

      if ($conexion_bd == NULL) {

          die("No se pudo conectar con la base de datos");

      }

      return $conexion_bd;
}

//función para desconectarse de una bd

function desconectar_bd($conexion_bd) {

    mysqli_close($conexion_bd);

}


//Función para iniciar sesión y recuperar los permisos

//@param $username: El nombre del usuario

//@param $username: El password del usuario

function autenticar($username, $password){
    $con = conectar_bd();

    $query = "select p.Id_privilegio as per, u.nombre as nom
from usuario as u,roles_usuario as ru,roles as r,roles_privilegios as rp,privilegios as p
where u.Id_Usuario = ru.Id_Usuario 
and ru.Id_Rol = r.Id_Rol
and r.Id_Rol = rp.Id_Rol
and rp.Id_Privilegio = p.Id_Privilegio
and u.Id_Usuario='$username'
and u.Contrasena = '$password'";
    
    $result = mysqli_query($con, $query);
    
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
       if($row['per'] == 'AgregarAreaTrabajo'){
            $_SESSION['AgregarAreaTrabajo'] = 1;
       }
       if($row['per'] == 'AgregarPrivilegios'){
            $_SESSION['AgregarPrivilegios'] = 1;
       }
        if($row['per'] == 'AgregarSeccion'){
            $_SESSION['AgregarSeccion'] = 1;
       }
        if($row['per'] == 'CrearUsuario'){
            $_SESSION['CrearUsuario'] = 1;
       }
        if($row['per'] == 'EliminarAreaTrabajo'){
            $_SESSION['EliminarAreaTrabajo'] = 1;
       }
        if($row['per'] == 'EliminarSeccion'){
            $_SESSION['EliminarSeccion'] = 1;
       }
        if($row['per'] == 'EliminarUsuario'){
            $_SESSION['EliminarUsuario'] = 1;
       }
        if($row['per'] == 'HabilitarPersonal'){
            $_SESSION['HabilitarPersonal'] = 1;
       }
        if($row['per'] == 'InformacionPersonal'){
            $_SESSION['InformacionPersonal'] = 1;
       }
        if($row['per'] == 'ModificarCliente'){
            $_SESSION['ModificarCliente'] = 1;
       }
        //mitad
        if($row['per'] == 'ModificarInformacionPersonal'){
            $_SESSION['ModificarInformacionPersonal'] = 1;
       }
        if($row['per'] == 'NuevaTransaccion'){
            $_SESSION['NuevaTransaccion'] = 1;
       }
        if($row['per'] == 'RealizarSubConsultas'){
            $_SESSION['RealizarSubConsultas'] = 1;
       }
        if($row['per'] == 'TransaccionesRealizadas'){
            $_SESSION['TransaccionesRealizadas'] = 1;
       }
        if($row['per'] == 'VisualizarAreaTrabajo'){
            $_SESSION['VisualizarAreaTrabajo'] = 1;
       }
        
       if($row['per'] == 'VisualizarCuenta'){
            $_SESSION['VisualizarCuenta'] = 1;
       }
        if($row['per'] == 'VisualizarPersonalHabilitado'){
            $_SESSION['VisualizarPersonalHabilitado'] = 1;
       }
        if($row['per'] == 'VisualizarUsuariosRegistrados'){
            $_SESSION['VisualizarUsuariosRegistrados'] = 1;
       }
       
        
       $_SESSION['nombre'] = $row['nom'];
    }
    desconectar_bd($con);
  }


//valor 1 es el valor menor en el rango

function consultaTransM($valor1,$valor2){
    $con = conectar_bd();

    $query = "select * from usuario_transaccion where monto >= '$valor1' and monto <= '$valor2'";
    
    
    $result = mysqli_query($con, $query);
    
    $table = "";
    
    if(mysqli_num_rows($result)){
        $table .= "<table class=\"striped centered\">";
        $table .="<thead><tr><th>Id_Us-Trans</th><th>Monto</th><th>Fecha</th><th>Tipo</th><th>Id_Seccion</th><th>Id_Usuario</th></tr></thead>";
        while($row = mysqli_fetch_assoc($result)){   
            $table.= "<tr>";
            $table.= "<td>". $row["Id_Us-Trans"]. "</td>";
            $table.= "<td>". $row["Monto"]. "</td>";
            $table.= "<td>". $row["Fecha"]. "</td>";
            $table.= "<td>". $row["Tipo"]. "</td>";
            $table.= "<td>". $row["Id_Seccion"]. "</td>";
            $table.= "<td>". $row["Id_Usuario"]. "</td>";
            $table.= "</tr>";
        }
        $table.= "</table>";
    }
    
    
    return $table;
    
    
}


function consultaInfoN($valor1){
    $con = conectar_bd();

    $query = "Select * From Usuario as U Where U.Nombre = '$valor1'";
    
    $result = mysqli_query($con, $query);
    
    $table = "";
    
    if(mysqli_num_rows($result)){
        $table .= "<table class=\"striped centered\">";
        $table .="<thead><tr><th>Id_Usuario</th><th>Nombre</th><th>Apellidos</th><th>Fecha_Creacion</th><th>Fecha_Nacimiento</th><th>Balance</th><th>Contrasena</th><th>Habilitado</th></tr></thead>";

        while($row = mysqli_fetch_assoc($result)){   
            $table.= "<tr>";
            $table.= "<td>". $row["Id_Usuario"]. "</td>";
            $table.= "<td>". $row["Nombre"]. "</td>";
            $table.= "<td>". $row["Apellidos"]. "</td>";
            $table.= "<td>". $row["Fecha_Creacion"]. "</td>";
            $table.= "<td>". $row["Fecha_Nacimiento"]. "</td>";
            $table.= "<td>". $row["Balance"]. "</td>";
            $table.= "<td>". $row["Apellidos"]. "</td>";
            $table.= "<td>". $row["Contrasena"]. "</td>";
            $table.= "</tr>";
        }
        $table.= "</table>";
    }
    
    
    return $table;
    
    
}

function consultaTransTipo($valor1){
    $con = conectar_bd();

    $query = "select * from usuario_transaccion where usuario_transaccion.tipo = '$valor1'";
    
    $result = mysqli_query($con, $query);
    
    $table = "";
    
    if(mysqli_num_rows($result)){
        $table .= "<table class=\"striped centered\">";
        $table .="<thead><tr><th>Id_Us-Trans</th><th>Monto</th><th>Fecha</th><th>Tipo</th><th>Seccion</th><th>Usuario</th></thead>";

        while($row = mysqli_fetch_assoc($result)){   
            $table.= "<tr>";
            $table.= "<td>". $row["Id_Us-Trans"]. "</td>";
            $table.= "<td>". $row["Monto"]. "</td>";
            $table.= "<td>". $row["Fecha"]. "</td>";
            $table.= "<td>". $row["Tipo"]. "</td>";
            $table.= "<td>". $row["Id_Seccion"]. "</td>";
            $table.= "<td>". $row["Id_Usuario"]. "</td>";
            $table.= "</tr>";
        }
        $table.= "</table>";
    }
    
    
    return $table;
    
    
}


  function getTransaccionNombre($nombreC=""){
    $con = conectar_bd();

    $query = 
    "SELECT ut.*,u.Nombre,u.Apellidos FROM usuario_transaccion AS ut, usuario AS u
    WHERE ut.Id_Usuario = u.Id_Usuario AND u.Nombre LIKE '$nombreC'";
    $result = mysqli_query($con, $query);

    $resultado=" 
    <div class='container pt-3'>
       <table class='table'>
           <thead class='thead-dark'>
               <tr> 
                   <th> Id </th> 
                   <th> Monto </th> 
                   <th> Fecha </th> 
                   <th> Tipo </th> 
                   <th> Id de seccion </th> 
                   <th> Id usuario </th> 
                   <th> Nombre</th> 
                   <th> Apellidos</th> 
               </tr>
           </thead>
     ";
   while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
       $id=$row['Id_Us-Trans'];
       $monto=$row['Monto'];
       $fecha=$row['Fecha'];
       $tipo=$row['Tipo'];
       $idSeccion=$row['Id_Seccion'];
       $idUsuario=$row['Id_Usuario'];
       $nombre = $row['Nombre'];
       $apellidos =$row['Apellidos'];

       $resultado.= "
       <tr>
           <td>$id</td>
           <td>$monto</td>
           <td>$fecha</td>
           <td>$tipo</td>
           <td>$idSeccion</td>
           <td>$idUsuario</td>
           <td>$nombre</td>
           <td>$apellidos</td>

        </tr>";
   }
   $resultado.=  "
       </table>
   </div>";
   desconectar_bd($con);
    return $resultado;
}
function consultaArea(){
    $con = conectar_bd();

    $query = "SELECT * FROM `areatrabajo`";
    
    $result = mysqli_query($con, $query);
    
    $table = "";
    
    if(mysqli_num_rows($result)){
        $table .= "<table class=\"striped centered\">";
        $table .="<thead><tr><th>Area</th><th>Descripcion</th></tr></thead>";
        while($row = mysqli_fetch_assoc($result)){   
            $table.= "<tr>";
            $table.= "<td>". $row["Id_AreaTrabajo"]. "</td>";
            $table.= "<td>". $row["Descripcion_AreaTrabajo"]. "</td>";
            $table.= "</tr>";
        }
        $table.= "</table>";
    }
    return $table;
    
}

function trabaFecha(){
    $con = conectar_bd();

    $query = "select traba.*,tA.Id_AreaTrabajo,tA.Fecha FROM trabajadores AS traba, trabajadores_areatrabajo AS tA WHERE traba.Id_Usuario = tA.Id_Usuario";
    
    $result = mysqli_query($con, $query);
    
    $table = "";
    
    if(mysqli_num_rows($result)){
        $table .= "<table class=\"striped centered\">";
        $table .="<thead><tr><th>Id_Usuario</th><th>Telefono</th><th>Seguro</th><th>Sueldo</th><th>RFC</th><th>Id_AreaTrabajo</th><th>Fecha</th></tr></thead>";

        while($row = mysqli_fetch_assoc($result)){   
            $table.= "<tr>";
            $table.= "<td>". $row["Id_Usuario"]. "</td>";
            $table.= "<td>". $row["Telefono"]. "</td>";
            $table.= "<td>". $row["Seguro"]. "</td>";
            $table.= "<td>". $row["Sueldo"]. "</td>";
            $table.= "<td>". $row["RFC"]. "</td>";
            $table.= "<td>". $row["Id_AreaTrabajo"]. "</td>";
            $table.= "<td>". $row["Fecha"]. "</td>";
            $table.= "</tr>";
        }
        $table.= "</table>";
    }
    
	
    return $table;
    
    
}

?>
