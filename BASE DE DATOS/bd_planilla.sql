/*
 Navicat Premium Data Transfer

 Source Server         : mi conexion
 Source Server Type    : MySQL
 Source Server Version : 100315
 Source Host           : localhost:3306
 Source Schema         : bd_planilla

 Target Server Type    : MySQL
 Target Server Version : 100315
 File Encoding         : 65001

 Date: 28/06/2019 18:05:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for area_trabajo
-- ----------------------------
DROP TABLE IF EXISTS `area_trabajo`;
CREATE TABLE `area_trabajo`  (
  `area_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `area_descripcion` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `area_fecregistro` date NULL DEFAULT NULL,
  `area_estatus` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`area_codigo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of area_trabajo
-- ----------------------------
INSERT INTO `area_trabajo` VALUES (1, 'PRODUCCION', '2019-05-01', 'ACTIVO');
INSERT INTO `area_trabajo` VALUES (2, 'ADMINISTRATIVO', '2019-05-15', 'ACTIVO');
INSERT INTO `area_trabajo` VALUES (3, 'ALMACEN', '2019-05-15', 'ACTIVO');

-- ----------------------------
-- Table structure for cargo
-- ----------------------------
DROP TABLE IF EXISTS `cargo`;
CREATE TABLE `cargo`  (
  `cargo_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cargo_descripcion` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cargo_estatus` enum('ACTIVO','INACTIVO') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`cargo_codigo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cargo
-- ----------------------------
INSERT INTO `cargo` VALUES (1, 'JEFE DE ALMACEN', 'ACTIVO');
INSERT INTO `cargo` VALUES (2, 'ASISTENTE ADMINISTRATIVO', 'ACTIVO');
INSERT INTO `cargo` VALUES (3, 'OPERADOR', 'ACTIVO');

-- ----------------------------
-- Table structure for con_modalidad_pago
-- ----------------------------
DROP TABLE IF EXISTS `con_modalidad_pago`;
CREATE TABLE `con_modalidad_pago`  (
  `tipag_codigo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo autogenerado, identificador de la tabla Modalidad de pago',
  `tipag_descripcion` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Descripcion de la Tabla Modalidad de Pago',
  `tipag_estado` enum('Activo','Inactivo') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Estado de la Tabla Modalidad de pago',
  PRIMARY KEY (`tipag_codigo`) USING BTREE,
  UNIQUE INDEX `IU_descripcion`(`tipag_descripcion`) USING BTREE COMMENT 'Índice que permite  que no exista duplicidad en la descripción de la tabla.',
  UNIQUE INDEX `IX_codigo`(`tipag_codigo`) USING BTREE COMMENT 'Índice que indica que los datos se ordenaran a traves del codigo'
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'Tabla Modalidad de Pago, no se podra repetir la Descripcion de la tabla' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of con_modalidad_pago
-- ----------------------------
INSERT INTO `con_modalidad_pago` VALUES (1, 'Contado', 'Activo');
INSERT INTO `con_modalidad_pago` VALUES (2, 'Credito', 'Activo');

-- ----------------------------
-- Table structure for concepto_fijo
-- ----------------------------
DROP TABLE IF EXISTS `concepto_fijo`;
CREATE TABLE `concepto_fijo`  (
  `conceptofijo_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `conceptofijo_monto` decimal(10, 2) NULL DEFAULT NULL,
  `tipoconcepto_codigo` int(11) NULL DEFAULT NULL,
  `contrato_codigo` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`conceptofijo_codigo`) USING BTREE,
  INDEX `tipoconcepto_codigo`(`tipoconcepto_codigo`) USING BTREE,
  INDEX `contrato_codigo`(`contrato_codigo`) USING BTREE,
  CONSTRAINT `concepto_fijo_ibfk_1` FOREIGN KEY (`tipoconcepto_codigo`) REFERENCES `tipo_concepto` (`tipoconcepto_codigo`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `concepto_fijo_ibfk_2` FOREIGN KEY (`contrato_codigo`) REFERENCES `contrato` (`contrato_codigo`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of concepto_fijo
-- ----------------------------
INSERT INTO `concepto_fijo` VALUES (1, 500.00, 2, 1);
INSERT INTO `concepto_fijo` VALUES (3, 400.00, 1, 1);

-- ----------------------------
-- Table structure for concepto_variable
-- ----------------------------
DROP TABLE IF EXISTS `concepto_variable`;
CREATE TABLE `concepto_variable`  (
  `conceptova_id` int(11) NOT NULL AUTO_INCREMENT,
  `conceptova_descripcion` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `conceptova_monto` decimal(10, 2) NULL DEFAULT NULL,
  `pagoplanilla_codigo` int(11) NULL DEFAULT NULL,
  `tipoconcepto_codigo` int(11) NULL DEFAULT NULL,
  `conceptova_fecharegistro` timestamp(0) NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`conceptova_id`) USING BTREE,
  INDEX `tipoconcepto_codigo`(`tipoconcepto_codigo`) USING BTREE,
  INDEX `pagoplanilla_codigo`(`pagoplanilla_codigo`) USING BTREE,
  CONSTRAINT `concepto_variable_ibfk_1` FOREIGN KEY (`tipoconcepto_codigo`) REFERENCES `tipo_concepto` (`tipoconcepto_codigo`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `concepto_variable_ibfk_2` FOREIGN KEY (`pagoplanilla_codigo`) REFERENCES `pago_planilla` (`pagoplanilla_codigo`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for contrato
-- ----------------------------
DROP TABLE IF EXISTS `contrato`;
CREATE TABLE `contrato`  (
  `contrato_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `contrato_fecinicio` date NULL DEFAULT NULL,
  `contrato_fecterm` date NULL DEFAULT NULL,
  `trabajador_cod` int(11) NULL DEFAULT NULL,
  `contrato_terminos` varchar(350) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tipocon_codigo` int(11) NULL DEFAULT NULL,
  `contrato_estatus` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `contrato_sueldo` decimal(10, 2) NULL DEFAULT NULL,
  `seguro_id` int(11) NULL DEFAULT NULL,
  `area_codigo` int(11) NULL DEFAULT NULL,
  `cargo_codigo` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`contrato_codigo`) USING BTREE,
  INDEX `cargo_codigo`(`cargo_codigo`) USING BTREE,
  INDEX `area_codigo`(`area_codigo`) USING BTREE,
  INDEX `seguro_id`(`seguro_id`) USING BTREE,
  INDEX `trabajador_cod`(`trabajador_cod`) USING BTREE,
  INDEX `tipocon_codigo`(`tipocon_codigo`) USING BTREE,
  CONSTRAINT `contrato_ibfk_1` FOREIGN KEY (`cargo_codigo`) REFERENCES `cargo` (`cargo_codigo`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `contrato_ibfk_2` FOREIGN KEY (`area_codigo`) REFERENCES `area_trabajo` (`area_codigo`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `contrato_ibfk_3` FOREIGN KEY (`seguro_id`) REFERENCES `seguro` (`seguro_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `contrato_ibfk_4` FOREIGN KEY (`trabajador_cod`) REFERENCES `trabajador` (`trabajador_cod`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `contrato_ibfk_5` FOREIGN KEY (`tipocon_codigo`) REFERENCES `tipo_contrato` (`tipocon_codigo`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of contrato
-- ----------------------------
INSERT INTO `contrato` VALUES (1, '2019-06-20', '2019-08-20', 11, 'Termino 1.2', 1, 'Activo', 5000.00, 1, 2, 2);

-- ----------------------------
-- Table structure for derecho_habiente
-- ----------------------------
DROP TABLE IF EXISTS `derecho_habiente`;
CREATE TABLE `derecho_habiente`  (
  `derechohabiente_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `trabajador_cod` int(11) NULL DEFAULT NULL,
  `derechohabiente_fecregistro` date NULL DEFAULT NULL,
  `derechohabiente_estatus` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `familiar_codigo` int(11) NULL DEFAULT NULL,
  `derechohabiente_parentesco` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`derechohabiente_codigo`) USING BTREE,
  INDEX `familiar_codigo`(`familiar_codigo`) USING BTREE,
  INDEX `trabajador_cod`(`trabajador_cod`) USING BTREE,
  CONSTRAINT `derecho_habiente_ibfk_1` FOREIGN KEY (`familiar_codigo`) REFERENCES `familiar` (`familiar_codigo`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `derecho_habiente_ibfk_2` FOREIGN KEY (`trabajador_cod`) REFERENCES `trabajador` (`trabajador_cod`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of derecho_habiente
-- ----------------------------
INSERT INTO `derecho_habiente` VALUES (1, 11, '2019-06-28', 'ACTIVO', 4, 'Padre');
INSERT INTO `derecho_habiente` VALUES (2, 11, '2019-06-28', 'ACTIVO', 3, 'Primo');

-- ----------------------------
-- Table structure for documento_trabajador
-- ----------------------------
DROP TABLE IF EXISTS `documento_trabajador`;
CREATE TABLE `documento_trabajador`  (
  `documento_id` int(11) NOT NULL AUTO_INCREMENT,
  `trabajador_cod` int(11) NULL DEFAULT NULL,
  `tipo_documento` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `documento_descripcion` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`documento_id`) USING BTREE,
  INDEX `trabajador_codigo`(`trabajador_cod`) USING BTREE,
  CONSTRAINT `documento_trabajador_ibfk_1` FOREIGN KEY (`trabajador_cod`) REFERENCES `trabajador` (`trabajador_cod`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of documento_trabajador
-- ----------------------------
INSERT INTO `documento_trabajador` VALUES (1, 9, 'DNI', '73340318');
INSERT INTO `documento_trabajador` VALUES (2, 9, 'PASAPORTE', '73340317');
INSERT INTO `documento_trabajador` VALUES (3, 11, 'DNI', '32928409');
INSERT INTO `documento_trabajador` VALUES (4, 12, 'DNI', '32569852');
INSERT INTO `documento_trabajador` VALUES (5, 9, 'RUC', '10406536209');

-- ----------------------------
-- Table structure for familiar
-- ----------------------------
DROP TABLE IF EXISTS `familiar`;
CREATE TABLE `familiar`  (
  `familiar_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `familiar_nombre` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `familiar_apepat` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `familiar_apemat` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `familiar_nrodocumento` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `familiar_tipodocumento` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `familiar_fecnac` date NULL DEFAULT NULL,
  `familiar_estatus` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`familiar_codigo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of familiar
-- ----------------------------
INSERT INTO `familiar` VALUES (2, 'AYELEN MILENA', 'RAMOS', 'CABALLEROS', '76216924', 'DNI', '1994-06-19', 'ACTIVO');
INSERT INTO `familiar` VALUES (3, 'AINHOA NATZUMI', 'RODRIGUEZS', 'RAMOS', '12345678', 'DNI', '1994-03-01', 'ACTIVO');
INSERT INTO `familiar` VALUES (4, 'RONY', 'GUZMAN', 'GUZMAN', '74123655', 'DNI', '1995-06-21', 'ACTIVO');

-- ----------------------------
-- Table structure for medio_comunicacion
-- ----------------------------
DROP TABLE IF EXISTS `medio_comunicacion`;
CREATE TABLE `medio_comunicacion`  (
  `medioco_id` int(11) NOT NULL AUTO_INCREMENT,
  `medioco_descripcion` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `medioco_tipo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `trabajador_cod` int(11) NULL DEFAULT NULL,
  `medioco_estatus` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `medioco_nivel` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`medioco_id`) USING BTREE,
  INDEX `trabajador_cod`(`trabajador_cod`) USING BTREE,
  CONSTRAINT `medio_comunicacion_ibfk_1` FOREIGN KEY (`trabajador_cod`) REFERENCES `trabajador` (`trabajador_cod`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of medio_comunicacion
-- ----------------------------
INSERT INTO `medio_comunicacion` VALUES (1, 'lizethesl1980@gmail.com', 'Correo', 9, 'ACTIVO', 'P');
INSERT INTO `medio_comunicacion` VALUES (3, '982244930', 'Telefono', 9, 'ACTIVO', 'P');
INSERT INTO `medio_comunicacion` VALUES (4, 'lizethe3010@hotmail.com', 'Correo', 9, 'ACTIVO', 'S');
INSERT INTO `medio_comunicacion` VALUES (7, 'hdjdjd2@gmail.com', 'Correo', 25, 'ACTIVO', 'P');
INSERT INTO `medio_comunicacion` VALUES (8, '838383', 'Telefono', 25, 'ACTIVO', 'P');

-- ----------------------------
-- Table structure for modulo
-- ----------------------------
DROP TABLE IF EXISTS `modulo`;
CREATE TABLE `modulo`  (
  `modu_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) NULL DEFAULT NULL,
  `modu_nom` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `modu_icono` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `modu_url` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`modu_id`) USING BTREE,
  INDEX `fk_modu_rol_idx`(`rol_id`) USING BTREE,
  CONSTRAINT `fk_modu_rol` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for pago_planilla
-- ----------------------------
DROP TABLE IF EXISTS `pago_planilla`;
CREATE TABLE `pago_planilla`  (
  `pagoplanilla_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `planilla_codigo` int(11) NULL DEFAULT NULL,
  `pagoplanilla_sueldobruto` decimal(10, 2) NULL DEFAULT NULL,
  `pagoplanilla_sueldoneto` decimal(10, 2) NULL DEFAULT NULL,
  `pagoplanilla_estado` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pagoplanilla_codigo`) USING BTREE,
  INDEX `planilla_codigo`(`planilla_codigo`) USING BTREE,
  CONSTRAINT `pago_planilla_ibfk_1` FOREIGN KEY (`planilla_codigo`) REFERENCES `planilla` (`planilla_codigo`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pago_planilla
-- ----------------------------
INSERT INTO `pago_planilla` VALUES (1, 1, 4100.00, 4100.00, 'Activo');

-- ----------------------------
-- Table structure for permiso
-- ----------------------------
DROP TABLE IF EXISTS `permiso`;
CREATE TABLE `permiso`  (
  `permi_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `usu_codigo` int(11) NULL DEFAULT NULL,
  `permi_fechainicio` date NOT NULL,
  `permi_fechafinal` date NOT NULL,
  `permi_est` enum('Activo','Inactivo') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`permi_codigo`) USING BTREE,
  INDEX `fk_permi_usu_idx`(`usu_codigo`) USING BTREE,
  CONSTRAINT `fk_permi_usu` FOREIGN KEY (`usu_codigo`) REFERENCES `usuario` (`usu_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permiso
-- ----------------------------
INSERT INTO `permiso` VALUES (1, 1, '2018-05-31', '2108-11-01', 'Activo');
INSERT INTO `permiso` VALUES (2, 2, '2019-05-14', '2019-05-29', 'Activo');
INSERT INTO `permiso` VALUES (7, 8, '2019-04-01', '2020-06-01', 'Activo');
INSERT INTO `permiso` VALUES (8, 9, '2019-06-01', '2019-08-01', 'Activo');
INSERT INTO `permiso` VALUES (9, 10, '2019-06-01', '2019-06-20', 'Activo');
INSERT INTO `permiso` VALUES (10, 11, '2019-06-01', '2019-06-30', 'Activo');
INSERT INTO `permiso` VALUES (11, 12, '2019-06-01', '2019-06-30', 'Activo');
INSERT INTO `permiso` VALUES (12, 13, '2019-06-01', '2019-06-30', 'Activo');
INSERT INTO `permiso` VALUES (13, 14, '2019-06-03', '2019-06-29', 'Activo');
INSERT INTO `permiso` VALUES (14, 15, '2019-06-02', '2019-07-06', 'Activo');

-- ----------------------------
-- Table structure for planilla
-- ----------------------------
DROP TABLE IF EXISTS `planilla`;
CREATE TABLE `planilla`  (
  `planilla_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `planilla_mes` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `planilla_anio` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `contrato_codigo` int(11) NULL DEFAULT NULL,
  `planilla_estado` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`planilla_codigo`) USING BTREE,
  INDEX `contrato_codigo`(`contrato_codigo`) USING BTREE,
  CONSTRAINT `planilla_ibfk_1` FOREIGN KEY (`contrato_codigo`) REFERENCES `contrato` (`contrato_codigo`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of planilla
-- ----------------------------
INSERT INTO `planilla` VALUES (1, 'JUNIO', '2019', 1, NULL);

-- ----------------------------
-- Table structure for rol
-- ----------------------------
DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol`  (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_des` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `rol_freg` timestamp(0) NULL DEFAULT current_timestamp(0),
  `rol_est` enum('Activo','Inactivo') CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`rol_id`) USING BTREE,
  INDEX `xi_rol_des`(`rol_des`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rol
-- ----------------------------
INSERT INTO `rol` VALUES (1, 'ADMINISTRADOR', '2018-06-18 01:10:08', 'Activo');
INSERT INTO `rol` VALUES (2, 'TRABAJADOR', '2019-05-30 05:53:54', 'Activo');

-- ----------------------------
-- Table structure for seguro
-- ----------------------------
DROP TABLE IF EXISTS `seguro`;
CREATE TABLE `seguro`  (
  `seguro_id` int(11) NOT NULL AUTO_INCREMENT,
  `seguro_descripcion` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `seguro_estatus` enum('ACTIVO','INACTIVO') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`seguro_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of seguro
-- ----------------------------
INSERT INTO `seguro` VALUES (1, 'SIS', 'ACTIVO');
INSERT INTO `seguro` VALUES (2, 'ESSALUD', 'ACTIVO');

-- ----------------------------
-- Table structure for tipo_concepto
-- ----------------------------
DROP TABLE IF EXISTS `tipo_concepto`;
CREATE TABLE `tipo_concepto`  (
  `tipoconcepto_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tipoconcepto_nombre` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tipoconcepto_porcentaje` int(11) NULL DEFAULT NULL,
  `tipoconcepto_operacion` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`tipoconcepto_codigo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipo_concepto
-- ----------------------------
INSERT INTO `tipo_concepto` VALUES (1, 'AFP', 8, 'DESCUENTO');
INSERT INTO `tipo_concepto` VALUES (2, 'ONP', 10, 'DESCUENTO');

-- ----------------------------
-- Table structure for tipo_contrato
-- ----------------------------
DROP TABLE IF EXISTS `tipo_contrato`;
CREATE TABLE `tipo_contrato`  (
  `tipocon_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tipocon_descripcion` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tipocon_feccreacion` date NULL DEFAULT NULL,
  `tipocon_estatus` enum('ACTIVO','INACTIVO') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`tipocon_codigo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipo_contrato
-- ----------------------------
INSERT INTO `tipo_contrato` VALUES (1, 'TEMPORAL', '2019-06-21', 'INACTIVO');
INSERT INTO `tipo_contrato` VALUES (2, 'ANUAL', '2019-06-21', 'ACTIVO');

-- ----------------------------
-- Table structure for trabajador
-- ----------------------------
DROP TABLE IF EXISTS `trabajador`;
CREATE TABLE `trabajador`  (
  `trabajador_cod` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador de la persona',
  `trab_nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'Nombre de la persona',
  `trab_apellidopate` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'apellido paterno de la persona',
  `trab_apellidomate` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'apellido materno de la persona',
  `trab_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'email de la persona',
  `trab_sexo` enum('M','F') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'sexo de la persona Masculino \"M\", Feminino \"F\"',
  `trab_fechanacimiento` date NOT NULL COMMENT 'fecha de nacimiento de la persona',
  `trab_fecharegistro` timestamp(0) NOT NULL DEFAULT current_timestamp(0) COMMENT 'fecha del registro de la persona',
  `trab_estado` enum('Activo','Inactivo') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'estado de la persona',
  `trab_telefono` char(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`trabajador_cod`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci COMMENT = 'Entidad persona' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trabajador
-- ----------------------------
INSERT INTO `trabajador` VALUES (9, 'Lizethe', ' Sarmiento', ' Sarmiento', 'lizethesl1980@gmail.com', 'F', '1992-06-29', '2018-04-29 08:24:21', 'Activo', '982244930');
INSERT INTO `trabajador` VALUES (10, 'Heber', 'Gomez', 'Hurtado', 'heber.gomez@usanpedro.edu.pe', 'M', '1990-06-15', '2018-04-30 02:36:16', 'Activo', '');
INSERT INTO `trabajador` VALUES (11, 'Pedro', 'Nolasco', 'Vergaray', 'lert.07.ds04.95@gmail.com', 'M', '2020-05-30', '2019-05-30 19:20:17', 'Activo', NULL);
INSERT INTO `trabajador` VALUES (12, 'Pedro', 'Suarez', 'Verti', 'suares@gmail.com', 'M', '1989-05-30', '2019-05-30 20:27:55', 'Activo', NULL);
INSERT INTO `trabajador` VALUES (13, 'Juan', 'Garcia', 'Gonalez', 'lert.07.04.95@gmail.com', 'M', '2020-05-30', '2019-05-30 20:28:17', 'Activo', NULL);
INSERT INTO `trabajador` VALUES (14, 'Marta Gabi', 'De la Cruz', 'Sandobal', 'martita@gmail.com', 'F', '1989-05-30', '2019-05-30 20:28:42', 'Activo', NULL);
INSERT INTO `trabajador` VALUES (15, 'Daniela ', 'Vargas', ' Sarmiento', 'daniela_v_69@hotmail.com', 'F', '1990-02-13', '2019-06-06 19:24:44', 'Activo', NULL);
INSERT INTO `trabajador` VALUES (17, 'Jose ', 'Aoki', 'Paz', 'jaoki84@hotmail.com', 'M', '1988-05-13', '2019-06-06 19:26:01', 'Activo', NULL);
INSERT INTO `trabajador` VALUES (18, 'Johana', 'Cabello', 'Bazalar', 'jcableo@hotmail.com', 'F', '1980-04-07', '2019-06-06 19:26:01', 'Activo', NULL);
INSERT INTO `trabajador` VALUES (21, 'Nelson', 'Marillo', 'Nuñez', 'nelsongmn@gmail.com', 'M', '1985-01-05', '2019-06-06 19:33:15', 'Activo', NULL);
INSERT INTO `trabajador` VALUES (22, 'Richard', 'Marillo', 'Nuñez', 'richardpmn1983@gmail.com', 'M', '1992-08-12', '2019-06-06 19:34:24', 'Activo', NULL);
INSERT INTO `trabajador` VALUES (23, 'Jessibeth ', 'Salinas', 'Salinas', 'jessibeth81@gmail.com', 'F', '1990-04-21', '2019-06-06 19:34:24', 'Activo', NULL);
INSERT INTO `trabajador` VALUES (24, 'Jonathan', 'Vega ', 'Gabriel', 'jhomar19887@gmail.com', 'M', '1988-01-25', '2019-06-06 19:35:31', 'Activo', NULL);
INSERT INTO `trabajador` VALUES (25, 'jdjdj', 'jdjdjjd', 'jdjjd', 'hdjdjd2@gmail.com', 'F', '2019-06-20', '2019-06-20 06:22:17', 'Activo', '838383');
INSERT INTO `trabajador` VALUES (26, 'djdj', 'jdjj', 'jfj', '', 'F', '1966-06-26', '2019-06-26 20:46:41', 'Activo', NULL);

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `usu_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `usu_email` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `usu_clave` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `usu_estado` enum('Activo','Inactivo') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `intentos` int(11) NOT NULL,
  `fecha_ultimo_intento` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `trabajador_cod` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`usu_codigo`) USING BTREE,
  INDEX `ss`(`fecha_ultimo_intento`) USING BTREE,
  INDEX `trabajador_cod`(`trabajador_cod`) USING BTREE,
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`trabajador_cod`) REFERENCES `trabajador` (`trabajador_cod`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 'admin', 'sarmiento1', 'Activo', 0, '2019-02-15 16:45:33', 9);
INSERT INTO `usuario` VALUES (2, 'heber', '123456', 'Activo', 0, '2019-05-30 08:48:47', 10);
INSERT INTO `usuario` VALUES (8, 'Jgarcia', '123456', 'Activo', 0, '2019-06-04 19:19:25', 13);
INSERT INTO `usuario` VALUES (9, 'psuarez', 'nfyzotliyw', 'Activo', 0, '2019-06-04 19:24:29', 12);
INSERT INTO `usuario` VALUES (10, 'Dcruz', '123456', 'Activo', 0, '2019-06-05 01:54:58', 14);
INSERT INTO `usuario` VALUES (11, 'Pnolasco', 'P12345', 'Activo', 0, '2019-06-06 17:47:49', 11);
INSERT INTO `usuario` VALUES (12, 'jcabello', 'pghgzizfqy', 'Activo', 0, '2019-06-07 20:34:57', 18);
INSERT INTO `usuario` VALUES (13, 'jsalinas', 'salinas', 'Activo', 0, '2019-06-07 20:41:43', 23);
INSERT INTO `usuario` VALUES (14, 'rmarillo', '123456', 'Activo', 0, '2019-06-07 21:19:23', 22);
INSERT INTO `usuario` VALUES (15, 'dvargas', 'fricrqukhk', 'Activo', 0, '2019-06-07 22:44:48', 15);

-- ----------------------------
-- Table structure for usurol
-- ----------------------------
DROP TABLE IF EXISTS `usurol`;
CREATE TABLE `usurol`  (
  `usrol_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_id` int(11) NULL DEFAULT NULL,
  `rol_id` int(11) NULL DEFAULT NULL,
  `usrol_femod` timestamp(0) NULL DEFAULT current_timestamp(0),
  `usrol_est` enum('Activo','Inactivo') CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`usrol_id`) USING BTREE,
  INDEX `fk_usrol_usu_idx`(`usu_id`) USING BTREE,
  INDEX `fk_usrol_rol_idx`(`rol_id`) USING BTREE,
  CONSTRAINT `usurol_ibfk_1` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_codigo`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `usurol_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usurol
-- ----------------------------
INSERT INTO `usurol` VALUES (1, 1, 1, '2018-06-18 01:12:53', 'Activo');
INSERT INTO `usurol` VALUES (2, 2, 2, '2019-05-30 08:49:21', 'Activo');
INSERT INTO `usurol` VALUES (6, 8, 2, '2019-06-04 19:19:25', 'Activo');
INSERT INTO `usurol` VALUES (7, 9, 1, '2019-06-04 19:24:29', 'Activo');
INSERT INTO `usurol` VALUES (8, 10, 1, '2019-06-05 01:54:58', 'Activo');
INSERT INTO `usurol` VALUES (9, 11, 1, '2019-06-06 17:47:49', 'Activo');
INSERT INTO `usurol` VALUES (10, 12, 1, '2019-06-07 20:34:57', 'Activo');
INSERT INTO `usurol` VALUES (11, 13, 1, '2019-06-07 20:41:43', 'Activo');
INSERT INTO `usurol` VALUES (12, 14, 2, '2019-06-07 21:19:23', 'Activo');
INSERT INTO `usurol` VALUES (13, 15, 2, '2019-06-07 22:44:48', 'Activo');

-- ----------------------------
-- Procedure structure for con_actualizar_intentos
-- ----------------------------
DROP PROCEDURE IF EXISTS `con_actualizar_intentos`;
delimiter ;;
CREATE PROCEDURE `con_actualizar_intentos`(IN `usu` VARCHAR(30), IN `inte` INT)
UPDATE glb_usuario
set 
intentos =inte,
fecha_ultimo_intento= CURRENT_TIME
WHERE usu_email = usu;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for con_registrar_permisos
-- ----------------------------
DROP PROCEDURE IF EXISTS `con_registrar_permisos`;
delimiter ;;
CREATE PROCEDURE `con_registrar_permisos`(IN `inicio` VARCHAR(20), IN `final` VARCHAR(20))
insert into con_permiso (usu_codigo,permi_fechainicio,permi_fechafinal,permi_est) VALUES((select max(usu_codigo) from glb_usuario ),inicio,final,'Activo');
;;
delimiter ;

-- ----------------------------
-- Procedure structure for con_registrar_usuario
-- ----------------------------
DROP PROCEDURE IF EXISTS `con_registrar_usuario`;
delimiter ;;
CREATE PROCEDURE `con_registrar_usuario`(IN `cod_empleado` INT, IN `email` VARCHAR(30), IN `contrasenia` VARCHAR(30))
insert into glb_usuario (empl_codigo,usu_email,usu_clave,usu_estado,intentos,fecha_ultimo_intento) VALUES (cod_empleado,email,contrasenia,'Activo','0',CURRENT_TIME);
;;
delimiter ;

-- ----------------------------
-- Procedure structure for con_registrar_usurol
-- ----------------------------
DROP PROCEDURE IF EXISTS `con_registrar_usurol`;
delimiter ;;
CREATE PROCEDURE `con_registrar_usurol`(IN `rol` INT)
insert into con_usurol (usu_id,rol_id,usrol_femod,usrol_est) VALUES((select max(usu_codigo) from glb_usuario ),rol,CURRENT_TIME,'Activo');
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_ACTUALIZARCUENTA
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_ACTUALIZARCUENTA`;
delimiter ;;
CREATE PROCEDURE `PA_ACTUALIZARCUENTA`(IN `ID_USUARIO` INT, IN `CLAVE` VARCHAR(50))
BEGIN
UPDATE usuario SET
usu_clave = CLAVE
WHERE usu_codigo = ID_USUARIO;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_BUSCARADMINISTRADOR
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_BUSCARADMINISTRADOR`;
delimiter ;;
CREATE PROCEDURE `PA_BUSCARADMINISTRADOR`(IN `codigo` INT)
SELECT
trabajador.trab_nombre,
trabajador.trab_apellidopate,
trabajador.trab_apellidomate,
usuario.usu_codigo,
trabajador.trab_email,
usuario.usu_clave,
trabajador.trab_fechanacimiento,
trabajador.trab_sexo
FROM
usuario
INNER JOIN trabajador ON usuario.trabajador_cod = trabajador.trabajador_cod
where trabajador.trabajador_cod = codigo;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_BUSCARDOCUMENTOIDENTIDAD
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_BUSCARDOCUMENTOIDENTIDAD`;
delimiter ;;
CREATE PROCEDURE `PA_BUSCARDOCUMENTOIDENTIDAD`(IN `BUSCAR` VARCHAR(100))
SELECT * FROM documento_trabajador
 WHERE documento_trabajador.documento_descripcion LIKE BUSCAR;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_BUSCAREMAIL
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_BUSCAREMAIL`;
delimiter ;;
CREATE PROCEDURE `PA_BUSCAREMAIL`(IN `BUSCAR` VARCHAR(150))
select 
trabajador.trab_email,
usuario.usu_email,
usuario.usu_clave 
from usuario
INNER JOIN trabajador ON usuario.trabajador_cod = trabajador.trabajador_cod
 where trabajador.trab_email = BUSCAR;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_COMBOAREA
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_COMBOAREA`;
delimiter ;;
CREATE PROCEDURE `PA_COMBOAREA`()
SELECT area_codigo,area_descripcion,area_estatus FROM area_trabajo WHERE area_trabajo.area_estatus = 'ACTIVO';
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_COMBOCARGO
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_COMBOCARGO`;
delimiter ;;
CREATE PROCEDURE `PA_COMBOCARGO`()
SELECT
cargo.cargo_codigo,
cargo.cargo_descripcion
FROM
cargo;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_COMBOSEGURO
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_COMBOSEGURO`;
delimiter ;;
CREATE PROCEDURE `PA_COMBOSEGURO`()
SELECT
seguro.seguro_id,
seguro.seguro_descripcion
FROM
seguro;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_COMBOTIPOCONCEPTOFIJO
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_COMBOTIPOCONCEPTOFIJO`;
delimiter ;;
CREATE PROCEDURE `PA_COMBOTIPOCONCEPTOFIJO`()
SELECT
tipo_concepto.tipoconcepto_codigo,
tipo_concepto.tipoconcepto_nombre,
tipo_concepto.tipoconcepto_porcentaje,
tipo_concepto.tipoconcepto_operacion
FROM tipo_concepto
WHERE tipo_concepto.tipoconcepto_porcentaje != 0;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_COMBOTIPOCONCEPTOFIJOCONTRATO
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_COMBOTIPOCONCEPTOFIJOCONTRATO`;
delimiter ;;
CREATE PROCEDURE `PA_COMBOTIPOCONCEPTOFIJOCONTRATO`(IN `ID_CONTRATO` INT)
SELECT
tipo_concepto.tipoconcepto_codigo,
tipo_concepto.tipoconcepto_nombre,
tipo_concepto.tipoconcepto_porcentaje,
tipo_concepto.tipoconcepto_operacion
FROM tipo_concepto
WHERE tipo_concepto.tipoconcepto_porcentaje != 0 AND
tipo_concepto.tipoconcepto_codigo 
NOT IN (SELECT concepto_fijo.tipoconcepto_codigo FROM concepto_fijo  WHERE concepto_fijo.contrato_codigo=ID_CONTRATO);
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_COMBOTIPOCONCEPTOVARIABLE
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_COMBOTIPOCONCEPTOVARIABLE`;
delimiter ;;
CREATE PROCEDURE `PA_COMBOTIPOCONCEPTOVARIABLE`()
SELECT
tipo_concepto.tipoconcepto_codigo,
tipo_concepto.tipoconcepto_nombre,
tipo_concepto.tipoconcepto_porcentaje,
tipo_concepto.tipoconcepto_operacion
FROM
tipo_concepto
WHERE 
tipo_concepto.tipoconcepto_porcentaje = 0;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_COMBOTIPOCONTRATO
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_COMBOTIPOCONTRATO`;
delimiter ;;
CREATE PROCEDURE `PA_COMBOTIPOCONTRATO`()
SELECT
tipo_contrato.tipocon_codigo,
tipo_contrato.tipocon_descripcion
FROM
tipo_contrato;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_EDITARCONTRATO
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_EDITARCONTRATO`;
delimiter ;;
CREATE PROCEDURE `PA_EDITARCONTRATO`(IN `id_contrato` INT, IN `fecha_inicio` DATE, IN `fecha_final` DATE, IN `terminos` VARCHAR(350), IN `cbm_tipocont` INT, IN `cbm_area` INT, IN `cbm_seguro` INT, IN `cbm_cargo` INT, IN `cbm_estado` VARCHAR(15))
BEGIN
UPDATE contrato SET
contrato_fecinicio = fecha_inicio,
contrato_fecterm = fecha_final,
contrato_terminos = terminos,
tipocon_codigo = cbm_tipocont,
area_codigo = cbm_area,
seguro_id = cbm_seguro,
cargo_codigo = cargo_codigo,
contrato_estatus = cbm_estado
WHERE contrato_codigo = id_contrato;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_EDITARDATOSTRABAJADOR
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_EDITARDATOSTRABAJADOR`;
delimiter ;;
CREATE PROCEDURE `PA_EDITARDATOSTRABAJADOR`(IN `id_trabajador` INT, IN `txt_nombre` VARCHAR(350), IN `txt_apepat` VARCHAR(150), IN `txt_apemat` VARCHAR(150), IN `rad_sexo` CHAR(10), IN `txt_fechanacimi` DATE)
UPDATE trabajador SET
trab_nombre = txt_nombre,
trab_apellidopate = txt_apepat,
trab_apellidomate = txt_apemat,
trab_sexo = rad_sexo,
trab_fechanacimiento = txt_fechanacimi
WHERE trabajador_cod = id_trabajador;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_EDITARUSUARIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_EDITARUSUARIO`;
delimiter ;;
CREATE PROCEDURE `PA_EDITARUSUARIO`(IN `usuario` VARCHAR(30), IN `actual` VARCHAR(30), IN `nueva` VARCHAR(30))
BEGIN
UPDATE usuario u
SET
u.usu_clave = nueva
WHERE u.usu_email = usuario AND u.usu_clave = actual;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_ELIMINARCONCEPTOFIJO
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_ELIMINARCONCEPTOFIJO`;
delimiter ;;
CREATE PROCEDURE `PA_ELIMINARCONCEPTOFIJO`(IN `ID_CODIGO` INT)
DELETE FROM concepto_fijo WHERE concepto_fijo.conceptofijo_codigo = ID_CODIGO;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_ELIMINARCONCEPTOVARIABLE
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_ELIMINARCONCEPTOVARIABLE`;
delimiter ;;
CREATE PROCEDURE `PA_ELIMINARCONCEPTOVARIABLE`(IN `id_conceptovariable` INT)
DELETE FROM concepto_variable WHERE conceptova_id = id_conceptovariable;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_ELIMINARDOCUMENTOIDENTIDAD
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_ELIMINARDOCUMENTOIDENTIDAD`;
delimiter ;;
CREATE PROCEDURE `PA_ELIMINARDOCUMENTOIDENTIDAD`(IN `CODIGO` INT)
DELETE FROM documento_trabajador 
WHERE
documento_trabajador.documento_id = CODIGO;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_ELIMINARMEDIOCOMUNICACION
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_ELIMINARMEDIOCOMUNICACION`;
delimiter ;;
CREATE PROCEDURE `PA_ELIMINARMEDIOCOMUNICACION`(IN `CODIGO` INT)
DELETE FROM medio_comunicacion
WHERE medio_comunicacion.medioco_id = CODIGO;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_LISTARCONCEPTOSFIJOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_LISTARCONCEPTOSFIJOS`;
delimiter ;;
CREATE PROCEDURE `PA_LISTARCONCEPTOSFIJOS`(IN `ID_CONTRATO` INT)
SELECT
concepto_fijo.conceptofijo_codigo,
tipo_concepto.tipoconcepto_nombre,
tipo_concepto.tipoconcepto_porcentaje,
concepto_fijo.conceptofijo_monto,
concepto_fijo.contrato_codigo,
tipo_concepto.tipoconcepto_operacion,
contrato.contrato_estatus
FROM
concepto_fijo
INNER JOIN tipo_concepto ON concepto_fijo.tipoconcepto_codigo = tipo_concepto.tipoconcepto_codigo
INNER JOIN contrato ON concepto_fijo.contrato_codigo = contrato.contrato_codigo
WHERE concepto_fijo.contrato_codigo =ID_CONTRATO;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_LISTARCONCEPTOSVARIABLES
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_LISTARCONCEPTOSVARIABLES`;
delimiter ;;
CREATE PROCEDURE `PA_LISTARCONCEPTOSVARIABLES`(IN `id_pagoplanilla` INT)
SELECT
concepto_variable.conceptova_descripcion,
concepto_variable.conceptova_monto,
concepto_variable.conceptova_id,
concepto_variable.pagoplanilla_codigo,
concepto_variable.conceptova_fecharegistro,
tipo_concepto.tipoconcepto_nombre,
tipo_concepto.tipoconcepto_operacion,
tipo_concepto.tipoconcepto_codigo
FROM
concepto_variable
INNER JOIN tipo_concepto ON concepto_variable.tipoconcepto_codigo = tipo_concepto.tipoconcepto_codigo
WHERE concepto_variable.pagoplanilla_codigo = id_pagoplanilla;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_LISTARCONTRATOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_LISTARCONTRATOS`;
delimiter ;;
CREATE PROCEDURE `PA_LISTARCONTRATOS`(IN `INICIO` VARCHAR(30), IN `FINAL` VARCHAR(30))
BEGIN
DECLARE cantid INT;
SET @cantid :=0;
IF INICIO='' AND FINAL='' THEN
SELECT
@cantid:=@cantid+1 AS posicion,
CONCAT_WS(' ',
trabajador.trab_nombre,
trabajador.trab_apellidopate,
trabajador.trab_apellidomate) as trabajador,
contrato.contrato_codigo,
DATE_FORMAT(contrato.contrato_fecinicio,  '%d-%m-%Y' ) as contrato_fecinicio,
DATE_FORMAT(contrato.contrato_fecterm,  '%d-%m-%Y' ) as contrato_fecterm,
contrato.contrato_terminos,
contrato.contrato_estatus,
contrato.contrato_sueldo,
tipo_contrato.tipocon_descripcion,
cargo.cargo_descripcion,
area_trabajo.area_descripcion,
seguro.seguro_descripcion,
tipo_contrato.tipocon_codigo,
cargo.cargo_codigo,
area_trabajo.area_codigo,
seguro.seguro_id
FROM
contrato
INNER JOIN tipo_contrato ON contrato.tipocon_codigo = tipo_contrato.tipocon_codigo
INNER JOIN cargo ON contrato.cargo_codigo = cargo.cargo_codigo
INNER JOIN area_trabajo ON contrato.area_codigo = area_trabajo.area_codigo
INNER JOIN seguro ON contrato.seguro_id = seguro.seguro_id
INNER JOIN trabajador ON contrato.trabajador_cod = trabajador.trabajador_cod;
ELSE
SELECT
@cantid:=@cantid+1 AS posicion,
CONCAT_WS(' ',
trabajador.trab_nombre,
trabajador.trab_apellidopate,
trabajador.trab_apellidomate) as trabajador,
contrato.contrato_codigo,
DATE_FORMAT(contrato.contrato_fecinicio,  '%d-%m-%Y' ) as contrato_fecinicio,
DATE_FORMAT(contrato.contrato_fecterm,  '%d-%m-%Y' ) as contrato_fecterm,
contrato.contrato_terminos,
contrato.contrato_estatus,
contrato.contrato_sueldo,
tipo_contrato.tipocon_descripcion,
cargo.cargo_descripcion,
area_trabajo.area_descripcion,
seguro.seguro_descripcion,
tipo_contrato.tipocon_codigo,
cargo.cargo_codigo,
area_trabajo.area_codigo,
seguro.seguro_id
FROM
contrato
INNER JOIN tipo_contrato ON contrato.tipocon_codigo = tipo_contrato.tipocon_codigo
INNER JOIN cargo ON contrato.cargo_codigo = cargo.cargo_codigo
INNER JOIN area_trabajo ON contrato.area_codigo = area_trabajo.area_codigo
INNER JOIN seguro ON contrato.seguro_id = seguro.seguro_id
INNER JOIN trabajador ON contrato.trabajador_cod = trabajador.trabajador_cod
WHERE contrato.contrato_fecinicio BETWEEN INICIO AND FINAL;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_LISTARPLANILLACONTRATOS
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_LISTARPLANILLACONTRATOS`;
delimiter ;;
CREATE PROCEDURE `PA_LISTARPLANILLACONTRATOS`(IN `combo_anio` VARCHAR(20), IN `combo_mes` VARCHAR(20))
BEGIN
DECLARE cantid INT;
SET @cantid :=0;
SELECT 
@cantid:=@cantid+1 AS posicion,
CONCAT_WS(' ',
trabajador.trab_nombre,
trabajador.trab_apellidopate,
trabajador.trab_apellidomate) as trabajador,
DATE_FORMAT(contrato.contrato_fecinicio,  '%d-%m-%Y' ) as contrato_fecinicio,
DATE_FORMAT(contrato.contrato_fecterm,  '%d-%m-%Y' ) as contrato_fecterm,
cargo.cargo_descripcion,
contrato.contrato_sueldo,
planilla.planilla_mes,
planilla.planilla_anio,
pago_planilla.pagoplanilla_sueldobruto,
pago_planilla.pagoplanilla_sueldoneto,
pago_planilla.pagoplanilla_estado,
contrato.contrato_codigo,
planilla.planilla_codigo,
pago_planilla.pagoplanilla_codigo,
contrato.contrato_estatus
FROM
planilla
INNER JOIN contrato ON planilla.contrato_codigo = contrato.contrato_codigo
INNER JOIN trabajador ON contrato.trabajador_cod = trabajador.trabajador_cod
INNER JOIN cargo ON contrato.cargo_codigo = cargo.cargo_codigo
LEFT JOIN pago_planilla ON pago_planilla.planilla_codigo = planilla.planilla_codigo
WHERE planilla.planilla_anio = combo_anio AND planilla.planilla_mes LIKE  combo_mes;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_LISTARPLANILLACONTRATOSREGISTRO
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_LISTARPLANILLACONTRATOSREGISTRO`;
delimiter ;;
CREATE PROCEDURE `PA_LISTARPLANILLACONTRATOSREGISTRO`()
BEGIN
DECLARE cantid INT;
SET lc_time_names = 'es_PE';

SET @cantid :=0;
SELECT @cantid:=@cantid+1 AS posicion,t.contrato_codigo,t.contrato_fecinicio,
t.contrato_fecterm,
t.tipocon_codigo,
t.contrato_estatus,
t.contrato_sueldo,
t.cargo_descripcion,
t.trabajador,
t.sueldobruto
FROM (
SELECT
contrato.contrato_codigo,
contrato.contrato_fecinicio,
contrato.contrato_fecterm,
contrato.tipocon_codigo,
contrato.contrato_estatus,
contrato.contrato_sueldo,
cargo.cargo_descripcion,
CONCAT_WS(' ',
trabajador.trab_nombre,
trabajador.trab_apellidopate,
trabajador.trab_apellidomate) trabajador,
@price:=(contrato.contrato_sueldo+((SUM(Case tipo_concepto.tipoconcepto_operacion When 'Aumento' Then concepto_fijo.conceptofijo_monto Else 0 End))
-(SUM(Case tipo_concepto.tipoconcepto_operacion When 'Descuento' Then concepto_fijo.conceptofijo_monto Else 0 End)))) as sueldobruto
FROM
contrato
INNER JOIN trabajador ON contrato.trabajador_cod = trabajador.trabajador_cod
INNER JOIN cargo ON contrato.cargo_codigo = cargo.cargo_codigo
LEFT JOIN concepto_fijo ON concepto_fijo.contrato_codigo = contrato.contrato_codigo
LEFT JOIN tipo_concepto ON concepto_fijo.tipoconcepto_codigo = tipo_concepto.tipoconcepto_codigo
WHERE 
contrato.contrato_codigo
not in(SELECT planilla.contrato_codigo FROM planilla WHERE CONCAT(planilla.planilla_anio,'-',planilla.planilla_mes) = UPPER(Date_format(now(),'%Y-%M'))
)
UNION ALL 
SELECT
contrato.contrato_codigo,
contrato.contrato_fecinicio,
contrato.contrato_fecterm,
contrato.tipocon_codigo,
contrato.contrato_estatus,
contrato.contrato_sueldo,
cargo.cargo_descripcion,
CONCAT_WS(' ',
trabajador.trab_nombre,
trabajador.trab_apellidopate,
trabajador.trab_apellidomate) trabajador,
contrato.contrato_sueldo
FROM
contrato
INNER JOIN trabajador ON contrato.trabajador_cod = trabajador.trabajador_cod
INNER JOIN cargo ON contrato.cargo_codigo = cargo.cargo_codigo
WHERE 
contrato.contrato_codigo
not in(SELECT planilla.contrato_codigo FROM planilla WHERE CONCAT(planilla.planilla_anio,'-',planilla.planilla_mes) = UPPER(Date_format(now(),'%Y-%M')))
AND 
contrato.contrato_codigo
not in(SELECT concepto_fijo.contrato_codigo FROM concepto_fijo )
) AS t WHERE t.contrato_estatus="Activo";
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_LISTARTRABAJADOR
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_LISTARTRABAJADOR`;
delimiter ;;
CREATE PROCEDURE `PA_LISTARTRABAJADOR`(IN `BUSCAR` VARCHAR(350))
BEGIN
DECLARE cantid INT;
SET @cantid :=0;
SELECT
@cantid:=@cantid+1 AS posicion,
trabajador.trabajador_cod,
CONCAT_WS(' ',trabajador.trab_apellidopate,trabajador.trab_apellidomate,trabajador.trab_nombre) as empleado,
trabajador.trab_nombre,
trabajador.trab_apellidopate,
trabajador.trab_apellidomate,
IFNULL(trabajador.trab_email,'') AS trab_email,
trabajador.trab_sexo,
DATE_FORMAT(trabajador.trab_fechanacimiento, '%d-%m-%Y' ) as trab_fechanacimiento,
trabajador.trab_fecharegistro,
trabajador.trab_estado,
IFNULL(trabajador.trab_telefono,'') AS trab_telefono
FROM
trabajador
LEFT JOIN medio_comunicacion ON medio_comunicacion.trabajador_cod = trabajador.trabajador_cod
LEFT JOIN documento_trabajador ON documento_trabajador.trabajador_cod = trabajador.trabajador_cod

where CONCAT_WS(' ',trabajador.trab_apellidopate,trabajador.trab_apellidomate,trabajador.trab_nombre) like BUSCAR
 GROUP BY trabajador.trabajador_cod order by trabajador.trabajador_cod ASC;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_LISTARTRABAJADORES_SINUSUARIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_LISTARTRABAJADORES_SINUSUARIO`;
delimiter ;;
CREATE PROCEDURE `PA_LISTARTRABAJADORES_SINUSUARIO`(IN `BUSCAR` VARCHAR(100))
BEGIN
SELECT
trabajador.trabajador_cod,
trabajador.trab_nombre,
trabajador.trab_apellidopate,
trabajador.trab_apellidomate,
documento_trabajador.documento_descripcion,
documento_trabajador.tipo_documento,
trabajador.trab_fechanacimiento
FROM
trabajador
LEFT JOIN documento_trabajador ON documento_trabajador.trabajador_cod = trabajador.trabajador_cod
WHERE 
CONCAT_WS(' ',trabajador.trab_nombre,trabajador.trab_apellidopate,trabajador.trab_apellidomate,documento_trabajador.documento_descripcion)
 LIKE BUSCAR
AND trabajador.trabajador_cod not in (SELECT usuario.trabajador_cod FROM usuario)
GROUP BY trabajador.trabajador_cod;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_LISTARTRABAJADOR_DOCUMENTOIDENTIDAD
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_LISTARTRABAJADOR_DOCUMENTOIDENTIDAD`;
delimiter ;;
CREATE PROCEDURE `PA_LISTARTRABAJADOR_DOCUMENTOIDENTIDAD`(IN `BUSCAR` INT)
BEGIN
DECLARE cantid INT;
SET @cantid :=0;
SELECT
@cantid:=@cantid+1 AS posicion,
documento_trabajador.documento_id,
documento_trabajador.tipo_documento,
documento_trabajador.documento_descripcion,
documento_trabajador.trabajador_cod
FROM
documento_trabajador
WHERE 
documento_trabajador.trabajador_cod = BUSCAR
ORDER BY documento_trabajador.documento_id ASC;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_LISTARTRABAJADOR_MEDIOCOMUNICACION
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_LISTARTRABAJADOR_MEDIOCOMUNICACION`;
delimiter ;;
CREATE PROCEDURE `PA_LISTARTRABAJADOR_MEDIOCOMUNICACION`(IN `BUSCAR` INT)
BEGIN
DECLARE cantid INT;
SET @cantid :=0;
SELECT
@cantid:=@cantid+1 AS posicion,
medio_comunicacion.medioco_id,
medio_comunicacion.medioco_descripcion,
medio_comunicacion.medioco_tipo,
medio_comunicacion.trabajador_cod,
medio_comunicacion.medioco_estatus,
medio_comunicacion.medioco_nivel
FROM
medio_comunicacion
WHERE 
medio_comunicacion.trabajador_cod = BUSCAR
ORDER BY medio_comunicacion.medioco_id ASC;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_LISTARTRABAJADOR_SINCONTRATO
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_LISTARTRABAJADOR_SINCONTRATO`;
delimiter ;;
CREATE PROCEDURE `PA_LISTARTRABAJADOR_SINCONTRATO`(IN `BUSCAR` VARCHAR(350))
SELECT
trabajador.trabajador_cod,
CONCAT_WS(' ',trabajador.trab_apellidopate,trabajador.trab_apellidomate,trabajador.trab_nombre) as empleado,
trabajador.trab_nombre,
trabajador.trab_apellidopate,
trabajador.trab_apellidomate,
IFNULL(trabajador.trab_email,'') AS trab_email,
trabajador.trab_sexo,
DATE_FORMAT(trabajador.trab_fechanacimiento,  '%m/%d/%Y' ) as trab_fechanacimiento,
trabajador.trab_fecharegistro,
trabajador.trab_estado,
IFNULL(trabajador.trab_telefono,'') AS trab_telefono
FROM
trabajador
LEFT JOIN medio_comunicacion ON medio_comunicacion.trabajador_cod = trabajador.trabajador_cod
LEFT JOIN documento_trabajador ON documento_trabajador.trabajador_cod = trabajador.trabajador_cod
where CONCAT_WS(' ',trabajador.trab_apellidopate,trabajador.trab_apellidomate,trabajador.trab_nombre,documento_trabajador.documento_descripcion) like BUSCAR AND
trabajador.trabajador_cod NOT IN (SELECT contrato.trabajador_cod FROM contrato WHERE contrato.contrato_estatus = 'Activo')
 GROUP BY trabajador.trabajador_cod order by trabajador.trabajador_cod ASC;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_LISTARUSUARIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_LISTARUSUARIO`;
delimiter ;;
CREATE PROCEDURE `PA_LISTARUSUARIO`(IN `BUSCAR` VARCHAR(200))
BEGIN
DECLARE cantid INT;
SET @cantid :=0;
SELECT
@cantid:=@cantid+1 AS posicion,
usuario.usu_codigo,
usuario.usu_email,
'..............' as usu_clave,
CONCAT_WS(' ',trabajador.trab_apellidopate,trabajador.trab_apellidomate,trabajador.trab_nombre) as empleado,
rol.rol_des,
trabajador.trab_email
FROM
usuario
INNER JOIN permiso ON permiso.usu_codigo = usuario.usu_codigo
INNER JOIN usurol ON usurol.usu_id = usuario.usu_codigo
INNER JOIN rol ON usurol.rol_id = rol.rol_id
INNER JOIN trabajador ON usuario.trabajador_cod = trabajador.trabajador_cod
where CONCAT_WS(' ',trabajador.trab_apellidopate,trabajador.trab_apellidomate,trabajador.trab_nombre) like BUSCAR
order by usuario.usu_codigo ASC;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_REGISTRARCONCEPTOFIJO
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_REGISTRARCONCEPTOFIJO`;
delimiter ;;
CREATE PROCEDURE `PA_REGISTRARCONCEPTOFIJO`(IN `MONTO` DECIMAL(10,2), IN `ID_CONTRATO` INT, IN `ID_CONCEPTO` INT)
INSERT INTO  concepto_fijo (conceptofijo_monto,tipoconcepto_codigo,contrato_codigo) 
VALUES (MONTO,ID_CONCEPTO,ID_CONTRATO);
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_REGISTRARCONCEPTOVARIABLE
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_REGISTRARCONCEPTOVARIABLE`;
delimiter ;;
CREATE PROCEDURE `PA_REGISTRARCONCEPTOVARIABLE`(IN `id_pagoplanilla` INT, IN `id_tipoconcepto` INT, IN `txt_monto` DECIMAL(10,2), IN `text_argumento` VARCHAR(50))
BEGIN
DECLARE TIPO VARCHAR(50);
DECLARE MONTONETO DECIMAL(10,2);
SET @TIPO :=(SELECT tipo_concepto.tipoconcepto_operacion FROM tipo_concepto WHERE tipo_concepto.tipoconcepto_codigo LIKE id_tipoconcepto);
SET @MONTONETO :=(SELECT pago_planilla.pagoplanilla_sueldoneto FROM pago_planilla WHERE pago_planilla.pagoplanilla_codigo LIKE id_pagoplanilla);
IF @TIPO = "Descuento"  THEN
	IF (@MONTONETO/2)>=txt_monto  THEN
		INSERT INTO concepto_variable (conceptova_descripcion,conceptova_monto,pagoplanilla_codigo,tipoconcepto_codigo) 
		VALUES (text_argumento,txt_monto,id_pagoplanilla,id_tipoconcepto);
		SELECT 1;
	ELSE
		SELECT 2;
	END IF;
ELSE
	INSERT INTO concepto_variable (conceptova_descripcion,conceptova_monto,pagoplanilla_codigo,tipoconcepto_codigo) 
	VALUES (text_argumento,txt_monto,id_pagoplanilla,id_tipoconcepto);
	SELECT 1;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_REGISTRARCONTRATO
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_REGISTRARCONTRATO`;
delimiter ;;
CREATE PROCEDURE `PA_REGISTRARCONTRATO`(IN `fecha_inicio` DATE, IN `fecha_final` DATE, IN `terminos` VARCHAR(350), IN `cbm_tipocont` INT, IN `cbm_area` INT, IN `cbm_seguro` INT, IN `cbm_cargo` INT, IN `sueldo` DECIMAL(10,2), IN `id_trabajador` INT)
BEGIN
DECLARE id INT;
INSERT INTO contrato (contrato_fecinicio,contrato_fecterm,trabajador_cod,contrato_terminos,tipocon_codigo,contrato_estatus,contrato_sueldo,
seguro_id,area_codigo,cargo_codigo)
VALUES (fecha_inicio,fecha_final,id_trabajador,terminos,cbm_tipocont,'Activo',sueldo,cbm_seguro,cbm_area,cbm_cargo);
SET @id :=(SELECT contrato.contrato_codigo FROM contrato WHERE contrato.contrato_codigo = LAST_INSERT_ID());
SELECT @id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_REGISTRARDATOSTRABAJADOR
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_REGISTRARDATOSTRABAJADOR`;
delimiter ;;
CREATE PROCEDURE `PA_REGISTRARDATOSTRABAJADOR`(IN `txt_nombre` VARCHAR(350), IN `txt_apepat` VARCHAR(150), IN `txt_apemat` VARCHAR(150), IN `rad_sexo` CHAR(10), IN `txt_fechanacimi` DATE)
BEGIN
DECLARE id INT;
INSERT INTO trabajador (trab_nombre,trab_apellidopate,trab_apellidomate,trab_sexo,trab_fechanacimiento,trab_fecharegistro,trab_estado)
VALUES (txt_nombre,txt_apepat,txt_apemat,rad_sexo,txt_fechanacimi,CURRENT_TIMESTAMP,'Activo');
SET @id :=(SELECT trabajador.trabajador_cod FROM trabajador WHERE trabajador.trabajador_cod = LAST_INSERT_ID());
SELECT @id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_REGISTRARDOCUMENTOIDENTIDAD
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_REGISTRARDOCUMENTOIDENTIDAD`;
delimiter ;;
CREATE PROCEDURE `PA_REGISTRARDOCUMENTOIDENTIDAD`(IN `CODIGO` INT, IN `DNI` VARCHAR(350), IN `TIPO` VARCHAR(50))
BEGIN
DECLARE cantidad INT;
SET @cantidad :=(SELECT COUNT(*) FROM documento_trabajador WHERE documento_trabajador.documento_descripcion LIKE DNI);
IF @cantidad = 0  THEN
INSERT INTO documento_trabajador (trabajador_cod,tipo_documento,documento_descripcion)
VALUES(CODIGO,TIPO,DNI);
SELECT 1;
ELSE
SELECT 2;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_REGISTRARMEDIOCOMUNICACION
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_REGISTRARMEDIOCOMUNICACION`;
delimiter ;;
CREATE PROCEDURE `PA_REGISTRARMEDIOCOMUNICACION`(IN `CODIGO` INT, IN `MEDIO` VARCHAR(350), IN `TIPO` VARCHAR(50), IN `NIVEL` VARCHAR(50))
BEGIN
INSERT INTO medio_comunicacion(medioco_descripcion,medioco_tipo,trabajador_cod,medioco_estatus,medioco_nivel) 
VALUES(MEDIO,TIPO,CODIGO,'ACTIVO',NIVEL);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_REGISTRARPLANILLA
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_REGISTRARPLANILLA`;
delimiter ;;
CREATE PROCEDURE `PA_REGISTRARPLANILLA`(IN `id_contrato` INT, IN `txt_anio` VARCHAR(50), IN `txt_mes` VARCHAR(50))
BEGIN
DECLARE id INT;
INSERT INTO planilla(planilla_mes,planilla_anio,contrato_codigo) VALUES (txt_mes,txt_anio,id_contrato);
SET @id :=(SELECT planilla.planilla_codigo FROM planilla WHERE planilla.planilla_codigo = LAST_INSERT_ID());
SELECT @id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_REGISTRARPLANILLAPAGO
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_REGISTRARPLANILLAPAGO`;
delimiter ;;
CREATE PROCEDURE `PA_REGISTRARPLANILLAPAGO`(IN `planilla_id` INT, IN `sueldobase` VARCHAR(50), IN `sueldobruto` VARCHAR(50))
INSERT INTO pago_planilla(planilla_codigo,pagoplanilla_sueldobruto,pagoplanilla_sueldoneto,pagoplanilla_estado)
 VALUES (planilla_id,sueldobruto,sueldobruto,'Activo');
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_REGISTRARUSUARIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_REGISTRARUSUARIO`;
delimiter ;;
CREATE PROCEDURE `PA_REGISTRARUSUARIO`(IN `id_trabajador` INT, IN `usuario` VARCHAR(150), IN `clave` VARCHAR(100), IN `fechainicio` DATE, IN `fechafinal` DATE, IN `rol` INT)
BEGIN
DECLARE cantidad INT;
SET @cantidad :=(SELECT COUNT(*) FROM usuario WHERE usuario.usu_email LIKE usuario);
IF @cantidad = 0  THEN
INSERT INTO usuario (usu_email,usu_clave,usu_estado,intentos,fecha_ultimo_intento,trabajador_cod)
VALUES(usuario,clave,'Activo','0',CURRENT_TIMESTAMP,id_trabajador);
INSERT INTO permiso (usu_codigo,permi_fechainicio,permi_fechafinal,permi_est) 
VALUES ((SELECT MAX(usuario.usu_codigo) FROM usuario),fechainicio,fechafinal,'Activo');
INSERT INTO usurol (usu_id,rol_id,usrol_femod,usrol_est) VALUES ((SELECT MAX(usuario.usu_codigo) FROM usuario),rol,CURRENT_TIMESTAMP,'Activo');
SELECT 1;
ELSE
SELECT 2;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for PA_VERIFICARUSUARIO
-- ----------------------------
DROP PROCEDURE IF EXISTS `PA_VERIFICARUSUARIO`;
delimiter ;;
CREATE PROCEDURE `PA_VERIFICARUSUARIO`(IN `_usu` VARCHAR(30), IN `_pass` VARCHAR(30))
BEGIN
SELECT
usuario.usu_email,
usuario.usu_clave,
permiso.permi_codigo,
rol.rol_des,
trabajador.trab_nombre,
trabajador.trab_apellidopate,
trabajador.trab_apellidomate,
trabajador.trabajador_cod,
usuario.intentos,
permiso.permi_fechafinal,
trabajador.trabajador_cod
FROM
usuario
INNER JOIN permiso ON permiso.usu_codigo = usuario.usu_codigo
INNER JOIN usurol ON usurol.usu_id = usuario.usu_codigo
INNER JOIN rol ON usurol.rol_id = rol.rol_id
INNER JOIN trabajador ON usuario.trabajador_cod = trabajador.trabajador_cod
where usuario.usu_email=_usu and usuario.usu_clave=_pass;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_AREA_MODIFICAR
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_AREA_MODIFICAR`;
delimiter ;;
CREATE PROCEDURE `SP_AREA_MODIFICAR`(IN `IDAREA` INT, IN `AREA` VARCHAR(50), IN `ESTATUS` VARCHAR(10))
UPDATE area_trabajo SET  area_descripcion=AREA,area_estatus=ESTATUS
where area_codigo=IDAREA;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_AREA_REGISTRAR
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_AREA_REGISTRAR`;
delimiter ;;
CREATE PROCEDURE `SP_AREA_REGISTRAR`(IN `AREA` VARCHAR(50), IN `ESTATUS` VARCHAR(10))
BEGIN
DECLARE cantidad INT;
SET @cantidad :=(SELECT COUNT(*) FROM area_trabajo where area_descripcion like AREA);
IF @cantidad = 0  THEN
INSERT INTO area_trabajo(area_descripcion,area_fecregistro,area_estatus)
VALUES(AREA,CURDATE(),ESTATUS);
SELECT 1;
ELSE
SELECT 2;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_CARGO_LISTAR
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_CARGO_LISTAR`;
delimiter ;;
CREATE PROCEDURE `SP_CARGO_LISTAR`()
SELECT * FROM cargo;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_CARGO_MODIFICAR
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_CARGO_MODIFICAR`;
delimiter ;;
CREATE PROCEDURE `SP_CARGO_MODIFICAR`(IN `CODIGOCARGO` INT, IN `DESCRIPCION` VARCHAR(50), IN `ESTATUS` VARCHAR(10))
UPDATE cargo SET 
cargo_descripcion=DESCRIPCION,
cargo_estatus=ESTATUS
WHERE cargo_codigo=CODIGOCARGO;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_CARGO_REGISTRO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_CARGO_REGISTRO`;
delimiter ;;
CREATE PROCEDURE `SP_CARGO_REGISTRO`(IN `DESCRIPCION` VARCHAR(50), IN `ESTATUS` VARCHAR(30))
INSERT INTO cargo(cargo_descripcion,cargo_estatus) VALUES (DESCRIPCION,ESTATUS);
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_CARGO_SEGURO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_CARGO_SEGURO`;
delimiter ;;
CREATE PROCEDURE `SP_CARGO_SEGURO`(IN `DESCRIPCION` VARCHAR(50), IN `ESTATUS` VARCHAR(10))
INSERT INTO seguro(seguro_descripcion,seguro_estatus) values(DESCRIPCION,ESTATUS);
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_DERECHOHABIENTE_ELIMINAR
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_DERECHOHABIENTE_ELIMINAR`;
delimiter ;;
CREATE PROCEDURE `SP_DERECHOHABIENTE_ELIMINAR`(IN `IDDERECHO` INT)
DELETE FROM derecho_habiente WHERE derechohabiente_codigo=IDDERECHO;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_DERECHOHABIENTE_LISTAR
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_DERECHOHABIENTE_LISTAR`;
delimiter ;;
CREATE PROCEDURE `SP_DERECHOHABIENTE_LISTAR`()
SELECT
CONCAT_WS(' ',trabajador.trab_nombre,
trabajador.trab_apellidopate,
trabajador.trab_apellidomate) AS trabajador,
trabajador.trab_email,
trabajador.trab_sexo,
cargo.cargo_descripcion,
area_trabajo.area_descripcion,
contrato.trabajador_cod
FROM
contrato
INNER JOIN trabajador ON contrato.trabajador_cod = trabajador.trabajador_cod
INNER JOIN cargo ON contrato.cargo_codigo = cargo.cargo_codigo
INNER JOIN area_trabajo ON contrato.area_codigo = area_trabajo.area_codigo
WHERE
contrato.contrato_estatus = 'ACTIVO'
GROUP BY
contrato.trabajador_cod;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_DERECHOHABIENTE_REGISTRO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_DERECHOHABIENTE_REGISTRO`;
delimiter ;;
CREATE PROCEDURE `SP_DERECHOHABIENTE_REGISTRO`(IN `IDTRABAJADOR` INT, IN `IDFAMILIAR` INT, IN `PARENTESCO` VARCHAR(10))
BEGIN
DECLARE cantidad int;
SET @cantidad :=(select COUNT(*) from derecho_habiente where trabajador_cod=IDTRABAJADOR AND familiar_codigo=IDFAMILIAR);
IF @cantidad=0 THEN
	INSERT INTO derecho_habiente(trabajador_cod,derechohabiente_fecregistro,derechohabiente_estatus,familiar_codigo,derechohabiente_parentesco)
VALUES(IDTRABAJADOR,CURDATE(),'ACTIVO',IDFAMILIAR,PARENTESCO);
SELECT 1;
ELSE
	SELECT 2;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_FAMILIARASIGNADO_HOY
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_FAMILIARASIGNADO_HOY`;
delimiter ;;
CREATE PROCEDURE `SP_FAMILIARASIGNADO_HOY`(IN `IDTRABJADOR` INT)
SELECT
derecho_habiente.derechohabiente_codigo,
CONCAT_WS(' ',familiar.familiar_nombre,
familiar.familiar_apepat,
familiar.familiar_apemat) as FAMILIAR,
familiar.familiar_nrodocumento,
familiar.familiar_fecnac
FROM
derecho_habiente
INNER JOIN familiar ON derecho_habiente.familiar_codigo = familiar.familiar_codigo
where derecho_habiente.trabajador_cod=IDTRABJADOR;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_FAMILIAR_LISTAR
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_FAMILIAR_LISTAR`;
delimiter ;;
CREATE PROCEDURE `SP_FAMILIAR_LISTAR`(IN `BUSCAR` VARCHAR(100))
SELECT
familiar.familiar_codigo,
CONCAT_WS(' ',familiar.familiar_nombre,familiar.familiar_apepat,familiar.familiar_apemat) as FAMILIAR,
familiar.familiar_nombre,
familiar.familiar_apepat,
familiar.familiar_apemat,
familiar.familiar_nrodocumento,
familiar.familiar_tipodocumento,
familiar.familiar_fecnac,
familiar.familiar_estatus
FROM
familiar
where CONCAT_WS(' ',familiar.familiar_nombre,familiar.familiar_apepat,familiar.familiar_apemat) LIKE BUSCAR
OR familiar.familiar_nrodocumento LIKE BUSCAR;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_FAMILIAR_MODIFICAR
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_FAMILIAR_MODIFICAR`;
delimiter ;;
CREATE PROCEDURE `SP_FAMILIAR_MODIFICAR`(IN `IDFAMILIAR` INT, IN `NOMBRE` VARCHAR(50), IN `APEPAT` VARCHAR(50), IN `APEMAT` VARCHAR(50), IN `NRODOCUMENTO` VARCHAR(12), IN `TIPODOCUMENTO` VARCHAR(30), IN `FECHANACIMIENTO` DATE, IN `ESTATUS` VARCHAR(10))
update familiar set familiar_nombre=NOMBRE,familiar_apepat=APEPAT,familiar_apemat=APEMAT,
familiar_nrodocumento=NRODOCUMENTO,familiar_tipodocumento=TIPODOCUMENTO,familiar_fecnac=FECHANACIMIENTO,
familiar_estatus=ESTATUS
where familiar_codigo=IDFAMILIAR;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_FAMILIAR_REGISTRO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_FAMILIAR_REGISTRO`;
delimiter ;;
CREATE PROCEDURE `SP_FAMILIAR_REGISTRO`(IN `NOMBRE` VARCHAR(50), IN `APEPAT` VARCHAR(50), IN `APEMAT` VARCHAR(50), IN `NRODOCUMENTO` VARCHAR(12), IN `TIPODOCUMENTO` VARCHAR(30), IN `FECHANACIMIENTO` DATE, IN `ESTATUS` VARCHAR(10))
BEGIN
	DECLARE cantidad INT;
	SET @cantidad :=(select COUNT(*) from familiar where familiar_nrodocumento=NRODOCUMENTO);
	IF @cantidad = 0 THEN
	INSERT INTO familiar(familiar_nombre,familiar_apepat,familiar_apemat,familiar_nrodocumento,familiar_tipodocumento,familiar_fecnac,familiar_estatus) VALUES(NOMBRE,APEPAT,APEMAT,NRODOCUMENTO,TIPODOCUMENTO,FECHANACIMIENTO,ESTATUS);
	SELECT 1;
	ELSE
		SELECT 2;
	END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_LISTARAREA
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_LISTARAREA`;
delimiter ;;
CREATE PROCEDURE `SP_LISTARAREA`()
SELECT * FROM area_trabajo;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_SEGURO_LISTAR
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_SEGURO_LISTAR`;
delimiter ;;
CREATE PROCEDURE `SP_SEGURO_LISTAR`()
SELECT * FROM seguro;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_SEGURO_MODIFICAR
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_SEGURO_MODIFICAR`;
delimiter ;;
CREATE PROCEDURE `SP_SEGURO_MODIFICAR`(IN `IDSEGURO` INT, IN `SEGURO` VARCHAR(50), IN `ESTATUS` VARCHAR(10))
UPDATE seguro SET seguro_descripcion=SEGURO,seguro_estatus=ESTATUS
where seguro_id=IDSEGURO;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_TIPOCONTRATO_LISTAR
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_TIPOCONTRATO_LISTAR`;
delimiter ;;
CREATE PROCEDURE `SP_TIPOCONTRATO_LISTAR`()
SELECT * FROM tipo_contrato;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_TIPOCONTRATO_MODIFICAR
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_TIPOCONTRATO_MODIFICAR`;
delimiter ;;
CREATE PROCEDURE `SP_TIPOCONTRATO_MODIFICAR`(IN `IDTIPO` INT, IN `TIPOCONTRATO` VARCHAR(50), IN `ESTATUS` VARCHAR(10))
UPDATE tipo_contrato set tipocon_descripcion=TIPOCONTRATO,tipocon_estatus=ESTATUS
where tipocon_codigo=IDTIPO;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for SP_TIPOCONTRATO_REGISTRO
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_TIPOCONTRATO_REGISTRO`;
delimiter ;;
CREATE PROCEDURE `SP_TIPOCONTRATO_REGISTRO`(IN `TIPOCONTRATO` VARCHAR(50), IN `ESTATUS` VARCHAR(10))
BEGIN
DECLARE cantidad INT;
SET @cantidad :=(SELECT COUNT(*) FROM tipo_contrato where tipocon_descripcion like TIPOCONTRATO);
IF @cantidad = 0  THEN
INSERT INTO tipo_contrato(tipocon_descripcion,tipocon_feccreacion,tipocon_estatus)
VALUES(TIPOCONTRATO,CURDATE(),ESTATUS);
SELECT 1;
ELSE
SELECT 2;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table concepto_fijo
-- ----------------------------
DROP TRIGGER IF EXISTS `TRIG_ACTUALIZARPLANILLA_CONCEPTO_FIJO_REGISTRAR`;
delimiter ;;
CREATE TRIGGER `TRIG_ACTUALIZARPLANILLA_CONCEPTO_FIJO_REGISTRAR` AFTER INSERT ON `concepto_fijo` FOR EACH ROW BEGIN
DECLARE sueldoBruto decimal(10,2);
DECLARE sueldoNeto decimal(10,2);
DECLARE id_monto int;
DECLARE operacion varchar(20);
SET lc_time_names = 'es_PE';
set @sueldoBruto  := (SELECT pago_planilla.pagoplanilla_sueldobruto from pago_planilla 
INNER JOIN planilla ON pago_planilla.planilla_codigo = planilla.planilla_codigo WHERE planilla.contrato_codigo = new.contrato_codigo and pago_planilla.pagoplanilla_estado ='Activo' and CONCAT_WS('-',planilla.planilla_anio,planilla_mes) = Date_format(now(),'%Y-%M')); 

set @sueldoNeto  := (SELECT pago_planilla.pagoplanilla_sueldoneto from pago_planilla
INNER JOIN planilla ON pago_planilla.planilla_codigo = planilla.planilla_codigo WHERE planilla.contrato_codigo = new.contrato_codigo 
and pago_planilla.pagoplanilla_estado ='Activo' and CONCAT_WS('-',planilla.planilla_anio,planilla_mes) = Date_format(now(),'%Y-%M'));

set @operacion :=(SELECT tipo_concepto.tipoconcepto_operacion from tipo_concepto WHERE tipo_concepto.tipoconcepto_codigo = new.tipoconcepto_codigo);
set @id_monto :=(SELECT tipo_concepto.tipoconcepto_porcentaje from tipo_concepto WHERE tipo_concepto.tipoconcepto_codigo = new.tipoconcepto_codigo); 
IF (@operacion = 'Descuento') THEN
	UPDATE pago_planilla INNER JOIN planilla ON pago_planilla.planilla_codigo = planilla.planilla_codigo SET
     pago_planilla.pagoplanilla_sueldobruto =  @sueldoBruto-new.conceptofijo_monto,
    pago_planilla.pagoplanilla_sueldoneto =  @sueldoNeto -new.conceptofijo_monto
    WHERE planilla.contrato_codigo =new.contrato_codigo and pago_planilla.pagoplanilla_estado ='Activo' and CONCAT_WS('-',planilla.planilla_anio,planilla.planilla_mes) = Date_format(now(),'%Y-%M') ;
END IF;
IF (@operacion = 'Aumento') THEN
	UPDATE pago_planilla INNER JOIN planilla ON pago_planilla.planilla_codigo = planilla.planilla_codigo SET
     pago_planilla.pagoplanilla_sueldobruto = @sueldoBruto + new.conceptofijo_monto,
    pago_planilla.pagoplanilla_sueldoneto = @sueldoNeto + new.conceptofijo_monto
    WHERE planilla.contrato_codigo =new.contrato_codigo and pago_planilla.pagoplanilla_estado ='Activo' and CONCAT_WS('-',planilla.planilla_anio,planilla.planilla_mes) = Date_format(now(),'%Y-%M')  ;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table concepto_fijo
-- ----------------------------
DROP TRIGGER IF EXISTS `TRIG_ACTUALIZARPLANILLA_CONCEPTO_FIJO_ELIMINADO`;
delimiter ;;
CREATE TRIGGER `TRIG_ACTUALIZARPLANILLA_CONCEPTO_FIJO_ELIMINADO` AFTER DELETE ON `concepto_fijo` FOR EACH ROW BEGIN
DECLARE sueldoBruto decimal(10,2);
DECLARE sueldoNeto decimal(10,2);
DECLARE id_monto int;
DECLARE operacion varchar(20);
SET lc_time_names = 'es_PE';
set @sueldoBruto  := (SELECT pago_planilla.pagoplanilla_sueldobruto from pago_planilla 
INNER JOIN planilla ON pago_planilla.planilla_codigo = planilla.planilla_codigo WHERE planilla.contrato_codigo = old.contrato_codigo and pago_planilla.pagoplanilla_estado ='Activo' and CONCAT_WS('-',planilla.planilla_anio,planilla_mes) = Date_format(now(),'%Y-%M')); 

set @sueldoNeto  := (SELECT pago_planilla.pagoplanilla_sueldoneto from pago_planilla
INNER JOIN planilla ON pago_planilla.planilla_codigo = planilla.planilla_codigo WHERE planilla.contrato_codigo = old.contrato_codigo 
and pago_planilla.pagoplanilla_estado ='Activo' and CONCAT_WS('-',planilla.planilla_anio,planilla_mes) = Date_format(now(),'%Y-%M'));

set @operacion :=(SELECT tipo_concepto.tipoconcepto_operacion from tipo_concepto WHERE tipo_concepto.tipoconcepto_codigo = old.tipoconcepto_codigo);
set @id_monto :=(SELECT tipo_concepto.tipoconcepto_porcentaje from tipo_concepto WHERE tipo_concepto.tipoconcepto_codigo = old.tipoconcepto_codigo); 

IF (@operacion = 'Descuento') THEN
	UPDATE pago_planilla INNER JOIN planilla ON pago_planilla.planilla_codigo = planilla.planilla_codigo SET
     pago_planilla.pagoplanilla_sueldobruto = @sueldoBruto + old.conceptofijo_monto,
    pago_planilla.pagoplanilla_sueldoneto = @sueldoNeto + old.conceptofijo_monto
    WHERE planilla.contrato_codigo =old.contrato_codigo and pago_planilla.pagoplanilla_estado ='Activo' and CONCAT(planilla.planilla_anio,'-',planilla.planilla_mes) = Date_format(now(),'%Y-%M') ;
END IF;
IF (@operacion = 'Aumento') THEN
	UPDATE pago_planilla INNER JOIN planilla ON pago_planilla.planilla_codigo = planilla.planilla_codigo SET
     pago_planilla.pagoplanilla_sueldobruto =  @sueldoBruto-old.conceptofijo_monto,
    pago_planilla.pagoplanilla_sueldoneto =  @sueldoNeto -old.conceptofijo_monto
    WHERE planilla.contrato_codigo =old.contrato_codigo and pago_planilla.pagoplanilla_estado ='Activo' and CONCAT(planilla.planilla_anio,'-',planilla.planilla_mes) =Date_format(now(),'%Y-%M');
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table concepto_variable
-- ----------------------------
DROP TRIGGER IF EXISTS `TRIG_ACTUALIZARPLANILLA_CONCEPTO_VARIABLE_REGISTRAR`;
delimiter ;;
CREATE TRIGGER `TRIG_ACTUALIZARPLANILLA_CONCEPTO_VARIABLE_REGISTRAR` AFTER INSERT ON `concepto_variable` FOR EACH ROW BEGIN
DECLARE montoActual decimal(10,2);
DECLARE operacion varchar(20);
SET @montoActual :=(SELECT pago_planilla.pagoplanilla_sueldoneto FROM pago_planilla WHERE pago_planilla.pagoplanilla_codigo = new.pagoplanilla_codigo);
set @operacion :=(SELECT tipo_concepto.tipoconcepto_operacion from tipo_concepto WHERE tipo_concepto.tipoconcepto_codigo = new.tipoconcepto_codigo);
IF (@operacion = 'Descuento') THEN
	UPDATE pago_planilla SET
    pago_planilla.pagoplanilla_sueldoneto = (@montoActual-new.conceptova_monto)
    WHERE pago_planilla.pagoplanilla_codigo = new.pagoplanilla_codigo LIMIT 1; 
END IF;
IF (@operacion = 'Aumento') THEN 
	UPDATE pago_planilla SET
    pago_planilla.pagoplanilla_sueldoneto = (@montoActual+new.conceptova_monto)
    WHERE pago_planilla.pagoplanilla_codigo = new.pagoplanilla_codigo LIMIT 1;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table concepto_variable
-- ----------------------------
DROP TRIGGER IF EXISTS `TRG_ACTUALIZARPLANILLA_CONCEPTO_VARIABLE_ELIMINADO`;
delimiter ;;
CREATE TRIGGER `TRG_ACTUALIZARPLANILLA_CONCEPTO_VARIABLE_ELIMINADO` AFTER DELETE ON `concepto_variable` FOR EACH ROW BEGIN
DECLARE montoActual decimal(10,2);
DECLARE operacion varchar(20);
SET @montoActual :=(SELECT pago_planilla.pagoplanilla_sueldoneto FROM pago_planilla WHERE pago_planilla.pagoplanilla_codigo = old.pagoplanilla_codigo);
set @operacion :=(SELECT tipo_concepto.tipoconcepto_operacion from tipo_concepto WHERE tipo_concepto.tipoconcepto_codigo = old.tipoconcepto_codigo);
IF (@operacion = 'Descuento') THEN
	UPDATE pago_planilla SET
    pago_planilla.pagoplanilla_sueldoneto = (@montoActual+old.conceptova_monto)
    WHERE pago_planilla.pagoplanilla_codigo = old.pagoplanilla_codigo LIMIT 1; 
END IF;
IF (@operacion = 'Aumento') THEN 
	UPDATE pago_planilla SET
    pago_planilla.pagoplanilla_sueldoneto = (@montoActual-old.conceptova_monto)
    WHERE pago_planilla.pagoplanilla_codigo = old.pagoplanilla_codigo LIMIT 1;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table medio_comunicacion
-- ----------------------------
DROP TRIGGER IF EXISTS `TRIG_ACTUALIZAR_TRABAJADOR_REGISTRO`;
delimiter ;;
CREATE TRIGGER `TRIG_ACTUALIZAR_TRABAJADOR_REGISTRO` AFTER INSERT ON `medio_comunicacion` FOR EACH ROW BEGIN
IF new.medioco_tipo = 'Correo' THEN
    IF new.medioco_nivel = 'P' THEN
        UPDATE trabajador SET
        trabajador.trab_email = new.medioco_descripcion
        WHERE trabajador.trabajador_cod = new.trabajador_cod;
        
    END IF;
END IF;
IF new.medioco_tipo = 'Telefono' THEN
    IF new.medioco_nivel = 'P' THEN
        UPDATE trabajador SET
        trabajador.trab_telefono =  new.medioco_descripcion
        WHERE trabajador.trabajador_cod = new.trabajador_cod;
    END IF;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table medio_comunicacion
-- ----------------------------
DROP TRIGGER IF EXISTS `TRIG_ACTUALIZAR_TRABAJADOR_ELIMINAR`;
delimiter ;;
CREATE TRIGGER `TRIG_ACTUALIZAR_TRABAJADOR_ELIMINAR` AFTER DELETE ON `medio_comunicacion` FOR EACH ROW BEGIN
IF old.medioco_tipo = 'Correo' THEN
    IF old.medioco_nivel = 'p' THEN
        UPDATE trabajador SET
        trabajador.trab_email = ''
        WHERE trabajador.trabajador_cod = old.trabajador_cod;
    END IF;
END IF;
IF old.medioco_tipo = 'Telefono' THEN
    IF old.medioco_nivel = 'p' THEN
        UPDATE trabajador SET
        trabajador.trab_telefono = ''
        WHERE trabajador.trabajador_cod = old.trabajador_cod;
    END IF;
END IF;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
