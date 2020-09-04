SET FOREIGN_KEY_CHECKS=0;

/*Temporal drop table para testear la creacion de las tablas para la base de datos*/
DROP TABLE IF EXISTS  Beneficiaria;
DROP TABLE IF EXISTS  Canalizador;
DROP TABLE IF EXISTS  Institucion;
DROP TABLE IF EXISTS  Escuela;
DROP TABLE IF EXISTS  Escolaridad;
DROP TABLE IF EXISTS  Estado;
DROP TABLE IF EXISTS  Diagnostico;
DROP TABLE IF EXISTS  Coordinaciones;
DROP TABLE IF EXISTS  Especialidad;
DROP TABLE IF EXISTS  Fotos;
DROP TABLE IF EXISTS  Album;
DROP TABLE IF EXISTS  DocAnexos;
DROP TABLE IF EXISTS  Discapacidad;
DROP TABLE IF EXISTS  DiscapacidadBeneficiaria;
DROP TABLE IF EXISTS  TipoDeSangre;
DROP TABLE IF EXISTS  ProgramaAtencion;
DROP TABLE IF EXISTS  ProgramaAtencionFotos;
DROP TABLE IF EXISTS  Medicamentos;
DROP TABLE IF EXISTS  Presentacion;
DROP TABLE IF EXISTS  Receta;
DROP TABLE IF EXISTS  Usuario;
DROP TABLE IF EXISTS  UsuarioRol;
DROP TABLE IF EXISTS  Rol;
DROP TABLE IF EXISTS  RolPrivilegios;
DROP TABLE IF EXISTS  Privilegios;
DROP TABLE IF EXISTS  ProgramaAtencionBeneficiaria;
DROP TABLE IF EXISTS  BeneficiariaCanalizador;
DROP TABLE IF EXISTS  GradoEscolar;
DROP TABLE IF EXISTS  Area;
DROP TABLE IF EXISTS  Ciudad;
/*Termina temporal drop table para testear la creacion de las tablas para la base de datos*/
/*****###########################  Mer   #########################****/
/*Tablas Mer*/
CREATE TABLE `Beneficiaria`
(
	`idDeIngreso` int(11) not null AUTO_INCREMENT,
  `idTipoSangre` int(11) ,
  `idEstado` int(11) ,
  `ciudad` varchar(50),
	`fechaHoraIngreso` timestamp,
	`nombre` varchar(40),
	`apellidoM` varchar(40),
	`apellidoP` varchar(40),
	/**`edad` int(5),**/
	`fechaNacimiento` DATETIME ,
	`curp` varchar(18),
	`noDeExpediente` varchar(50),
	`ingresoConHermanos` BOOLEAN,
	`motivoIngreso` varchar(5000),
	`noDisposicion` int(11),
	`consideracionesGenerales` varchar(5000),
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idDeIngreso`),
  FOREIGN KEY (`idTipoSangre`)  REFERENCES `TipoDeSangre`(`idTipoSangre`),
  FOREIGN KEY (`idEstado`)      REFERENCES `Estado`(`idEstado`)
);
CREATE TABLE `Canalizador` 
(
	`IdCanalizador` int (11) not null AUTO_INCREMENT,
  `idInstitucion` int (11) not null,
  `nombre` varchar(100) not null,
	`cargo` varchar(60),
	`telefono`   varchar(20),
	`correoElectronico` varchar(40),
	`tipoIdentificacion` varchar(40),
	`numeroDeIdentificacion` varchar(40),
  `motivo` varchar(300),
  `activo` BOOLEAN not null,
  PRIMARY KEY (`IdCanalizador`),
  FOREIGN KEY (`idInstitucion`)  REFERENCES `Institucion`(`idInstitucion`)
  
);
CREATE TABLE `Institucion`(
	`idInstitucion` int (11) not null AUTO_INCREMENT,
	`nombre` varchar(100) not null,
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idInstitucion`)
);
CREATE TABLE `Escuela`
(
	`idEscuela` int(11) not null AUTO_INCREMENT,
	`nombre`    varchar(100) not null,
  `direccion` varchar(200),
	`director`  varchar(100),
  `telefono`  varchar(20),
  `contacto`  varchar(100),
  `correo`  varchar(100),
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idEscuela`)
);
CREATE TABLE `Estado` (
	`idEstado` int(11) not null AUTO_INCREMENT,
	`nombre`  varchar(40) not null,
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idEstado`)
);

