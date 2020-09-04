function buscarP() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    console.log("hola");
    $.post("Controladores\\Programa\\controladorConsultaPrograma.php", {
        Nombre: document.getElementById("Programa").value
        }).done(function (data) {
        $("#resultadoPrograma").html(data);
    });
}
function buscarU() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("Controladores\\Usuario\\controladorConsultaUsuario.php", {
        Nombre: document.getElementById("Usuario").value
        }).done(function (data) {
        $("#resultadoUsuarios").html(data);
    });
}
function buscarRoles() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("Controladores\\Roles\\controladorConsultaRol.php", {
        Nombre: document.getElementById("Roles").value
        }).done(function (data) {
        $("#resultadoRoles").html(data);
    });
}
function buscarPrivilegios() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("Controladores\\Privilegios\\controladorConsultaPrivilegios.php", {
        Nombre: document.getElementById("Privilegios").value
        }).done(function (data) {
        $("#resultadoPrivilegios").html(data);
    });
}
function buscarRolesUsuarios() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("Controladores\\RolesUsuario\\controladorConsultaRolesUsuario.php", {
        Nombre: document.getElementById("RolesUsuario").value
        }).done(function (data) {
        $("#resultadoRolesUsuarios").html(data);
    });
}
function buscarRolesPrivilegios() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("Controladores\\RolesPrivilegios\\controladorConsultaRolesPrivilegios.php", {
        Nombre: document.getElementById("RolesPrivilegios").value
        }).done(function (data) {
        $("#resultadoRolesPrivilegios").html(data);
    });
}
function buscarR() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    console.log("hola");
    $.post("Controladores\\Receta\\controladorConsultaReceta.php", {
        Nombre: document.getElementById("Receta").value
        }).done(function (data) {
        $("#resultadoReceta").html(data);
    });
}

function buscarE() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    console.log("Expediente");
    $.post("Controladores\\Expediente\\controladorConsultaExpediente.php", {
        Nombre: document.getElementById("ExpedienteNombre").value
        }).done(function (data) {
        $("#resultadoExpediente").html(data);
    });
}

function ciudadesD() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    console.log("Expediente ciudad");
    $.post("Controladores\\Expediente\\controladorConsultaExpedienteCiudades.php", {
        Id: document.getElementById("estado").value
        }).done(function (data) {
        $("#ciudad").html(data);
    });
}

function cambiaAform() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    console.log("Expediente canalizador");
    
    $.post("Controladores\\Expediente\\controladorDeFormCanalizador.php", {
        }).done(function (data) {
        $("#datoscanalizador").html(data);
            $('select').formSelect();
    });
}
function cambiaformDiscapacidad() {
    //document.getElementById("Discapacidad").options[2].selected=true;
    
    $.post("Controladores\\DiscapacidadBeneficiaria\\controladorDeFormDiscapacidad.php", {
        SELECT:document.getElementById('Discapacidad').value
        }).done(function (data) {
        $("#discapacidadBeneficiariaForm").html(data);
            
    });
}
function cambiaformGradoEscolar() {    
    $.post("Controladores\\Escolaridad\\controladorDeFormGradoEscolar.php", {
        SELECT:document.getElementById('GradoEscolar').value
        }).done(function (data) {
        $("#planEducativoForm").html(data);
            
    });
}
function cambiaformEscuela() {
    $.post("Controladores\\Escolaridad\\controladorDeFormEscuela.php", {
        SELECT:document.getElementById('Escuela').value
        }).done(function (data) {
        $("#escuelaForm").html(data);
            
    });
}

//Si nuestro elemento existe entonces deberíamos 
//Asignar al botón buscar, la función buscar() correspondiente
if ($('#Programa').length > 0) {
    document.getElementById("Programa").onkeyup = buscarP;
}
//Si nuestro elemento existe entonces deberíamos 
//Asignar al botón buscar, la función buscar() correspondiente
if ($('#Receta').length > 0) {
    document.getElementById("Receta").onkeyup = buscarR;
}

