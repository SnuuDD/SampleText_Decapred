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
/*
CREATE TABLE `Fotos`
(
	`idFotos` int(11) not null AUTO_INCREMENT,
	`textAlt` varchar(40) not null,
	`urlFotos` varchar(300) not null,
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idFotos`)
);
*/
/*
CREATE TABLE `DocAnexos`
(
	`idDocumento` int(11) not null AUTO_INCREMENT,
	`idDeIngreso` int(11) not null ,
	`nombre` varchar(60) not null,
	`Url` varchar(300) not null,
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idDocumento`,`idDeIngreso`),
  FOREIGN KEY (`idDeIngreso`)  REFERENCES `Beneficiaria`(`idDeIngreso`)
);
*/
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
/*Termina tablas Mer*/
/*Relaciones Mer*/
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
/*
CREATE TABLE `ProgramaAtencionFotos`
(
  `idProgramaAtencionFotos` int(11) not null AUTO_INCREMENT,
	`idProgramaAtencion` int(11) not null,
  `idFotos` int(11) not null,
  `fecha` DATETIME not null,
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idProgramaAtencionFotos`,`idProgramaAtencion`,`idFotos`),
  FOREIGN KEY (`idFotos`) REFERENCES `Fotos` (`idFotos`),
  FOREIGN KEY (`idProgramaAtencion`) REFERENCES `ProgramaAtencion` (`idProgramaAtencion`)
);
*/
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
/*
CREATE TABLE `Album`
(
	`idAlbum` int(11) not null AUTO_INCREMENT,
	`idFotos` int(11) not null,
	`idDeIngreso` int(11) not null,
	`Nombre` varchar(60) not null,
  `activo` BOOLEAN not null,
  PRIMARY KEY (`idAlbum`,`idFotos`,`idDeIngreso`),
  FOREIGN KEY (`idFotos`) REFERENCES `Fotos` (`idFotos`),
  FOREIGN KEY (`idDeIngreso`) REFERENCES `Beneficiaria` (`idDeIngreso`)
);
*/
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

/*Termina relaciones Mer*/
/*****###########################  Termina  Mer   #########################****/

/* ################################ RBAC ################################ */

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

/**Relaciones RBAC**/

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
/**Termina relaciones RBAC**/
/* ################################ Termina RBAC ################################ */


/*//////////////////////////////////////////////////////////////Datos*/


/** Completa  **/
INSERT INTO `Estado` (`nombre`,`activo`)
VALUE
('Desconocido',1),
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


/**Completo*/
INSERT INTO `TipoDeSangre` (`nombre`,`activo`)
VALUE
('Desconocido',1),
('O +',1),
('O -',1),
('A -',1),
('A +',1),
('B -',1),
('B +',1),
('AB -',1),
('AB +',1);


/*mínimo de 20 registros*/

INSERT INTO `Beneficiaria` (`idTipoSangre`,`idEstado`,`ciudad`,`fechaHoraIngreso`,`nombre`,`apellidoM`,`apellidoP`,`fechaNacimiento`,`curp`,`noDeExpediente`,`ingresoConHermanos`,`motivoIngreso`,`noDisposicion`,`consideracionesGenerales`,`activo`) 
VALUES
(1,1,'Ensenada','2019-09-12 03:55:19','Maria','Garcia','Salas','2015-02-11','MAGS091220SRNNMLL','0024151584',1,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,10541504,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1),
(1,4,'Ensenada','2019-09-02 17:21:34','Aarona','Del Rosario','Salinas','2015-10-01','AAHW770826HCLRDN13','0154504545',0,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,05454454,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1),
(1,3,'Ensenada','2019-01-12 03:55:19','Rosario Faustina','Garcia','Morales','2018-04-11','RRRSAGR9811220GHMLL','05899095',1,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,10541504,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1),
(2,3,'Ensenada','2019-03-12 03:55:19','Griselda','Cortés','Fernandez','2010-02-11','GRCFE770084SLNRMl04','4546876543',1,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,10541504,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1),
(1,2,'Ensenada','2015-03-12 03:55:19','Wendy','Wuckert','Boyer','2010-02-11','WEN060899114578','154678464',1,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,10541504,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1),
(4,5,'Ensenada','2014-01-12 03:55:19','Juana Francisca','Buitimea','Ayala','2019-02-11','JASD2154354531','05123845095',1,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,10541504,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1),
(5,4,'Ensenada','2013-01-12 03:55:19','Amanda','Ayala','Cortés','2017-02-11','PERM770826HCLRDR73','a05845095',1,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,10541504,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1),
(6,7,'Ensenada','2019-01-12 03:55:19','Werner','Fernandez','Huitrón','2017-02-11','PERM770826HCLRDR73','a05845095',1,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,10541504,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1),
(5,5,'Ensenada','2019-01-12 03:55:19','Werner','Wuckert','Ayala','2017-02-11','PERM770826HCLRDR73','a05845095',1,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,10541504,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1),
(7,7,'Ensenada','2019-01-12 03:55:19','Werner','Wuckert','Boyer','2017-02-11','PERM770826HCLRDR73','a05845095',1,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,10541504,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1),
(7,4,'Ensenada','2019-01-12 03:55:19','Werner','Wuckert','Boyer','2017-02-11','PERM770826HCLRDR73','a05845095',1,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,10541504,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1),
(7,3,'Ensenada','2019-01-12 03:55:19','Werner','Wuckert','Boyer','2017-02-11','PERM770826HCLRDR73','a05845095',1,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,10541504,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1),
(1,3,'Ensenada','2019-01-12 03:55:19','Werner','Wuckert','Boyer','2017-02-11','PERM770826HCLRDR73','a05845095',1,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,10541504,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1),
(2,4,'Ensenada','2019-01-12 03:55:19','Werner','Wuckert','Boyer','2017-02-11','PERM770826HCLRDR73','a05845095',1,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,10541504,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1),
(4,3,'Ensenada','2019-01-12 03:55:19','Werner','Wuckert','Boyer','2017-02-11','PERM770826HCLRDR73','a05845095',1,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,10541504,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1),
(8,4,'Ensenada','2019-01-12 03:55:19','Werner','Wuckert','Boyer','2017-02-11','PERM770826HCLRDR73','a05845095',1,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,10541504,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1),
(8,7,'Ensenada','2019-01-12 03:55:19','Werner','Wuckert','Boyer','2017-02-11','PERM770826HCLRDR73','a05845095',1,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,10541504,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1),
(8,9,'Ensenada','2019-01-12 03:55:19','Werner','Wuckert','Boyer','2017-02-11','PERM770826HCLRDR73','a05845095',1,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,10541504,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1),
(8,3,'Ensenada','2019-01-12 03:55:19','Werner','Wuckert','Boyer','2017-02-11','PERM770826HCLRDR73','a05845095',1,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,10541504,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1),
(6,1,'Ensenada','2019-01-12 03:55:19','Werner','Wuckert','Boyer','2017-02-11','PERM770826HCLRDR73','a05845095',1,
'Doloremque pariatur qui pariatur dignissimos distinctio sit. Ut quibusdam ipsam veniam eligendi inventore ut animi voluptatibus velit. Dolorum reprehenderit fugiat dolor quas alias numquam nobis commodi qui.'
,10541504,
'Beatae est consequuntur facilis quam voluptatum. Eum eaque facere nihil corporis non voluptatibus labore cumque labore. Odio aut maxime ut voluptatem porro sapiente a. Dignissimos molestias adipisci rem aut vel ut architecto dolorum beatae. Est iure quam aut fuga.'
,1)
;
INSERT INTO `Institucion` (`nombre`,`activo`)
VALUE
('Independiente',1),
('DIF',1),
('Casa Maria Goretti',1),
('SEDESOL',1),
('INDESOL',1),
('Institucion F',1),
('Institucion G',1),
('Institucion H',1),
('Institucion I',1),
('Institucion J',1),
('Institucion K',1),
('Institucion L',1),
('Institucion M',1),
('Institucion N',1),
('Institucion O',1),
('Institucion P',1),
('Institucion Q',1),
('Institucion R',1),
('Institucion S',1),
('Institucion T',1);
/**Completo*/