CREATE TABLE `Coordinaciones`
(
	`idCoordinaciones` int(11) not null AUTO_INCREMENT,
	`nombre` varchar(60) not null,
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idCoordinaciones`)

);
CREATE TABLE `Especialidad`
(
	`idEspecialidad` int(11) not null AUTO_INCREMENT,
  `idCoordinaciones` int(11) not null,
	`nombre` varchar(60) not null,
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idEspecialidad`,`idCoordinaciones`),
  FOREIGN KEY (`idCoordinaciones`)  REFERENCES `Coordinaciones`(`idCoordinaciones`)
);

CREATE TABLE `Discapacidad`
(
	`idDiscapacidad` int(11) not null AUTO_INCREMENT,
	`Nombre` varchar(50),
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idDiscapacidad`)
);
CREATE TABLE `TipoDeSangre`
(
	`idTipoSangre` int(11) not null AUTO_INCREMENT,
	`Nombre` varchar(20),
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idTipoSangre`)
);
CREATE TABLE `ProgramaAtencion`
(
	`idProgramaAtencion`  int(11) not null AUTO_INCREMENT,
  `idCoordinaciones` int(11) not null,
	`nombre` varChar(60),
	`fechaInicial` DATETIME not null,
	`fechaFinal` DATETIME,
	`objetivo` varchar(1500),
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idProgramaAtencion`,`idCoordinaciones`),
  FOREIGN KEY (`idCoordinaciones`) REFERENCES `Coordinaciones` (`idCoordinaciones`)
);
CREATE TABLE `Medicamentos`
(
 `idMedicamento` int(11) not null AUTO_INCREMENT,
 `nombre` varchar(40) not null,
 `ingredienteActivo` varchar(40) not null,
 `idPresentacion` int(11) not null,
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idMedicamento`,`idPresentacion`),
  FOREIGN KEY (`idPresentacion`) REFERENCES `Presentacion` (`idPresentacion`)
);
CREATE TABLE `Presentacion`
(
	`idPresentacion` int(11) not null AUTO_INCREMENT,
	`nombre` varchar(40) not null,
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idPresentacion`)
);
CREATE TABLE `GradoEscolar`
(
	`idGradoEscolar` int(11) not null AUTO_INCREMENT,
	`nombre` varchar(60) not null,
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idGradoEscolar`)
);
CREATE TABLE `Receta`
(
	`idReceta` int(11) not null AUTO_INCREMENT,
  `idDeIngreso` int(11) not null,
  `idMedicamento` int(11) not null,
	`fechaIni` DATETIME not null,
	`fechaFin` DATETIME,
	`descripcion` varchar(300) not null,
	`dosis` varchar(50) not null,
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idReceta`,`idDeIngreso`,`idMedicamento`),
  FOREIGN KEY (`idDeIngreso`) REFERENCES `Beneficiaria` (`idDeIngreso`),
  FOREIGN KEY (`idMedicamento`) REFERENCES `Medicamentos` (`idMedicamento`)

);

CREATE TABLE `ProgramaAtencionBeneficiaria`
(
  `idProgramaAtencionBeneficiaria` int(11) not null AUTO_INCREMENT,
  `idDeIngreso` int(11) not null ,
	`idProgramaAtencion` int(11) not null,
  `fechaRegistro` DATETIME not null,
  `observaciones` varchar(1000) not null,
  `motivo` varchar(1000) not null,
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idProgramaAtencionBeneficiaria`,  `fechaRegistro`,`idProgramaAtencion`,`idDeIngreso`),
  FOREIGN KEY (`idDeIngreso`) REFERENCES `Beneficiaria` (`idDeIngreso`),
  FOREIGN KEY (`idProgramaAtencion`) REFERENCES `ProgramaAtencion` (`idProgramaAtencion`)

);

CREATE TABLE `DiscapacidadBeneficiaria`
(
  `idDiscapacidadBeneficiaria` int(11) not null AUTO_INCREMENT,
	`idDiscapacidad` int(11) not null,
  `idDeIngreso` int(11) not null,
  `fecha` DATETIME not null,
  `activo` BOOLEAN not null,
  `Tratamiento` varchar(2000) not null,
  PRIMARY KEY (`idDiscapacidadBeneficiaria`,`idDeIngreso`,`idDiscapacidad`),
  FOREIGN KEY (`idDeIngreso`) REFERENCES `Beneficiaria` (`idDeIngreso`),
  FOREIGN KEY (`idDiscapacidad`) REFERENCES `Discapacidad` (`idDiscapacidad`)

);