if ($('#Receta').length > 0) {
    autosize(document.getElementById("observaciones"));
}
//Si nuestro elemento existe entonces deberíamos 
//Asignar al botón buscar, la función buscar() correspondiente
if ($('#ExpedienteNombre').length > 0) {
    document.getElementById("ExpedienteNombre").onkeyup = buscarE;
}

if ($('#estado').length > 0) {
    document.getElementById("estado").onchange = ciudadesD;
}

//Si nuestro elemento existe entonces deberíamos 
//Asignar al botón buscar, la función buscar() correspondiente
if ($('#agregarcanalizador').length > 0) {
    document.getElementById("agregarcanalizador").onclick = cambiaAform;
}
if (document.getElementById('Discapacidad')!=null) {
    document.getElementById("Discapacidad").onchange = cambiaformDiscapacidad;
}
if (document.getElementById('Escuela')!=null) {
    document.getElementById("Escuela").onchange = cambiaformEscuela;
}
if (document.getElementById('GradoEscolar')!=null) {
    document.getElementById("GradoEscolar").onchange = cambiaformGradoEscolar;
}

function revisarFormPrograma(){
    let e=document.getElementById("Coordinacioness").value; //alert(e);
    if(e===""){
        alert("Por favor, seleccione un Area.");
        return false;
    }

    let d=document.getElementById("fechaF").value; //alert(d);
    if(!d){
        alert("Por favor, seleccione una fecha tentativa de termino.");
        return false;
    }

    let I=document.getElementById("fechaI").value; //alert(d);
    if(!I){
        alert("Por favor, seleccione una fecha tentativa de inicio.");
        return false;
    }

    let O=document.getElementById("objetivo").value; //alert(d);
    if(!O){
        alert("No ha seleccionado un objetivo. Utilice \"no aplica\" en caso que no haya alguno.");
        return false;
    }
  }
  
  
  if ($('#testFormPrograma').length > 0) {
    document.getElementById("testFormPrograma").onclick = revisarFormPrograma;
  }
  

//OOOOOOOOOOOOOOOOOOOOOOOOOWWWWWWWWWWWWWWWWWWWWWOOOOOOOOOOOOOOOOO
function buscarInstitucion() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    //console.log("xdxd me wa morir jajaj");
    $.post("Controladores\\Institucion\\controladorConsultaInstitucion.php", {
        Nombre: document.getElementById("Institucion").value
        }).done(function (data) {
        $("#resultadoInstitucion").html(data);
    });
}


