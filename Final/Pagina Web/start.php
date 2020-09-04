<?php
  session_start();
  require_once("util.php");  
  insertarUsuario("Administrador","admin@admin.admin","admin");
  insertarRolesUsuarios(1,1);
  insertarRolesUsuarios(1,2);

  insertarUsuario("Área psicología","areapsicologia@areapsicologia.areapsicologia","psicologia1");
  insertarRolesUsuarios(2,5);
  insertarRolesUsuarios(2,3);

  insertarUsuario("Área educativa","areaeducativa@areaeducativa.areaeducativa","psicologia2");
  insertarRolesUsuarios(3,5);
  insertarRolesUsuarios(3,3);

  insertarUsuario("Área amédica","areamedica@areamedica.areamedica","areamedica");
  insertarRolesUsuarios(4,4);
  insertarRolesUsuarios(4,3);

  insertarUsuario("Dirección General ","direcciongeneral@direcciongeneral.direcciongeneral","dgneeded");
  insertarRolesUsuarios(5,3);
  insertarRolesUsuarios(5,2);

  insertarUsuario("Presidencia fundadora ","presidenciafundadora@presidenciafundadora.presidenciafundadora","pfneeded");
  insertarRolesUsuarios(6,3);
?>