CREATE TABLE `Diagnostico`
(
	`idDiagnostico` int(11) not null AUTO_INCREMENT,
	`idDeIngreso` int(11) not null ,
  `idEspecialidad` int(11) not null,
	`fecha` DATE not null,
	`tratamiento` varchar(500),
	`descripcion` varchar(500),
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idDiagnostico`,`idDeIngreso`,`idEspecialidad`),
  FOREIGN KEY (`idEspecialidad`) REFERENCES `Especialidad` (`idEspecialidad`),
  FOREIGN KEY (`idDeIngreso`) REFERENCES `Beneficiaria` (`idDeIngreso`)

);
CREATE TABLE `Escolaridad`
(
	`idEscolaridad` int(11) not null AUTO_INCREMENT,
	`idDeIngreso` int(11) not null ,
	`idEscuela` int(11) not null,
	`idGradoEscolar` int(11) not null,
	`nombreTutor` varChar(200),
  `telefono`  varchar(10),
  `fechaInicio` DATETIME,
  `fechaFin` DATETIME,
	`correoElectronico` varchar(40),
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idEscolaridad`,`idDeIngreso`,`idEscuela`,`idGradoEscolar`),
  FOREIGN KEY (`idEscuela`) REFERENCES `Escuela` (`idEscuela`),
  FOREIGN KEY (`idGradoEscolar`) REFERENCES `GradoEscolar` (`idGradoEscolar`),
  FOREIGN KEY (`idDeIngreso`) REFERENCES `Beneficiaria` (`idDeIngreso`)
);
CREATE TABLE `BeneficiariaCanalizador`
(
	`idBeneficiariaCanalizador` int(11) not null AUTO_INCREMENT,
	`idDeIngreso` int(11) not null ,
	`IdCanalizador` int(11) not null,
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idBeneficiariaCanalizador`,`idDeIngreso`,`IdCanalizador`),
  FOREIGN KEY (`IdCanalizador`) REFERENCES `Canalizador` (`IdCanalizador`),
  FOREIGN KEY (`idDeIngreso`) REFERENCES `Beneficiaria` (`idDeIngreso`)
);

CREATE TABLE `Usuario`
(
	`idUser` int(11) not null AUTO_INCREMENT,
	`Usuario` varchar(80) not null,
	`password` varchar(100) not null,
	`nombre` varchar(100) not null,
	`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idUser`)
);
CREATE TABLE `Rol`
(
	`idRol`   int(11) not null AUTO_INCREMENT,
	`nombre` varchar(80) not null,
	`descripcion` varchar(100) not null,
	`created_at` timestamp NOT NULL DEFAULT current_timestamp()	,
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idRol`)
);
CREATE TABLE `Privilegios`
(
	`idPrivilegios`   int(11) not null AUTO_INCREMENT,
	`nombre` varchar(80) not null,
	`descripcion` varchar(120) not null,
	`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idPrivilegios`)
);


CREATE TABLE `UsuarioRol`
(
  `idUsuarioRol`   int(11) not null AUTO_INCREMENT,
  `idUser` int(11) not null,
  `idRol`   int(11) not null,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idUsuarioRol`,`idUser`,`idRol`),
  FOREIGN KEY (`idUser`) REFERENCES `Usuario` (`idUser`),
  FOREIGN KEY (`idRol`) REFERENCES `Rol` (`idRol`)
);
CREATE TABLE `RolPrivilegios`
(
  `idRolPrivilegios` int(11) not null AUTO_INCREMENT,	
  `idPrivilegios`   int(11) not null ,
  `idRol`   int(11) not null,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idRolPrivilegios`,`idPrivilegios`,`idRol`),
  FOREIGN KEY (`idPrivilegios`) REFERENCES `Privilegios` (`idPrivilegios`),
  FOREIGN KEY (`idRol`) REFERENCES `Rol` (`idRol`)
);