//Si nuestro elemento existe entonces deberíamos 
//Asignar al botón buscar, la función buscar() correspondiente
if ($('#Institucion').length > 0) {
    document.getElementById("Institucion").onkeyup = buscarInstitucion;
}
function buscarEscuela() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("Controladores\\Escuela\\controladorConsultaEscuela.php", {
        Nombre: $("#Escuela").val()
        }).done(function (data) {
        $("#resultadoEscuela").html(data);
    });
}
function buscarGradoEscolar() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("Controladores\\GradoEscolar\\controladorConsultaGradoEscolar.php", {
        Nombre: $("#GradoEscolar").val()
        }).done(function (data) {
        $("#resultadoGradoEscolar").html(data);
    });
}
function buscarEscolaridad() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    if(document.getElementById("BuscarPor").value==0){
        document.getElementById("Escolaridad").placeholder = "Secundaria General Numero 4";
    }
    if(document.getElementById("BuscarPor").value==1){
        document.getElementById("Escolaridad").placeholder = "Primaria primer año";
    }
    $.post("Controladores\\Escolaridad\\controladorConsultarEscolaridad.php", {
        Nombre: $("#Escolaridad").val(),
        Buscar: $("#BuscarPor").val(),
        Ordernar: $("#OrdenarPor").val(),
        }).done(function (data) {
        $("#resultadoEscolaridad").html(data);
    });
}
function buscarDiscapacidad() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("Controladores\\Discapacidad\\controladorConsultaDiscapacidad.php", {
        Nombre: $("#Discapacidad").val()
        }).done(function (data) {
        $("#resultadoDiscapacidad").html(data);
    });
}
function buscarCoordinaciones() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("Controladores\\Coordinaciones\\controladorConsultaCoordinaciones.php", {
        Nombre: $("#Coordinaciones").val()
        }).done(function (data) {
        $("#resultadoCoordinaciones").html(data);
    });
}
function buscarEspecialidad() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("Controladores\\Especialidad\\controladorConsultaEspecialidad.php", {
        Nombre: $("#Especialidad").val()
        }).done(function (data) {
        $("#resultadoEspecialidad").html(data);
    });
}
function buscarDiscapacidadBeneficiaria() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("Controladores\\DiscapacidadBeneficiaria\\controladorConsultarDiscapacidad.php", {
        Nombre: $("#DiscapacidadBeneficiaria").val(),
        Orden: $("#OrdenarPorD").val(),
        }).done(function (data) {
        $("#resultadosDiscapacidades").html(data);
    });
}
if ($('#DiscapacidadBeneficiaria').length > 0) {
    document.getElementById("DiscapacidadBeneficiaria").onkeyup = buscarDiscapacidadBeneficiaria;
}
if (document.getElementById('OrdenarPorD') != null) {
    document.getElementById("OrdenarPorD").onchange = buscarDiscapacidadBeneficiaria;
}
//Si nuestro elemento existe entonces deberíamos 
//Asignar al botón buscar, la función buscar() correspondiente
if ($('#Escuela').length > 0) {
    document.getElementById("Escuela").onkeyup = buscarEscuela;
}
if ($('#GradoEscolar').length > 0) {
    document.getElementById("GradoEscolar").onkeyup = buscarGradoEscolar;
}
if ($('#Escolaridad').length > 0) {
    document.getElementById("Escolaridad").onkeyup = buscarEscolaridad;
}
if (document.getElementById('BuscarPor') != null) {
    document.getElementById("BuscarPor").onchange  = buscarEscolaridad;
}
if (document.getElementById('OrdenarPor')!= null) {
    document.getElementById("OrdenarPor").onchange  = buscarEscolaridad;
}

if ($('#Discapacidad').length > 0) {
    document.getElementById("Discapacidad").onkeyup = buscarDiscapacidad;
}

if ($('#Coordinaciones').length > 0) {
    document.getElementById("Coordinaciones").onkeyup = buscarCoordinaciones;
}
if ($('#Especialidad').length > 0) {
    document.getElementById("Especialidad").onkeyup = buscarEspecialidad;
}


function buscarMedicamento() {
    $.post("Controladores\\Medicamento\\controladorConsultaMedicamento.php", {
        Nombre: document.getElementById("Medicamento").value
        }).done(function (data) {
        $("#resultadoMedicamento").html(data);
    });
}

if ($('#Medicamento').length > 0) {
    document.getElementById("Medicamento").onkeyup = buscarMedicamento;
}

function buscarCanalizador() {
    $.post("Controladores\\Canalizador\\controladorConsultaCanalizador.php", {
        Nombre: document.getElementById("Canalizador").value
        }).done(function (data) {
        $("#resultadoCanalizador").html(data);
    });
}

if ($('#Canalizador').length > 0) {
    document.getElementById("Canalizador").onkeyup = buscarCanalizador;
}

function cambiarDiagnostico() {
    $.post("Controladores\\Diagnostico\\controladorConsultaDiagnostico.php", {
        X: document.getElementById("Diagnostico").value,
        Y: document.getElementById("CoordinacionesD").value
        }).done(function (data) {
        $("#diagnosticos").html(data);
    });
}
if ($('#Usuario').length > 0) {
    document.getElementById("Usuario").onkeyup = buscarU;
}
if ($('#Privilegios').length > 0) {
    document.getElementById("Privilegios").onkeyup = buscarPrivilegios;
}
if ($('#Roles').length > 0) {
    document.getElementById("Roles").onkeyup = buscarRoles;
}
if ($('#RolesUsuarios').length > 0) {
    document.getElementById("RolesUsuarios").onkeyup = buscarRolesUsuarios;
}
if ($('#RolesPrivilegios').length > 0) {
    document.getElementById("RolesPrivilegios").onkeyup = buscarRolesPrivilegios;
}