INSERT INTO `Escuela` (`nombre`,`activo`,`direccion`,`director`,`telefono`,`contacto`,`correo` )
VALUE
('Tec',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam'),
('Escuela A',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam'),
('Escuela B',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam'),
('Escuela C',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam'),
('Escuela D',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam'),
('Escuela F',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam'),
('Escuela G',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam'),
('Escuela H',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam'),
('Escuela I',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam'),
('Escuela J',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam'),
('Escuela K',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam'),
('Escuela L',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam'),
('Escuela M',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam'),
('Escuela N',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam'),
('Escuela O',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam'),
('Escuela P',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam'),
('Escuela Q',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam'),
('Escuela R',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam'),
('Escuela S',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam'),
('Escuela T',1,'sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam','sint dicta veniam');
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
('Preparatoria 6 semestre',1),
('Universidad 1 semestre',1),
('Universidad 2 semestre',1),
('Universidad 3 semestre',1),
('Universidad 4 semestre',1),
('Universidad 5 semestre',1);
/*Completp**/
INSERT INTO `Canalizador` (`idInstitucion` ,`nombre` ,`cargo` ,`telefono`   ,`correoElectronico` ,`tipoIdentificacion` ,`numeroDeIdentificacion`,`motivo`,`activo` )
VALUE
(1,'Efren OConnell','No aplica','824-852-5655','d@outlook.com','INE','A05848754154','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1),
(1,'Delaney Senger','Lead Mobility Facilitator','698-124-2959','ddsa@outlook.com','Pasaporte','2378437','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1),
(3,'Bridie Schmidt','International Accounts Director','836-366-9150','dasd@outlook.com','INE','sfagf','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1),
(2,'Sister Hyatt Sr.','Senior Brand Designer','917-811-2995','d@outlook.com','INE','sgfedvag','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1),
(9,'Melyssa Connelly','Customer Operations Executive','948-226-8638','dfse@outlook.com','Pasaporte','5424','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1),
(7,'Holly Bins','Lead Operations Engineer','752-117-7679','fesd@outlook.com','INE','asgd','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1),
(2,'Eudora Goyette','Dynamic Integration Consultant','176-110-8477','rg@outlook.com','INE','sdag','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1),
(11,'Ms. Nicole Kreiger','Dynamic Optimization Liaison','932-657-3566','dfgd@outlook.com','INE','asgfsa','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1),
(10,'Austen Gislason','Principal Usability Assistant','328-176-2265','gfdgdd@outlook.com','Pasaporte','4520','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1),
(10,'Al Pouros ','Senior Functionality Strategist','580-399-4678','dfgd@outlook.com','Pasaporte','54354','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1),
(19,'Quinton Littel','Central Accountability Orchestrator','573-193-3971','hgfd@outlook.com','INE','asdgfasg','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1),
(18,'Hershel Bins','National Interactions Officer','745-144-6583','htfhd@outlook.com','INE','agdfsfv','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1),
(1,'Wilfred Effertz','Chief Response Orchestrator','103-428-8889','fthd@outlook.com','INE','asdgfsa','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1),
(12,'Ali Kilback','Human Communications Planner','775-918-2253','fhxd@outlook.com','Pasaporte','4536','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1),
(10,'Zoie Durgan','Dynamic Creative Planner','020-697-4104','zdrhd@outlook.com','Pasaporte','4523434','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1),
(9,'Kenya Sanford','Direct Branding Producer','169-510-4908','drzdh@outlook.com','INE','asdfgas','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1),
(4,'Lilian Reichel PhD','Dynamic Assurance Orchestrator','119-623-7338','zdhrd@outlook.com','INE','fdaswf','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1),
(3,'Dr. Edison Mueller','Regional Implementation Administrator','804-353-5995','dzrh@outlook.com','Pasaporte','safsdaasfd','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1),
(1,'Emory Champlin','Central Implementation Engineer','974-095-3996','dzrh@outlook.com','INE','afsdasf','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1),
(2,'Pasquale Towne','Future Factors Facilitator','164-330-6477','hrtd@outlook.com','INE','gersagfasg','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',1);
 /**Completado*/
INSERT INTO `Coordinaciones` (`nombre`,`activo`)
VALUE
('Medcina',1),
('Psicologia',1),
('Educacion',1),
('Área C',1),
('Área D',1),
('Área F',1),
('Área G',1),
('Área H',1),
('Área I',1),
('Área J',1),
('Área K',1),
('Área L',1),
('Área M',1),
('Área N',1),
('Área O',1),
('Área P',1),
('Área Q',1),
('Área R',1),
('Área S',1),
('Área T',1);

/**Completado**/
INSERT INTO `Especialidad` (`idCoordinaciones`,`nombre`,`activo`)
VALUE
(1,'Medicina General',1),
(1,'Psicologia General',1),
(2,'Educacion General',1),
(4,'Especialidad C',1),
(1,'Especialidad D',1),
(2,'Especialidad F',1),
(3,'Especialidad G',1),
(2,'Especialidad H',1),
(1,'Especialidad I',1),
(6,'Especialidad J',1),
(8,'Especialidad K',1),
(9,'Especialidad L',1),
(12,'Especialidad M',1),
(15,'Especialidad N',1),
(18,'Especialidad O',1),
(12,'Especialidad P',1),
(19,'Especialidad Q',1),
(2,'Especialidad R',1),
(1,'Especialidad S',1),
(3,'Especialidad T',1);
/**Completo*/
/*
INSERT INTO `Fotos` (`textAlt`,`urlFotos`,`activo`)
VALUE
('Foto','http://lorempixel.com/640/480/abstract',1),
('Fotos A','https://s3.amazonaws.com/uifaces/faces/twitter/anatolinicolae/128.jpg',1),
('Fotos B','http://lorempixel.com/640/480/sports',1),
('Fotos C','http://lorempixel.com/640/480/people',1),
('Fotos D','http://lorempixel.com/640/480/people',1),
('Fotos F','http://lorempixel.com/640/480/animals',1),
('Fotos G','http://lorempixel.com/640/480/animals',1),
('Fotos H','http://lorempixel.com/640/480/nightlife',1),
('Fotos I','http://lorempixel.com/640/480/transport',1),
('Fotos J','http://lorempixel.com/640/480/food',1),
('Fotos K','http://lorempixel.com/640/480/nature',1),
('Fotos L','http://lorempixel.com/640/480/sports',1),
('Fotos M','http://lorempixel.com/640/480/cats',1),
('Fotos N','http://lorempixel.com/640/480/transport',1),
('Fotos O','http://lorempixel.com/640/480/technics',1),
('Fotos P','http://lorempixel.com/640/480/transport',1),
('Fotos Q','http://lorempixel.com/640/480/sports',1),
('Fotos R','http://lorempixel.com/640/480/abstract',1),
('Fotos S','http://lorempixel.com/640/480/business',1),
('Fotos T','https://s3.amazonaws.com/uifaces/faces/twitter/bryan_topham/128.jpg',1);
*/
/**Completo**/
INSERT INTO `Discapacidad` (`nombre`,`activo`)
VALUE
('Monoplejia',1),
('Parálisis cerebral',1),
('Amputación',1),
('Discapacidad C',1),
('Discapacidad D',1),
('Discapacidad F',1),
('Discapacidad G',1),
('Discapacidad H',1),
('Discapacidad I',1),
('Discapacidad J',1),
('Discapacidad K',1),
('Discapacidad L',1),
('Discapacidad M',1),
('Discapacidad N',1),
('Discapacidad O',1),
('Discapacidad P',1),
('Discapacidad Q',1),
('Discapacidad R',1),
('Discapacidad S',1),
('Discapacidad T',1);

/**Completo**/
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


/**Completado**/
INSERT INTO `Medicamentos` (`idPresentacion`,`nombre`,`ingredienteActivo`,`activo`)
VALUE
(1,'Adderal','Salbutamol',1),
(1,'Dexedrina','Azitromicina',1),
(2,'Focalin','Mitazapina',1),
(4,'Medicamentos C','Ingrediente Activo A',1),
(1,'Medicamentos D','Ingrediente Activo B',1),
(2,'Medicamentos F','Ingrediente Activo C',1),
(3,'Medicamentos G','Ingrediente Activo D',1),
(2,'Medicamentos H','Ingrediente Activo E',1),
(1,'Medicamentos I','Ingrediente Activo F',1),
(6,'Medicamentos J','Ingrediente Activo G',1),
(8,'Medicamentos K','Ingrediente Activo H',1),
(9,'Medicamentos L','Ingrediente Activo I',1),
(12,'Medicamentos M','Ingrediente Activo J',1),
(15,'Medicamentos N','Ingrediente Activo K',1),
(18,'Medicamentos O','Ingrediente Activo L',1),
(12,'Medicamentos P','Ingrediente Activo M',1),
(19,'Medicamentos Q','Ingrediente Activo N',1),
(2,'Medicamentos R','Ingrediente Activo O',1),
(1,'Medicamentos S','Ingrediente Activo P',1),
(3,'Medicamentos T','Ingrediente Activo Q',1);

INSERT INTO `ProgramaAtencion` (`idCoordinaciones`,`nombre`,`fechaInicial`,`fechaFinal`,`objetivo`,`activo`)
VALUE
(3,'vamos mexico','2020-02-04','2020-08-06',
'Nam voluptate maxime asperiores optio occaecati amet sequi ut. Fugiat quae quas maxime enim quas ut. Necessitatibus molestiae pariatur ratione expedita sit qui. Mollitia qui est dolorem dicta impedit.
Consequatur amet in rem et molestiae molestiae pariatur totam. Distinctio cum magnam nisi rem mollitia eius. Et vero aut ducimus ex ea cumque consequuntur mollitia. Cupiditate sit veniam omnis vel et voluptatem. Perferendis voluptas tempora molestiae alias ipsum ipsa. Quia et aperiam provident et.
Aperiam voluptatibus illum id sunt. Sint nulla alias modi minima tempore quae voluptas aut magni. Qui repellendus similique. Facere aperiam magni molestiae. Aut sint ea eos sed et. Aspernatur eaque quis quo consequatur voluptate adipisci officia iusto minima.'
,1),
(1,'Ya basta','2020-04-09','2020-08-09','Nobis et adipisci rerum aspernatur accusamus cupiditate deserunt eum est. Expedita voluptatem enim laudantium eligendi et error. Aliquid ut sit voluptates consectetur eos beatae. Reiciendis veritatis repudiandae voluptatem nihil nesciunt provident eaque. Id tempore qui quia rem. A doloremque aliquam dolor sint aut aut praesentium voluptatem autem.',1),
(2,'quer unix','2019-05-19','2022-03-11','Tempora sed accusamus possimus eos reiciendis soluta. Nam perspiciatis nostrum dignissimos velit pariatur est. Consequatur blanditiis corrupti sit aut cumque non est. Facere ut hic consectetur qui qui fugit veritatis aut. Omnis ratione inventore similique vero. Enim et eum ut aut nemo illum sunt et sint.
 
Qui et voluptatem animi. Nam a ex rerum tenetur illum ut itaque voluptatem qui. Et sapiente itaque blanditiis tempora aut.
 
Facilis non doloribus rerum. Sed dignissimos libero temporibus laudantium nesciunt asperiores veniam nam. Non omnis numquam odit dolores ut delectus ut magni recusandae. Maiores ducimus voluptatem harum quidem consectetur numquam eaque dolores saepe. Unde esse velit sint velit ut sint quo.',1),
(4,'el poder nuestro es','2019-12-08','2020-10-11','Aut mollitia modi omnis sed. Saepe consectetur et sed voluptatum. Sint magni provident voluptatem enim consequatur enim officia sit. Cum nihil itaque rem eveniet commodi ducimus.',1),
(1,'Cuau contra analfabetismo','2019-12-11','2023-12-11','Repudiandae aut aspernatur.
Cupiditate dolorum omnis delectus a est fuga placeat illo sunt.',1),
(2,'Juntos','2019-11-17','2022-11-11','Temporibus dignissimos natus est quae. Dolorem laudantium iste quibusdam labore alias corporis deleniti vitae. Perspiciatis id alias enim rerum est.',1),
(3,'Luchemos','2019-08-13','2023-5-11','nihil vero voluptatem',1),
(2,'SEGOB por la salud','2019-10-08','2021-06-11','laboriosam velit ad',1),
(1,'Salud Mental para todos','2019-06-22','2020-08-11','Quaerat cupiditate non praesentium hic ut est incidunt porro.',1),
(6,'Uno para todos','2019-08-10','2022-09-11','Placeat aut eaque. In beatae aliquam molestiae nulla. Ut natus voluptas quo ducimus. Doloribus numquam laborum dolor ad provident tempore rerum unde. Sit soluta et.',1),
(8,'Mexico sano','2020-02-21','2022-12-11','Qui totam facere quos doloribus.',1),
(9,'Tardes de lectura ','2019-09-18','2020-11-11','Laborum iste placeat quia ut odio fugit dicta.
Facilis perspiciatis quia.',1),
(12,'Ejemplo','2020-02-25','2021-1-11','expedita blanditiis perspiciatis',1),
(15,'Ejemplo 2','2019-09-11','2022-3-11','quae-nihil-distinctio',1),
(18,'Ejemplo 3','2018-04-13','2020-7-11','Ea in distinctio quia omnis ad. Sint magni amet aliquam. Doloremque tempore culpa adipisci aut et non reprehenderit molestiae distinctio.',1),
(12,'Ejemplo 4','2017-05-15','2019-8-11','Excepturi quae et tenetur ex eos. Qui accusantium ea. Sequi mollitia dolor eaque et cupiditate vitae autem et enim.',1),
(19,'Ejemplo 7','2015-11-1','2017-9-11','Vel provident exercitationem sed qui dolorem molestias pariatur. Quis aut quis et eius ratione. In necessitatibus maxime ea ullam aliquam dolores unde ipsa.
 
Delectus eveniet recusandae error tempora nihil beatae minus non. Saepe debitis cum. Doloribus dolor voluptatibus. Quis omnis ipsa laborum dolorum aspernatur explicabo. Et provident et ut architecto rerum tempora ut tempore.
 
Sunt ut quibusdam autem in cupiditate. Voluptate labore quas temporibus voluptatibus repudiandae vel tenetur. Dicta qui cupiditate omnis impedit in excepturi. Inventore dolores est est et quo quia reprehenderit excepturi laudantium.',1),
(2,'Ejemplo 8','2014-10-2','2015-6-11','Harum et nihil. Voluptas et et veniam ea. Eius ea laudantium illum et earum.',1),
(1,'Ejemplo 9','2010-10-5','2011-12-11','Eos odit est quia dignissimos eum aliquid placeat.',1),
(3,'Ejemplo 10','2013-05-8','2013-9-11','quia',1);


/*
INSERT INTO `DocAnexos` (`idDeIngreso`,`Url`,`activo`)
VALUE
(1,'http://lorempixel.com/640/480/abstract',1),
(1,'https://s3.amazonaws.com/uifaces/faces/twitter/anatolinicolae/128.jpg',1),
(2,'http://lorempixel.com/640/480/sports',1),
(3,'http://lorempixel.com/640/480/people',1),
(5,'http://lorempixel.com/640/480/people',1),
(10,'http://lorempixel.com/640/480/animals',1),
(12,'http://lorempixel.com/640/480/animals',1),
(19,'http://lorempixel.com/640/480/nightlife',1),
(1,'http://lorempixel.com/640/480/transport',1),
(1,'http://lorempixel.com/640/480/food',1),
(1,'http://lorempixel.com/640/480/nature',1),
(2,'http://lorempixel.com/640/480/sports',1),
(10,'http://lorempixel.com/640/480/cats',1),
(11,'http://lorempixel.com/640/480/transport',1),
(1,'http://lorempixel.com/640/480/technics',1),
(17,'http://lorempixel.com/640/480/transport',1),
(18,'http://lorempixel.com/640/480/sports',1),
(5,'http://lorempixel.com/640/480/abstract',1),
(7,'http://lorempixel.com/640/480/business',1),
(9,'https://s3.amazonaws.com/uifaces/faces/twitter/bryan_topham/128.jpg',1);
*/
INSERT INTO`Receta`(`idDeIngreso`,`idMedicamento`,`fechaIni`,`fechaFin`,`descripcion`,`dosis`,`activo`)
VALUE
(1,2,'2019-3-15','2019-4-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(2,1,'2018-2-15','2018-3-25','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(3,3,'2017-1-15','2017-2-25','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(5,5,'2016-12-15','2016-12-17','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(7,10,'2015-08-15','2015-10-19','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(8,12,'2014-3-15','2014-4-20','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(10,19,'2012-4-15','2012-5-25','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(11,18,'2014-5-15','2014-7-10','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(13,11,'2015-6-15','2015-6-11','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(15,10,'2017-7-15','2017-7-16','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(5,9,'2018-8-15','2018-8-17','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(10,8,'2020-9-15','2020-9-18','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(19,7,'2020-10-15','2020-10-19','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(18,3,'2020-11-15','2020-11-20','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(17,2,'2020-12-15','2020-12-21','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(16,1,'2020-1-15','2020-1-22','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(15,6,'2020-2-15','2020-2-23','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(7,10,'2020-3-15','2020-3-24','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(14,11,'2020-4-15','2020-4-25','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(13,12,'2011-5-15','2011-5-26','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(11,15,'2018-6-15','2018-6-27','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(1,17,'2010-7-15','2010-7-28','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(3,19,'2015-8-15','2015-8-29','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(2,18,'2016-9-15','2016-9-30','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(4,12,'2017-1-15','2017-1-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(5,17,'2018-10-15','2018-10-29','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(6,3,'2019-11-15','2019-11-28','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(7,5,'2017-12-15','2017-12-27','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(1,7,'2015-1-15','2015-1-26','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(2,7,'2016-01-15','2016-01-25','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(3,8,'2014-3-15','2014-3-24','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(15,3,'2013-3-15','2013-3-23','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(17,9,'2012-3-15','2012-3-22','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(18,9,'2011-3-15','2011-3-20','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(19,10,'2010-5-15','2010-5-19','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(3,11,'2015-7-15','2015-9-18','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(4,19,'2001-8-15','2001-10-16','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(5,7,'2008-9-15','2008-11-17','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(6,9,'2007-10-15','2007-10-18','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(2,8,'2005-11-15','2005-11-19','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(3,2,'2006-12-15','2006-12-20','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(5,2,'2007-3-15','2007-3-21','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(7,2,'2008-2-15','2008-2-22','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(8,1,'2009-5-15','2009-7-23','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(9,3,'2010-7-15','2010-9-24','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(11,5,'2011-9-15','2011-7-25','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(10,6,'2012-7-15','2012-8-25','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(18,6,'2013-8-15','2013-9-25','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(14,8,'2015-6-15','2015-6-25','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(13,8,'2017-5-15','2017-5-25','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1);


/*
INSERT INTO`ProgramaAtencionFotos`(`idProgramaAtencion`,`idFotos`,`fecha`,`activo`)
VALUE
(1,2,'2019-3-15',1),
(2,1,'2018-2-15',1),
(3,3,'2017-1-15',1),
(5,5,'2016-12-15',1),
(7,10,'2015-08-15',1),
(8,12,'2014-3-15',1),
(10,19,'2012-4-15',1),
(11,18,'2014-5-15',1),
(13,11,'2015-6-15',1),
(15,10,'2017-7-15',1),
(5,9,'2018-8-15',1),
(10,8,'2020-9-15',1),
(19,7,'2020-10-15',1),
(18,3,'2020-11-15',1),
(17,2,'2020-12-15',1),
(16,1,'2020-1-15',1),
(15,6,'2020-2-15',1),
(7,10,'2020-3-15',1),
(14,11,'2020-4-15',1),
(13,12,'2011-5-15',1),
(11,15,'2018-6-15',1),
(1,17,'2010-7-15',1),
(3,19,'2015-8-15',1),
(2,18,'2016-9-15',1),
(4,12,'2017-1-15',1),
(5,17,'2018-10-15',1),
(6,3,'2019-11-15',1),
(7,5,'2017-12-15',1),
(1,7,'2015-1-15',1),
(2,7,'2016-01-15',1),
(3,8,'2014-3-15',1),
(15,20,'2013-3-15',1),
(17,9,'2012-3-15',1),
(18,9,'2011-3-15',1),
(19,10,'2010-5-15',1),
(3,11,'2015-7-15',1),
(5,19,'2001-8-15',1),
(7,7,'2008-9-15',1),
(5,9,'2007-10-15',1),
(2,8,'2005-11-15',1),
(3,2,'2006-12-15',1),
(5,2,'2007-3-15',1),
(7,2,'2008-2-15',1),
(8,1,'2009-5-15',1),
(9,3,'2010-7-15',1),
(11,5,'2011-9-15',1),
(10,6,'2012-7-15',1),
(18,6,'2013-8-15',1),
(14,8,'2015-6-15',1),
(13,8,'2017-5-15',1);
*/

INSERT INTO`ProgramaAtencionBeneficiaria`(`idDeIngreso`,`idProgramaAtencion`,`fechaRegistro`,`observaciones`,`motivo`,`activo`)
VALUE
(1,1,'2019-3-15 00:00:00','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(1,2,'2018-2-15  00:00:01','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(2,3,'2017-1-15  00:00:02','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(3,5,'2016-12-15  00:00:03','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(4,7,'2015-08-15  00:00:04','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(5,8,'2014-3-15  00:00:05','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(6,10,'2012-4-15  00:00:06','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(7,11,'2014-5-15  00:00:07','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(8,13,'2015-6-15  00:00:08','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(9,15,'2017-7-15  00:00:09','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(10,5,'2018-8-15  00:00:10','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(11,10,'2020-9-15 00:00:11','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(12,19,'2020-10-15 00:00:12','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(13,18,'2020-11-15 00:00:13','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(14,17,'2020-12-15 00:00:14','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(15,16,'2020-1-15 00:00:15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(16,15,'2020-2-15 00:00:16','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(17,7,'2020-3-15 00:00:17','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(18,14,'2020-4-15 00:00:18','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(19,13,'2011-5-15 00:00:19','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(19,11,'2018-6-15 00:00:20','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(1,1,'2010-7-15 00:00:21','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(2,3,'2015-8-15 00:00:22','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(3,2,'2016-9-15 00:00:23','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(4,4,'2017-1-15 00:00:24','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(5,5,'2018-10-15 00:00:25','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(6,6,'2019-11-15 00:00:26','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(7,7,'2017-12-15 00:00:27','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(8,1,'2015-1-15 00:00:28','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(9,2,'2016-01-15 00:00:29','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(5,3,'2014-3-15 00:00:30','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(11,15,'2013-3-15 00:00:31','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(12,17,'2012-3-15 00:00:32','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(13,18,'2011-3-15  00:00:33','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(14,19,'2010-5-15  00:00:34','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(15,20,'2015-7-15  00:00:35','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(16,19,'2001-8-15  00:00:36','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(17,20,'2008-9-15  00:00:37','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(18,20,'2007-10-15  00:00:38','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(19,2,'2005-11-15  00:00:39','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(8,3,'2006-12-15  00:00:40','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(1,5,'2007-3-15  00:00:41','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(2,7,'2008-2-15  00:00:42','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(3,8,'2009-5-15  00:00:43','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(4,9,'2010-7-15  00:00:44','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(5,11,'2011-9-15  00:00:45','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(6,10,'2012-7-15  00:00:46','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(7,18,'2013-8-15  00:00:47','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(8,14,'2015-6-15  00:00:48','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(9,13,'2017-5-15  00:00:49','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1);


INSERT INTO`DiscapacidadBeneficiaria`(`idDiscapacidad`,`idDeIngreso`,`fecha`,`Tratamiento`,`activo`)
VALUE
(1,2,'2019-3-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(2,1,'2018-2-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(3,3,'2017-1-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(5,5,'2016-12-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(7,10,'2015-08-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(8,12,'2014-3-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(10,19,'2012-4-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(11,18,'2014-5-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(13,11,'2015-6-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(15,10,'2017-7-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(5,9,'2018-8-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(10,8,'2020-9-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(19,7,'2020-10-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(18,3,'2020-11-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(17,2,'2020-12-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(16,1,'2020-1-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(15,6,'2020-2-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(7,10,'2020-3-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(14,11,'2020-4-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(13,12,'2011-5-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(11,15,'2018-6-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(1,17,'2010-7-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(3,19,'2015-8-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(2,18,'2016-9-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(4,12,'2017-1-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(5,17,'2018-10-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(6,3,'2019-11-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(7,5,'2017-12-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(1,7,'2015-1-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(2,7,'2016-01-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(3,8,'2014-3-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(15,20,'2013-3-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(17,9,'2012-3-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(18,9,'2011-3-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(19,10,'2010-5-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(20,11,'2015-7-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(20,19,'2001-8-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(20,7,'2008-9-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(20,9,'2007-10-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(2,8,'2005-11-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(3,2,'2006-12-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(5,2,'2007-3-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(7,2,'2008-2-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(8,1,'2009-5-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',0),
(9,3,'2010-7-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',0),
(11,5,'2011-9-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(10,6,'2012-7-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(18,6,'2013-8-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(14,8,'2015-6-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1),
(13,8,'2017-5-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.',1);
/*
INSERT INTO`Album`(`idFotos`,`idDeIngreso`,`Nombre`,`activo`)
VALUE
(1,2,'vel',1),
(2,1,'consequuntur sequi quae',1),
(3,3,'quaerat-ea-at',1),
(5,5,'quod',1),
(7,10,'tenetur voluptas quos',1),
(8,12,'ut-et-sit',1),
(10,19,'at deleniti at',1),
(11,18,'eos',1),
(13,11,'facere',1),
(15,10,'esse et qui',1),
(5,9,'atque aut et',1),
(10,8,'ea',1),
(19,7,'maiores-nisi-occaecati',1),
(18,3,'et',1),
(17,2,'sit ea quia',1),
(16,1,'soluta-qui-sit',1),
(15,6,'deserunt-dolor-accusamus',1),
(7,10,'et-est-omnis',1),
(14,11,'in',1),
(13,12,'quos',1),
(11,15,'veniam',1),
(1,17,'voluptas',1),
(3,19,'quibusdam eum enim',1),
(2,18,'fugit tempore magnam',1),
(4,12,'natus soluta sed',1),
(5,17,'sint-dolor-reprehenderit',1),
(6,3,'provident repellat fugit',1),
(7,5,'natus',1),
(1,7,'Odio optio nihil distinctio.',1),
(2,7,'et',1),
(3,8,'aut',1),
(15,3,'sequi',1),
(17,9,'ex',1),
(18,9,'cumque omnis enim',1),
(19,10,'quidem-alias-unde',1),
(1,11,'eos',1),
(2,19,'hic',1),
(3,7,'odit',1),
(4,9,'blanditiis',1),
(2,8,'quo impedit reprehenderit',1),
(3,2,'fuga-ex-quos',1),
(5,2,'soluta-ea-ad',1),
(7,2,'officiis',1),
(8,1,'eum',1),
(11,5,'totam non sint',1),
(10,6,'Inventore aliquid et dolores sed dicta.',1),
(18,6,'perspiciatis harum eos',1),
(14,8,'aperiam',1),
(13,8,'odit',1);
*/
INSERT INTO`Diagnostico`(`idDeIngreso`,`idEspecialidad`,`fecha`,`tratamiento`,`descripcion`,`activo`)
VALUE
(1,2,'2019-3-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(2,1,'2018-2-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(3,3,'2017-1-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(5,5,'2016-12-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(7,10,'2015-08-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(8,12,'2014-3-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(10,19,'2012-4-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(11,18,'2014-5-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(13,11,'2015-6-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(15,10,'2017-7-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(5,9,'2018-8-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(10,8,'2020-9-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(19,7,'2020-10-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(18,3,'2020-11-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(17,2,'2020-12-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(16,1,'2020-1-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(15,6,'2020-2-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(7,10,'2020-3-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(14,11,'2020-4-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(13,12,'2011-5-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(11,15,'2018-6-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(1,17,'2010-7-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(3,19,'2015-8-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(2,18,'2016-9-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(4,12,'2017-1-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(5,17,'2018-10-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(6,3,'2019-11-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(7,5,'2017-12-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(1,7,'2015-1-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(2,7,'2016-01-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(3,8,'2014-3-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(15,5,'2013-3-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(17,9,'2012-3-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(18,9,'2011-3-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(19,10,'2010-5-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(20,11,'2015-7-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(20,19,'2001-8-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(20,7,'2008-9-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(14,9,'2007-10-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(2,8,'2005-11-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(3,2,'2006-12-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(5,2,'2007-3-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(7,2,'2008-2-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(8,1,'2009-5-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(9,3,'2010-7-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(11,5,'2011-9-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(10,6,'2012-7-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(18,6,'2013-8-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(14,8,'2015-6-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1),
(13,8,'2017-5-15','Sit repellendus temporibus eos soluta qui eos nesciunt harum voluptas.','Non eum hic quae fugiat dolorem.',1);



INSERT INTO`Escolaridad`(`idDeIngreso`,`idEscuela`,`idGradoEscolar`,`nombreTutor`,`telefono`,`correoElectronico`,`activo`,`fechaInicio`,`fechaFin`)
VALUE
(1,2,7,'Lavinia Daugherty','973-747-1906','asd@outlook.com',1,'2017-5-15','2017-5-15'),
(2,1,2,'Minnie Abbott','214-159-4234','ragf@gmail.com',1,'2017-5-15','2017-5-15'),
(3,3,4,'Miss Catharine Mosciski','108-715-5260','agr@outlook.com',1,'2017-5-15','2017-5-15'),
(5,5,6,'Danial Okuneva','636-064-5430','sdfAF@outlook.com',1,'2017-5-15','2017-5-15'),
(7,10,4,'Quinten Muller','692-096-6683','feawf@gmail.com',1,'2017-5-15','2017-5-15'),
(8,12,2,'Cornell Cummerata','608-052-2200','afew@hotmail..com',1,'2017-5-15','2017-5-15'),
(10,19,6,'Jennyfer Graham','225-985-6902','afwef@outlook.com',1,'2017-5-15','2017-5-15'),
(11,18,4,'Halle Johnston','270-454-7040','dthyur@gmail.com',1,'2017-5-15','2017-5-15'),
(13,11,7,'Garret Zboncak','701-745-4612','krfyu@gmail.com',1,'2017-5-15','2017-5-15'),
(15,10,6,'Danyka Kuphal IV','886-381-7566','qfrf@gmail.com',1,'2017-5-15','2017-5-15'),
(5,9,4,'Una Mayert V','028-005-1612','rfg@outlook.com',1,'2017-5-15','2017-5-15'),
(10,8,2,'Lauren Schuppe','003-879-6372','dgstr@outlook.com',1,'2017-5-15','2017-5-15'),
(19,7,8,'Augustine Collier','743-683-6287','67tru@hotmail..com',1,'2017-5-15','2017-5-15'),
(18,3,3,'Zula Hyatt','183-139-8719','@gmail.com',1,'2017-5-15','2017-5-15'),
(17,2,4,'Clementina Thiel','327-619-0051','yuikjyfht@gmail.com',1,'2017-5-15','2017-5-15'),
(16,1,3,'Natalie Halvorson','246-925-7021','sgrfd@outlook.com',1,'2017-5-15','2017-5-15'),
(15,6,7,'Sophie Stiedemann','215-709-3600','ertgyh@outlook.com',1,'2017-5-15','2017-5-15'),
(7,10,6,'Miss Kaelyn Howell','919-983-2211','ytr@gmail.com',1,'2017-5-15','2017-5-15'),
(14,11,4,'Jalyn Deckow','648-141-1326','fse@hotmail..com',1,'2017-5-15','2017-5-15'),
(13,12,8,'Antonina Quitzon','436-383-1262','8iujh@outlook.com',1,'2017-5-15','2017-5-15'),
(11,15,2,'Vita Schneider','317-251-5577','esrdty@outlook.com',1,'2017-5-15','2017-5-15'),
(1,17,3,'Alexa Grant','650-763-3949','fdgrt@outlook.com',1,'2017-5-15','2017-5-15'),
(3,19,10,'Ms. Alphonso Larkin','239-320-0741','.lk,jm@gmail.com',1,'2017-5-15','2017-5-15'),
(2,18,6,'Sharon Zieme','633-353-3699','lkiujh@yahoo.com',1,'2017-5-15','2017-5-15'),
(4,12,4,'Al Ferry','264-458-5793','ghyj@yahoo.com',1,'2017-5-15','2017-5-15'),
(5,17,8,'Adan Ferry','927-892-6411','gfvdc@outlook.com',1,'2017-5-15','2017-5-15'),
(6,3,7,'Camden Champlin','899-218-9387','hbty@outlook.com',1,'2017-5-15','2017-5-15'),
(7,5,10,'Corbin OHara','939-176-4313','gfvc@gmail.com',1,'2017-5-15','2017-5-15'),
(1,7,3,'Alba Howe','525-506-7053','@outlook.com',1,'2017-5-15','2017-5-15'),
(2,7,8,'Niko','649-807-1964','@gmail.com',1,'2017-5-15','2017-5-15'),
(3,8,2,'Miss Gerard Tromp','758-505-6521','ouytc@hotmail..com',1,'2017-5-15','2017-5-15'),
(15,20,6,'Magnus Goldner','123-679-1380','xzc vb@gmail.com',1,'2017-5-15','2017-5-15'),
(17,9,4,'Friedrich Feeney','858-884-2143','bnmjhkloi@outlook.com',1,'2017-5-15','2017-5-15'),
(18,9,10,'Monte Lindgren','631-634-8444','po90@outlook.com',1,'2017-5-15','2017-5-15'),
(19,10,8,'Kevin','369-243-6989','dsfcgvh@outlook.com',1,'2017-5-15','2017-5-15'),
(20,11,10,'Royce Shanahan','002-205-3601','r6y7uj@hotmail..com',1,'2017-5-15','2017-5-15'),
(20,19,11,'Brandi Pfeffer','023-740-2226','56yt@yahoo.com',1,'2017-5-15','2017-5-15'),
(20,7,4,'Reagan Dickinson','187-352-6677','sa@outlook.com',1,'2017-5-15','2017-5-15'),
(20,9,7,'Laurence Doyle','890-081-5568','WVT@outlook.com',1,'2017-5-15','2017-5-15'),
(2,8,6,'Ms. Lyric Abbott','844-008-3145','4VB5@outlook.com',1,'2017-5-15','2017-5-15'),
(3,2,3,'Demond Tremblay PhD','167-049-5240','NVK6@hotmail..com',1,'2017-5-15','2017-5-15'),
(5,2,10,'Savanah West','305-979-0404','TB4E@outlook.com',1,'2017-5-15','2017-5-15'),
(7,2,2,'Ashly Zboncak III','267-445-3927','BHY6@outlook.com',1,'2017-5-15','2017-5-15'),
(8,1,4,'Ransom Osinski','097-672-2868','CBDX@gmail.com',1,'2017-5-15','2017-5-15'),
(9,3,3,'Leo Rolfson Sr.','972-206-3006','AHTRE5@outlook.com',1,'2017-5-15','2017-5-15'),
(11,5,2,'Violette Hartmann','271-759-2283','B3YT@outlook.com',1,'2017-5-15','2017-5-15'),
(10,6,8,'Matteo Goodwin','802-556-5085','VQER@gmail.com',1,'2017-5-15','2017-5-15'),
(18,6,6,'Dovie Pagac','047-879-5405','ZTHRS@outlook.com',1,'2017-5-15','2017-5-15'),
(14,8,7,'Mr. Robbie Robel','009-244-1415','HTGJ5@yahoo.com',1,'2017-5-15','2017-5-15'),
(13,8,4,'Ola Hintz','286-199-5458','DSDE@gmail.com',1,'2017-5-15','2017-5-15');



INSERT INTO`BeneficiariaCanalizador`(`idDeIngreso`,`IdCanalizador`,`activo`)
VALUE
(1,2,1),
(2,1,1),
(3,3,1),
(5,5,1),
(7,10,1),
(8,12,1),
(10,19,1),
(11,18,1),
(13,11,1),
(15,10,1),
(5,9,1),
(10,8,1),
(19,7,1),
(18,3,1),
(17,2,1),
(16,1,1),
(15,6,1),
(7,10,1),
(14,11,1),
(13,12,1),
(11,15,1),
(1,17,1),
(3,19,1),
(2,18,1),
(4,12,1),
(5,17,1),
(6,3,1),
(7,5,1),
(1,7,1),
(2,7,1),
(3,8,1),
(15,20,1),
(17,9,1),
(18,9,1),
(19,10,1),
(20,11,1),
(20,1,1),
(20,7,1),
(20,9,1),
(2,8,1),
(3,2,1),
(5,2,1),
(7,2,1),
(8,1,1),
(11,5,1),
(10,6,1),
(18,6,1),
(14,8,1),
(13,8,1);
/*
INSERT INTO`Usuario`(`Usuario`,`password`, `nombre`,`activo`)
VALUE
('administrador','administrador','Jesus Mendivil',1),
('director','director','juan perez',1),
('medico','medico','Emilio acosta',1),
('psicologo','psicologo','Raul Galaviz',1);
*/
INSERT INTO `Rol`(`nombre`,`descripcion`,`activo`)
VALUE
('Administrador','Es el encargado en administrar el acceso al sistema de SIDNEEDED, es decir administra los usuarios, roles y privilegios del sistema.',1),
('Consultor del sistema','Es la persona que tiene acceso a la información de todas las beneficiarias, pero no puede modificar.',1),
('Consultor de beneficiarias','Es la persona que tiene acceso a la información de todas las beneficiarias, pero no puede modificar.',1),
('Medico','Es la persona que tiene acceso a la información de todas las beneficiarias, pero puede modificar los datos médicos de la beneficiaria.',1),
('Psicologo','Es la persona que tiene acceso a la información de todas las beneficiarias, pero puede modificar los datos médicos y educativos de la beneficiaria.',1);
INSERT INTO `Privilegios`(`nombre`,`descripcion`,`activo`)
VALUE
/*1*/
('Consultar usuarios del sistema',' Permite ver los usuarios del sistema.',1),
('Consultar usuario del sistema',' Permite ver los datos de un usuario del sistema.',1),
('Crear usuario',' Permite crear un nuevo usuario en el sistema.',1),
('Modificar usuario',' Permite modificar los datos de un usuario del sistema.',1),
('Eliminar usuario',' Permite dar de baja un usuario del sistema.',1),
/*6*/
('Consultar roles de usuario del sistema',' Permite ver los roles que tienen los usuarios del sistema.',1),
('Eliminar rol de usuario',' Permite quitarle un rol a un usuario del sistema.',1),
('Cambiar rol de usuario',' Permite cambiar un rol a un usuario del sistema.',1),
('Asignar rol a usuario',' Permite asignar un role a un usuario del sistema.',1),
/*10*/
('Consultar roles',' Permite ver los roles del sistema',1),
('Eliminar rol',' Permite eliminar un rol del sistema',1),
('Crear rol',' Permite crear un rol en el sistema.',1),
('Modificar rol',' Permite modificar los datos de un rol del sistema.',1),
/*14*/
('Consultar privilegios de los roles',' Permite ver los privilegios que los roles tienen asignado.',1),
('Asignar privilegios de un rol',' Permita asignar privilegios a un rol',1),
('Eliminar privilegios de un rol',' Permite quitarle privilegios a un rol.',1),
('Modificar privilegios de un rol',' Permite modificar los privilegios que tiene un rol.',1),
/*18*/
('Consultar privilegios',' Permite ver los privilegios que existen actualmente',1),

/*19*/
('Consulta de beneficiarias',' Permite ver las beneficiarias que están registradas en la institución.',1),
('Consultar beneficiaria', 'Permite ver los datos generales de una beneficiaria,',1),
('Elimnar beneficiaria',' Permite eliminar una beneficiaria del sistema.',1),
('Modificar beneficiaria',' Permite modificar los datos de una beneficiaria.',1),
('Registrar beneficiaria',' Permite dar de alta a una nueva beneficiasria',1),
/*24*/
('Consulta recetas',' Permite ver las recetas de una beneficiaria.',1),
('Crear receta',' Permite crear una receta a una beneficiaria.',1),
('Modificar receta',' Permite modificar los datos de una receta de una beneficiaria.',1),
('Eliminar receta',' Permite eliminar una receta de una beneficiaria',1),
/*28*/
('Consultar medicamentos',' Permite consultar los medicamentos registrados en la institucion.',1),
('Registrar medicamento',' Permite registrar un nuevo medicamento en la institucion.',1),
('Modificar medicamento',' Permite modificar los datos de un medicamento.',1),
('Eliminar medicamento',' Permite eliminar un medicamento.',1),
/*32*/
('Consultar directorio',' Permite consultar el directorio de la institucion.',1),
('Consultar un contacto en directorio',' Permite consultar los datos específicos de un contacto en el directorio.',1),
('Registrar un contacto en directorio',' Permite registrar un nuevo contacto en el directorio.',1),
('Modificar un contacto en directorio',' Permite modificar los datos de un contacto en el directorio',1),
('Eliminar un contacto en directorio',' Permite eliminar un contacto del directorio.',1),
/*37*/
('Consultar instituciones',' Permite ver las instituciones que han traído menores a la institucion.',1),
('Registrar institucion',' Permite registrar una nueva institucion.',1),
('Modificar institucion','Permite modificar los datos de una institución.',1),
('Eliminar institucion','Permite eliminar una institución del sistema.',1),
/*41*/
('Consulta escolaridades',' Permite consultar los estudios que tiene una beneficiaria.',1),
('Registrar escolaridad',' Permite registrar un estudio que tiene una beneficiaria.',1),
('Modificar escolaridad',' Permite modificar un estudio que tiene una beneficiaria.',1),
('Eliminar escolaridad',' Permite eliminar un estudio que tiene la beneficiaria.',1),
/*45*/
('Consultar escuelas',' Permite consultar las escuelas donde sea tenido las beneficiarias.',1),
('Consultar escuela', 'Permite consultar los datos de una escuela.',1),
('Registrar escuela',' Permite registrar una nueva escuela al sistema.',1),
('Modificar escuela',' Permite modificar los datos de una esucela.',1),
('Eliminar escuela',' Permite eliminar una escuela del sistema.',1),
/*50*/
('Consultar planes educativos',' Permite consultar los planes educativos que han tenido las beneficiarias.',1),
('Registrar plan educativo',' Permite registrar un nuevo plan educativo.',1),
('Modificar plan educativo',' Permite cambiar los datos de un plan educativo.',1),
('Eliminar plan educativo',' Permite eliminar un plan educativo',1),
/*54*/
('Consultar diagnóstico',' Permite ver los diagnósticos que ha tenido una beneficiaria.',1),
('Registrar diagnóstico',' Permite registrar un nuevo diagnostico a una beneficiaria.',1),
('Modificar diagnóstico',' Permite modificar un diagnóstico de una beneficiaria',1),
('Eliminar diagnóstico', 'Permite eliminar un diagnóstico de una beneficiaria.',1),
/*58*/
('Consultar áreas',' Permite consultar las áreas que tiene la institucion.',1),
('Registrar área',' Permite registrar una nueva área.',1),
('Modificar área',' Permite modificar los datos de un área',1),
('Eliminar área',' Permite eliminar un área del sistema.',1),
/*62*/
('Consultar especialidades',' Permite ver las especialidades que están registradas en el sistema.',1),
('Registrar especialidad',' Permite registrar una nueva especialidad.',1),
('Eliminar especialidad',' Permite eliminar una especialidad.',1),
('Editar especialidad',' Permite editar los datos de una especialidad.',1),
/*66*/
('Consultar discapacidades',' Permite consultar las discapacidades que hay en el sistema',1),
('Registrar discapacidad',' Permite registrara una discapacidad.',1),
('Eliminar discapacidad',' Permite eliminar una discapacidad del sistema.',1),
('Editar discapacidad',' Permite editar los datos de una discapacidad.',1),
/*70*/
('Consultar discapacidades de beneficiaria',' Permite consultar las discapacidades que tiene una beneficiaria.',1),
('Registrar discapacidad a beneficiaria',' Permite registrar una nueva discapacidad a una beneficiaria.',1),
('Eliminar discapacidad de beneficiaria',' Permite eliminar una discapacidad de una beneficiaria.',1),
('Editar discapacidad de beneficiaria',' Permite editar los datos de la relación que tienen la discapacidad con la beneficiaria.',1),
/*74*/
('Consultar programas de atención',' Permite consultar los programas de atención que hay en el sistema.',1),
('Consultar programa de atención',' Permite consultar los datos de un programa de atención.',1),
('Registrar programa de atención',' Permite registrar un nuevo programa de atención.',1),
('Modificar programa de atención',' Permite modificar los datos de un programa de atención.',1),
('Eliminar programa de atención',' Permite eliminar un programa de atención del sistema.',1),
/*79*/
('Consultar programas de atención de beneficiaria',' Permite ver los programas de atención donde la beneficiaria está vinculada.',1),
('Registrar programa de atención a beneficiaria',' Permite dar de alta a una beneficiaria a un programa de atención.',1),
('Modificar vinculación de programa de atención con beneficiaria',' Permite modificar los datos de la vinculación de una beneficiaria con un programa de atención.',1),
('Eliminar programa de atención de beneficiaria',' Permite eliminar la vinculación de una beneficiaria a un programa de atención.',1);


INSERT INTO`RolPrivilegios`(`idRol`,`idPrivilegios`,`activo`)
VALUE


/*Administrador*/
  /*Inicio usuario*/
  (1,3,1),
  (1,4,1),
  (1,5,1),
  /*fin usuario*/
  /*Inicio usuario rol*/
  (1,7,1),
  (1,8,1),
  (1,9,1),
  /*fin usuario rol*/
  /*Inicio  rol*/
  (1,11,1),
  (1,12,1),
  (1,13,1),
  /*Fin rol*/
  /*Inicio rol privilegios*/
  (1,15,1),
  (1,16,1),
  (1,17,1),
  /*Fin rol privilegios*/
  /*Inicio  privilegios*/
  /*Fin  privilegios*/
/*Fin administrador*/


/*Administrador consultor*/
  /*Inicio usuario*/
  (2,1,1),
  (2,2,1),
  /*fin usuario*/
  /*Inicio usuario rol*/
  (2,6,1),
  /*fin usuario rol*/
  /*Inicio  rol*/
  (2,10,1),
  /*Fin rol*/
  /*Inicio rol privilegios*/
  (2,14,1),
  /*Fin rol privilegios*/
  /*Inicio  privilegios*/
  (2,18,1),
  /*Fin  privilegios*/
/*Fin administrador consultor*/


/*Consultor de beneficiarias*/
  /*Inicio Beneficiarias*/
  (3,19,1),
  (3,20,1),
  /*Fin beneficiaria*/
  /*Inicio receta*/
  (3,24,1),
  /*Fin receta*/  
  /*Inicio Medicamentos*/
  (3,28,1),
  /*Fin Medicamentos*/
  /*Inicio Directorio*/
  (3,32,1),
  (3,33,1),
  /*Fin Directorio*/
  /*Inicio instituciones*/
  (3,37,1),
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
  /*Fin diagnostico*/
  /*Inicio areas*/
  (3,58,1),
  /*Fin areas*/
  /*Inicio especialidades*/
  (3,62,1),
  /*Fin especialidades*/
  /*Inicio discpacidades*/
  (3,66,1),
  /*Fin discapacidades*/
  /*Inicio discpacidades de beneficiaria*/
  (3,70,1),
  /*Fin discapacidades de beneficiaria*/
   /*Inicio discpacidades de programas de atencion*/
  (3,74,1),
  (3,75,1),
  /*Fin discapacidades de progranas de atencion*/
  /*Inicio discpacidades de programas de atencion beneficiaria*/
  (3,79,1),
  /*Fin discapacidades de progranas de atencion beneficiaria*/
/*Fin director*/



/*Medico*/
  /*Inicio Beneficiarias*/
  (4,21,1),
  (4,22,1),
  (4,23,1),
  /*Fin beneficiaria*/
  /*Inicio receta*/
  (4,25,1),
  (4,26,1),
  (4,27,1),
  /*Fin receta*/  
  /*Inicio Medicamentos*/
  (4,29,1),
  (4,30,1),
  (4,31,1),
  /*Fin Medicamentos*/
  /*Inicio Directorio*/
  (4,34,1),
  (4,35,1),
  (4,36,1),
  /*Fin Directorio*/
  /*Inicio instituciones*/
  (4,38,1),
  (4,39,1),
  (4,40,1),
  /*Fin instituciones*/

  /*Inicio diagnostico*/
  (4,55,1),
  (4,56,1),
  (4,57,1),
  /*Fin diagnostico*/
  /*Inicio areas*/
  (4,59,1),
  (4,60,1),
  (4,61,1),
  /*Fin areas*/
  /*Inicio especialidades*/
  (4,63,1),
  (4,64,1),
  (4,65,1),
  /*Fin especialidades*/
  /*Inicio discpacidades*/
  (4,67,1),
  (4,68,1),
  (4,69,1),
  /*Fin discapacidades*/
  /*Inicio discpacidades de beneficiaria*/
  (4,71,1),
  (4,72,1),
  (4,73,1),
  /*Fin discapacidades de beneficiaria*/
   /*Inicio discpacidades de programas de atencion*/
  (4,76,1),
  (4,77,1),
  (4,78,1),
  /*Fin discapacidades de progranas de atencion*/
  /*Inicio discpacidades de programas de atencion beneficiaria*/
  (4,80,1),
  (4,81,1),
  (4,82,1),
  /*Fin discapacidades de progranas de atencion beneficiaria*/
/*Fin medico*/



/*Psicologo*/
  /*Inicio escolaridad*/
  (5,42,1),
  (5,43,1),
  (5,44,1),
  /*Fin escolaridad*/
  /*Inicio escuela*/
  (5,47,1),
  (5,48,1),
  (5,49,1),
  /*Fin escuela*/
  /*Inicio plan educativo*/
  (5,51,1),
  (5,52,1),
  (5,53,1)
  /*Fin plan educativo*/
/*Fin Psicologo*/
  ;

SET FOREIGN_KEY_CHECKS=1;