INSERT INTO `Estado` (`nombre`,`activo`)
VALUE
('Aguascalientes',1),
('Baja California',1),
('Baja California Sur',1),
('Campeche',1),
('Chiapas',1),
('Chihuahua',1),
('Coahuila',1),
('Colima',1),
('Distrito Federal',1),
('Durango',1),
('Estado de México',1),
('Guanajuato',1),
('Guerrero',1),
('Hidalgo',1),
('Jalisco',1),
('Michoacán',1),
('Morelos',1),
('Nayarit',1),
('Nuevo León',1),
('Oaxaca',1),
('Puebla',1),
('Querétaro',1),
('Quintana Roo',1),
('San Luis Potosí',1),
('Sinaloa',1),
('Sonora',1),
('Tabasco',1),
('Tamaulipas',1),
('Tlaxcala',1),
('Veracruz',1),
('Yucatán',1),
('Zacatecas',1);

INSERT INTO `TipoDeSangre` (`nombre`,`activo`)
VALUE
('O +',1),
('O -',1),
('A -',1),
('A +',1),
('B -',1),
('B +',1),
('AB -',1),
('AB +',1);

INSERT INTO `GradoEscolar` (`nombre`,`activo`)
VALUE
('Primaria 1 grado',1),
('Primaria 2 grado',1),
('Primaria 3 grado',1),
('Primaria 4 grado',1),
('Primaria 5 grado',1),
('Primaria 6 grado',1),
('Secundaria 1 grado',1),
('Secundaria 2 grado',1),
('Secundaria 3 grado',1),
('Preparatoria 1 semestre',1),
('Preparatoria 2 semestre',1),
('Preparatoria 4 semestre',1),
('Preparatoria 5 semestre',1),
('Preparatoria 6 semestre',1),
('Preparatoria 6 semestre',1);


INSERT INTO `Presentacion` (`nombre`,`activo`)
VALUE
('Cápsulas',1),
('Tabletas',1),
('Jarabes',1),
('Pastas',1),
('Pomadas',1),
('Cremas',1),
('Soluciones',1),
('Supositorios',1),
('Otros',1);