if ($('#RecetasB').length > 0) {
    document.getElementById("RecetasB").onkeyup = buscarReceta;
}
if (document.getElementById('OrdenarPorR')!= null) {
    document.getElementById("OrdenarPorR").onchange  = buscarReceta;
}
function buscarReceta() {
    $.post(".\\Controladores\\Receta\\controladorConsultarReceta.php", {
        Nombre: $("#RecetasB").val(),
        Ordernar: $("#OrdenarPorR").val(),
        }).done(function (data) {
        $("#Recetas").html(data);
    });
}





if ($('#ProgramasBeneficiariaB').length > 0) {
    document.getElementById("ProgramasBeneficiariaB").onkeyup = buscarProgramaBeneficiaria;
}
if (document.getElementById('OrdenarPor')!= null) {
    document.getElementById("OrdenarPor").onchange  = buscarProgramaBeneficiaria;
}
function buscarProgramaBeneficiaria() {
    $.post("Controladores\\Programa\\controladorConsultarProgramaBeneficiaria.php", {
        Nombre: $("#ProgramasBeneficiariaB").val(),
        Buscar: $("#BuscarPor").val(),
        Ordernar: $("#OrdenarPor").val(),
        }).done(function (data) {
        $("#ProgramasBeneficiaria").html(data);
    });
}




if ($('#UsuarioB').length > 0) {
    document.getElementById("UsuarioB").onkeyup = buscarUsuario;
}
function buscarUsuario() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("Controladores\\Usuario\\controladorConsultaUsuario.php", {
        Nombre: $("#UsuarioB").val()
        }).done(function (data) {
        $("#resultadoUsuarios").html(data);
    });
}

if ($('#RolesUsuarioB').length > 0) {
    document.getElementById("RolesUsuarioB").onkeyup = buscarRolesUsuarios;
}
if (document.getElementById('Rol')!= null) {
    document.getElementById("Rol").onchange  = buscarRolesUsuarios;
}
function buscarRolesUsuarios() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("Controladores\\RolesUsuarios\\controladorConsultaRolesUsuarios.php", {
        Nombre: $("#RolesUsuarioB").val(),
        Rol: $("#Rol").val(),
        }).done(function (data) {
        $("#resultadosRolesUsuarios").html(data);
    });
}

if ($('#RolesB').length > 0) {
    document.getElementById("RolesB").onkeyup = buscarRoles;
}
function buscarRoles() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("Controladores\\Roles\\controladorConsultaRol.php", {
        Nombre: $("#RolesB").val()
        }).done(function (data) {
        $("#rolesResultado").html(data);
    });
}

if ($('#RolesPrivilegiosB').length > 0) {
    document.getElementById("RolesPrivilegiosB").onkeyup = buscarRolesPrivilegiosB;
}
function buscarRolesPrivilegiosB() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("Controladores\\RolesPrivilegios\\controladorConsultaRolesPrivilegios.php", {
        Nombre: $("#RolesPrivilegiosB").val()
        }).done(function (data) {
        $("#rolesPrivilegiosR").html(data);
    });
}

if ($('#PrivilegioBuscar').length > 0) {
    document.getElementById("PrivilegioBuscar").onkeyup = buscarPrivilegioBuscar;
}
function buscarPrivilegioBuscar() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("Controladores\\Privilegios\\controladorConsultaPrivilegios.php", {
        Nombre: $("#PrivilegioBuscar").val()
        }).done(function (data) {
        $("#privilegiosB").html(data);
    });
}