INSERT INTO `Rol`(`nombre`,`descripcion`,`activo`)
VALUE
('Administrador','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Director','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Medico','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Psicologo','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1);
INSERT INTO `Privilegios`(`nombre`,`descripcion`,`activo`)
VALUE
/*1*/
('Consultar usuarios del sistema','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Consultar usuario del sistema','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Crear usuario','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Modificar usuario','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Eliminar usuario','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
/*6*/
('Consultar roles de usuario del sistema','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Eliminar rol de usuario','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Cambiar rol de usuario','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Asignar rol a usuario','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
/*10*/
('Consultar roles','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Eliminar rol','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Crear rol','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Modificar rol','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
/*14*/
('Consultar privilegios de los roles','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Asignar privilegios de un rol','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Eliminar privilegios de un rol','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Modificar privilegios de un rol','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
/*18*/
('Consultar privilegios','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),

/*19*/
('Consulta de beneficiarias','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Consultar beneficiaria','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Elimnar beneficiaria','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Modificar beneficiaria','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Registrar beneficiaria','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
/*24*/
('Consulta recetas','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Crear receta','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Modificar receta','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Eliminar receta','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
/*28*/
('Consultar medicamentos','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Registrar medicamento','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Modificar medicamento','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Eliminar medicamento','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
/*32*/
('Consultar directorio','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Consultar un contacto en directorio','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Registrar un contacto en directorio','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Modificar un contacto en directorio','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Eliminar un contacto en directorio','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
/*37*/
('Consultar instituciones','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Registrar institucion','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Modificar institucion','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Eliminar institucion','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
/*41*/
('Consulta escolaridades','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Registrar escolaridad','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Modificar escolaridad','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Eliminar escolaridad','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
/*45*/
('Consultar escuelas','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Consultar escuela','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Registrar escuela','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Modificar escuela','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Eliminar escuela','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
/*50*/
('Consultar planes educativos','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Registrar plan educativo','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Modificar plan educativo','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Eliminar plan educativo','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
/*54*/
('Consultar diagnóstico','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Registrar diagnóstico','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Modificar diagnóstico','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Eliminar diagnóstico','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
/*58*/
('Consultar áreas','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Registrar área','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Modificar área','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Eliminar área','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
/*62*/
('Consultar especialidades','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Registrar especialidad','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Eliminar especialidad','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Editar especialidad','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
/*66*/
('Consultar discapacidades','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Registrar discapacidad','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Eliminar discapacidad','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Editar discapacidad','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
/*70*/
('Consultar discapacidades de beneficiaria','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Registrar discapacidad a beneficiaria','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Eliminar discapacidad de beneficiaria','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Editar discapacidad de beneficiaria','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
/*74*/
('Consultar programas de atencion','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Consultar programa de atencion','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Registrar programa de atencion','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Modificar programa de atencion','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Eliminar programa de atencion','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
/*79*/
('Consultar programas de atencion de beneficiaria','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Registrar programa de atencion a beneficiaria','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Modificar vinculación de programa de atencion con beneficiaria','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1),
('Eliminar programa de atencion de beneficiaria','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean laoreet ac est sit amet gravida.',1);
INSERT INTO`RolPrivilegios`(`idRol`,`idPrivilegios`,`activo`)
VALUE
/*Administrador*/
  /*Inicio usuario*/
  (1,1,1),
  (1,2,1),
  (1,3,1),
  (1,4,1),
  (1,5,1),
  /*fin usuario*/
  /*Inicio usuario rol*/
  (1,6,1),
  (1,7,1),
  (1,8,1),
  (1,9,1),
  /*fin usuario rol*/
  /*Inicio  rol*/
  (1,10,1),
  (1,11,1),
  (1,12,1),
  (1,13,1),
  /*Fin rol*/
  /*Inicio rol privilegios*/
  (1,14,1),
  (1,15,1),
  (1,16,1),
  (1,17,1),
  /*Fin rol privilegios*/
  /*Inicio  privilegios*/
  (1,18,1),
  /*Fin  privilegios*/
/*Fin administrador*/

/*Director*/
  /*Inicio Beneficiarias*/
  (2,19,1),
  (2,20,1),
  /*Fin beneficiaria*/
  /*Inicio receta*/
  (2,24,1),
  /*Fin receta*/  
  /*Inicio Medicamentos*/
  (2,28,1),
  /*Fin Medicamentos*/
  /*Inicio Directorio*/
  (2,32,1),
  (2,33,1),
  /*Fin Directorio*/
  /*Inicio instituciones*/
  (2,37,1),
  /*Fin instituciones*/
  /*Inicio escolaridad*/
  (2,41,1),
  /*Fin escolaridad*/
  /*Inicio escuela*/
  (2,45,1),
  (2,46,1),
  /*Fin escuela*/
  /*Inicio plan educativo*/
  (2,50,1),
  /*Fin plan educativo*/
  /*Inicio diagnostico*/
  (2,54,1),
  /*Fin diagnostico*/
  /*Inicio areas*/
  (2,58,1),
  /*Fin areas*/
  /*Inicio especialidades*/
  (2,62,1),
  /*Fin especialidades*/
  /*Inicio discpacidades*/
  (2,66,1),
  /*Fin discapacidades*/
  /*Inicio discpacidades de beneficiaria*/
  (2,70,1),
  /*Fin discapacidades de beneficiaria*/
   /*Inicio discpacidades de programas de atencion*/
  (2,74,1),
  (2,75,1),
  /*Fin discapacidades de progranas de atencion*/
  /*Inicio discpacidades de programas de atencion beneficiaria*/
  (2,79,1),
  /*Fin discapacidades de progranas de atencion beneficiaria*/
/*Fin director*/
/*Medico*/
  /*Inicio Beneficiarias*/
  (3,19,1),
  (3,20,1),
  (3,21,1),
  (3,22,1),
  (3,23,1),
  /*Fin beneficiaria*/
  /*Inicio receta*/
  (3,24,1),
  (3,25,1),
  (3,26,1),
  (3,27,1),
  /*Fin receta*/  
  /*Inicio Medicamentos*/
  (3,28,1),
  (3,29,1),
  (3,30,1),
  (3,31,1),
  /*Fin Medicamentos*/
  /*Inicio Directorio*/
  (3,32,1),
  (3,33,1),
  (3,34,1),
  (3,35,1),
  (3,36,1),
  /*Fin Directorio*/
  /*Inicio instituciones*/
  (3,37,1),
  (3,38,1),
  (3,39,1),
  (3,40,1),
  /*Fin instituciones*/
  /*Inicio escolaridad*/
  (3,41,1),
  /*Fin escolaridad*/
  /*Inicio escuela*/
  (3,45,1),
  (3,46,1),
  /*Fin escuela*/
  /*Inicio plan educativo*/
  (3,50,1),
  /*Fin plan educativo*/
  /*Inicio diagnostico*/
  (3,54,1),
  (3,55,1),
  (3,56,1),
  (3,57,1),
  /*Fin diagnostico*/
  /*Inicio areas*/
  (3,58,1),
  (3,59,1),
  (3,60,1),
  (3,61,1),
  /*Fin areas*/
  /*Inicio especialidades*/
  (3,62,1),
  (3,63,1),
  (3,64,1),
  (3,65,1),
  /*Fin especialidades*/
  /*Inicio discpacidades*/
  (3,66,1),
  (3,67,1),
  (3,68,1),
  (3,69,1),
  /*Fin discapacidades*/
  /*Inicio discpacidades de beneficiaria*/
  (3,70,1),
  (3,71,1),
  (3,72,1),
  (3,73,1),
  /*Fin discapacidades de beneficiaria*/
   /*Inicio discpacidades de programas de atencion*/
  (3,74,1),
  (3,75,1),
  (3,76,1),
  (3,77,1),
  (3,78,1),
  /*Fin discapacidades de progranas de atencion*/
  /*Inicio discpacidades de programas de atencion beneficiaria*/
  (3,79,1),
  (3,80,1),
  (3,81,1),
  (3,82,1),
  /*Fin discapacidades de progranas de atencion beneficiaria*/
/*Fin medico*/



/*Psicologo*/
  /*Inicio Beneficiarias*/
  (4,19,1),
  (4,20,1),
  (4,21,1),
  (4,22,1),
  (4,23,1),
  /*Fin beneficiaria*/
  /*Inicio receta*/
  (4,24,1),
  (4,25,1),
  (4,26,1),
  (4,27,1),
  /*Fin receta*/  
  /*Inicio Medicamentos*/
  (4,28,1),
  (4,29,1),
  (4,30,1),
  (4,31,1),
  /*Fin Medicamentos*/
  /*Inicio Directorio*/
  (4,32,1),
  (4,33,1),
  (4,34,1),
  (4,35,1),
  (4,36,1),
  /*Fin Directorio*/
  /*Inicio instituciones*/
  (4,37,1),
  (4,38,1),
  (4,39,1),
  (4,40,1),
  /*Fin instituciones*/
  /*Inicio escolaridad*/
  (4,41,1),
  (4,42,1),
  (4,43,1),
  (4,44,1),
  /*Fin escolaridad*/
  /*Inicio escuela*/
  (4,45,1),
  (4,46,1),
  (4,47,1),
  (4,48,1),
  (4,49,1),
  /*Fin escuela*/
  /*Inicio plan educativo*/
  (4,50,1),
  (4,51,1),
  (4,52,1),
  (4,53,1),
  /*Fin plan educativo*/
  /*Inicio diagnostico*/
  (4,54,1),
  (4,55,1),
  (4,56,1),
  (4,57,1),
  /*Fin diagnostico*/
  /*Inicio areas*/
  (4,58,1),
  (4,59,1),
  (4,60,1),
  (4,61,1),
  /*Fin areas*/
  /*Inicio especialidades*/
  (4,62,1),
  (4,63,1),
  (4,64,1),
  (4,65,1),
  /*Fin especialidades*/
  /*Inicio discpacidades*/
  (4,66,1),
  (4,67,1),
  (4,68,1),
  (4,69,1),
  /*Fin discapacidades*/
  /*Inicio discpacidades de beneficiaria*/
  (4,70,1),
  (4,71,1),
  (4,72,1),
  (4,73,1),
  /*Fin discapacidades de beneficiaria*/
   /*Inicio discpacidades de programas de atencion*/
  (4,74,1),
  (4,75,1),
  (4,76,1),
  (4,77,1),
  (4,78,1),
  /*Fin discapacidades de progranas de atencion*/
  /*Inicio discpacidades de programas de atencion beneficiaria*/
  (4,79,1),
  (4,80,1),
  (4,81,1),
  (4,82,1)
  /*Fin discapacidades de progranas de atencion beneficiaria*/
/*Fin Psicologo*/
  ;
  /*
INSERT INTO `UsuarioRol`(`idUser`,`idRol`, `created_at`,`activo`)
VALUE

(1,1,'2019-3-15',1),
(2,2,'2018-2-15',1),
(3,3,'2017-1-15',1),
(4,4,'2016-12-15',1);
*/
SET FOREIGN_KEY_CHECKS=1;