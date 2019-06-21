-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 21-06-2019 a las 12:39:15
-- Versión del servidor: 5.5.62-cll
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: 
--

DELIMITER $$
--
-- Procedimientos
--
CREATE  PROCEDURE `con_actualizar_intentos` (IN `usu` VARCHAR(30), IN `inte` INT)  UPDATE glb_usuario
set 
intentos =inte,
fecha_ultimo_intento= CURRENT_TIME
WHERE usu_email = usu$$

CREATE PROCEDURE `con_registrar_permisos` (IN `inicio` VARCHAR(20), IN `final` VARCHAR(20))  insert into con_permiso (usu_codigo,permi_fechainicio,permi_fechafinal,permi_est) VALUES((select max(usu_codigo) from glb_usuario ),inicio,final,'Activo')$$

CREATE  PROCEDURE `con_registrar_usuario` (IN `cod_empleado` INT, IN `email` VARCHAR(30), IN `contrasenia` VARCHAR(30))  insert into glb_usuario (empl_codigo,usu_email,usu_clave,usu_estado,intentos,fecha_ultimo_intento) VALUES (cod_empleado,email,contrasenia,'Activo','0',CURRENT_TIME)$$

CREATE  PROCEDURE `con_registrar_usurol` (IN `rol` INT)  insert into con_usurol (usu_id,rol_id,usrol_femod,usrol_est) VALUES((select max(usu_codigo) from glb_usuario ),rol,CURRENT_TIME,'Activo')$$

CREATE  PROCEDURE `PA_ACTUALIZARCUENTA` (IN `ID_USUARIO` INT, IN `CLAVE` VARCHAR(50))  BEGIN
UPDATE usuario SET
usu_clave = CLAVE
WHERE usu_codigo = ID_USUARIO;
END$$

CREATE  PROCEDURE `PA_BUSCARADMINISTRADOR` (IN `codigo` INT)  SELECT
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
where trabajador.trabajador_cod = codigo$$

CREATE  PROCEDURE `PA_BUSCARDOCUMENTOIDENTIDAD` (IN `BUSCAR` VARCHAR(100))  SELECT * FROM documento_trabajador
 WHERE documento_trabajador.documento_descripcion LIKE BUSCAR$$

CREATE  PROCEDURE `PA_BUSCAREMAIL` (IN `BUSCAR` VARCHAR(150))  select 
trabajador.trab_email,
usuario.usu_email,
usuario.usu_clave 
from usuario
INNER JOIN trabajador ON usuario.trabajador_cod = trabajador.trabajador_cod
 where trabajador.trab_email = BUSCAR$$

CREATE  PROCEDURE `PA_COMBOAREA` ()  SELECT area_codigo,area_descripcion,area_estatus FROM area_trabajo WHERE area_trabajo.area_estatus = 'ACTIVO'$$

CREATE  PROCEDURE `PA_COMBOCARGO` ()  SELECT
cargo.cargo_codigo,
cargo.cargo_descripcion
FROM
cargo$$

CREATE  PROCEDURE `PA_COMBOSEGURO` ()  SELECT
seguro.seguro_id,
seguro.seguro_descripcion
FROM
seguro$$

CREATE  PROCEDURE `PA_COMBOTIPOCONCEPTOFIJO` ()  SELECT
tipo_concepto.tipoconcepto_codigo,
tipo_concepto.tipoconcepto_nombre,
tipo_concepto.tipoconcepto_porcentaje,
tipo_concepto.tipoconcepto_operacion
FROM tipo_concepto
WHERE tipo_concepto.tipoconcepto_porcentaje != 0$$

CREATE  PROCEDURE `PA_COMBOTIPOCONCEPTOFIJOCONTRATO` (IN `ID_CONTRATO` INT)  SELECT
tipo_concepto.tipoconcepto_codigo,
tipo_concepto.tipoconcepto_nombre,
tipo_concepto.tipoconcepto_porcentaje,
tipo_concepto.tipoconcepto_operacion
FROM tipo_concepto
WHERE tipo_concepto.tipoconcepto_porcentaje != 0 AND
tipo_concepto.tipoconcepto_codigo 
NOT IN (SELECT concepto_fijo.tipoconcepto_codigo FROM concepto_fijo  WHERE concepto_fijo.contrato_codigo=ID_CONTRATO)$$

CREATE  PROCEDURE `PA_COMBOTIPOCONTRATO` ()  SELECT
tipo_contrato.tipocon_codigo,
tipo_contrato.tipocon_descripcion
FROM
tipo_contrato$$

CREATE  PROCEDURE `PA_EDITARCONTRATO` (IN `id_contrato` INT, IN `fecha_inicio` DATE, IN `fecha_final` DATE, IN `terminos` VARCHAR(350), IN `cbm_tipocont` INT, IN `cbm_area` INT, IN `cbm_seguro` INT, IN `cbm_cargo` INT, IN `cbm_estado` VARCHAR(15))  BEGIN
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
END$$

CREATE  PROCEDURE `PA_EDITARDATOSTRABAJADOR` (IN `id_trabajador` INT, IN `txt_nombre` VARCHAR(350), IN `txt_apepat` VARCHAR(150), IN `txt_apemat` VARCHAR(150), IN `rad_sexo` CHAR(10), IN `txt_fechanacimi` DATE)  UPDATE trabajador SET
trab_nombre = txt_nombre,
trab_apellidopate = txt_apepat,
trab_apellidomate = txt_apemat,
trab_sexo = rad_sexo,
trab_fechanacimiento = txt_fechanacimi
WHERE trabajador_cod = id_trabajador$$

CREATE  PROCEDURE `PA_EDITARUSUARIO` (IN `usuario` VARCHAR(30), IN `actual` VARCHAR(30), IN `nueva` VARCHAR(30))  BEGIN
UPDATE usuario u
SET
u.usu_clave = nueva
WHERE u.usu_email = usuario AND u.usu_clave = actual;

END$$

CREATE  PROCEDURE `PA_ELIMINARCONCEPTOFIJO` (IN `ID_CODIGO` INT)  DELETE FROM concepto_fijo WHERE concepto_fijo.conceptofijo_codigo = ID_CODIGO$$

CREATE  PROCEDURE `PA_ELIMINARDOCUMENTOIDENTIDAD` (IN `CODIGO` INT)  DELETE FROM documento_trabajador 
WHERE
documento_trabajador.documento_id = CODIGO$$

CREATE  PROCEDURE `PA_ELIMINARMEDIOCOMUNICACION` (IN `CODIGO` INT)  DELETE FROM medio_comunicacion
WHERE medio_comunicacion.medioco_id = CODIGO$$

CREATE  PROCEDURE `PA_LISTARCONCEPTOSFIJOS` (IN `ID_CONTRATO` INT)  SELECT
concepto_fijo.conceptofijo_codigo,
tipo_concepto.tipoconcepto_nombre,
tipo_concepto.tipoconcepto_porcentaje,
concepto_fijo.conceptofijo_monto,
concepto_fijo.contrato_codigo,
tipo_concepto.tipoconcepto_operacion
FROM
concepto_fijo
INNER JOIN tipo_concepto ON concepto_fijo.tipoconcepto_codigo = tipo_concepto.tipoconcepto_codigo
WHERE concepto_fijo.contrato_codigo =ID_CONTRATO$$

CREATE  PROCEDURE `PA_LISTARCONTRATOS` (IN `INICIO` DATE, IN `FINAL` DATE)  BEGIN
DECLARE cantid INT;
SET @cantid :=0;
SELECT
@cantid:=@cantid+1 AS posicion,
CONCAT_WS(' ',
trabajador.trab_nombre,
trabajador.trab_apellidopate,
trabajador.trab_apellidomate) as trabajador,
contrato.contrato_codigo,
DATE_FORMAT(contrato.contrato_fecinicio,  '%m/%d/%Y' ) as contrato_fecinicio,
DATE_FORMAT(contrato.contrato_fecterm,  '%m/%d/%Y' ) as contrato_fecterm,
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
END$$

CREATE  PROCEDURE `PA_LISTARTRABAJADOR` (IN `BUSCAR` VARCHAR(350))  BEGIN
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
DATE_FORMAT(trabajador.trab_fechanacimiento,  '%m/%d/%Y' ) as trab_fechanacimiento,
trabajador.trab_fecharegistro,
trabajador.trab_estado,
IFNULL(trabajador.trab_telefono,'') AS trab_telefono
FROM
trabajador
LEFT JOIN medio_comunicacion ON medio_comunicacion.trabajador_cod = trabajador.trabajador_cod
LEFT JOIN documento_trabajador ON documento_trabajador.trabajador_cod = trabajador.trabajador_cod

where CONCAT_WS(' ',trabajador.trab_apellidopate,trabajador.trab_apellidomate,trabajador.trab_nombre) like BUSCAR
 GROUP BY trabajador.trabajador_cod order by trabajador.trabajador_cod ASC;
END$$

CREATE  PROCEDURE `PA_LISTARTRABAJADORES_SINUSUARIO` (IN `BUSCAR` VARCHAR(100))  BEGIN
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
END$$

CREATE  PROCEDURE `PA_LISTARTRABAJADOR_DOCUMENTOIDENTIDAD` (IN `BUSCAR` INT)  BEGIN
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
END$$

CREATE  PROCEDURE `PA_LISTARTRABAJADOR_MEDIOCOMUNICACION` (IN `BUSCAR` INT)  BEGIN
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
END$$

CREATE  PROCEDURE `PA_LISTARTRABAJADOR_SINCONTRATO` (IN `BUSCAR` VARCHAR(350))  SELECT
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
 GROUP BY trabajador.trabajador_cod order by trabajador.trabajador_cod ASC$$

CREATE  PROCEDURE `PA_LISTARUSUARIO` (IN `BUSCAR` VARCHAR(200))  BEGIN
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
END$$

CREATE  PROCEDURE `PA_REGISTRARCONCEPTOFIJO` (IN `MONTO` DECIMAL(10,2), IN `ID_CONTRATO` INT, IN `ID_CONCEPTO` INT)  INSERT INTO  concepto_fijo (conceptofijo_monto,tipoconcepto_codigo,contrato_codigo) 
VALUES (MONTO,ID_CONCEPTO,ID_CONTRATO)$$

CREATE  PROCEDURE `PA_REGISTRARCONTRATO` (IN `fecha_inicio` DATE, IN `fecha_final` DATE, IN `terminos` VARCHAR(350), IN `cbm_tipocont` INT, IN `cbm_area` INT, IN `cbm_seguro` INT, IN `cbm_cargo` INT, IN `sueldo` DECIMAL(10,2), IN `id_trabajador` INT)  BEGIN
DECLARE id INT;
INSERT INTO contrato (contrato_fecinicio,contrato_fecterm,trabajador_cod,contrato_terminos,tipocon_codigo,contrato_estatus,contrato_sueldo,
seguro_id,area_codigo,cargo_codigo)
VALUES (fecha_inicio,fecha_final,id_trabajador,terminos,cbm_tipocont,'Activo',sueldo,cbm_seguro,cbm_area,cbm_cargo);
SET @id :=(SELECT contrato.contrato_codigo FROM contrato WHERE contrato.contrato_codigo = LAST_INSERT_ID());
SELECT @id;
END$$

CREATE  PROCEDURE `PA_REGISTRARDATOSTRABAJADOR` (IN `txt_nombre` VARCHAR(350), IN `txt_apepat` VARCHAR(150), IN `txt_apemat` VARCHAR(150), IN `rad_sexo` CHAR(10), IN `txt_fechanacimi` DATE)  BEGIN
DECLARE id INT;
INSERT INTO trabajador (trab_nombre,trab_apellidopate,trab_apellidomate,trab_sexo,trab_fechanacimiento,trab_fecharegistro,trab_estado)
VALUES (txt_nombre,txt_apepat,txt_apemat,rad_sexo,txt_fechanacimi,CURRENT_TIMESTAMP,'Activo');
SET @id :=(SELECT trabajador.trabajador_cod FROM trabajador WHERE trabajador.trabajador_cod = LAST_INSERT_ID());
SELECT @id;
END$$

CREATE  PROCEDURE `PA_REGISTRARDOCUMENTOIDENTIDAD` (IN `CODIGO` INT, IN `DNI` VARCHAR(350), IN `TIPO` VARCHAR(50))  BEGIN
DECLARE cantidad INT;
SET @cantidad :=(SELECT COUNT(*) FROM documento_trabajador WHERE documento_trabajador.documento_descripcion LIKE DNI);
IF @cantidad = 0  THEN
INSERT INTO documento_trabajador (trabajador_cod,tipo_documento,documento_descripcion)
VALUES(CODIGO,TIPO,DNI);
SELECT 1;
ELSE
SELECT 2;
END IF;
END$$

CREATE  PROCEDURE `PA_REGISTRARMEDIOCOMUNICACION` (IN `CODIGO` INT, IN `MEDIO` VARCHAR(350), IN `TIPO` VARCHAR(50), IN `NIVEL` VARCHAR(50))  BEGIN
INSERT INTO medio_comunicacion(medioco_descripcion,medioco_tipo,trabajador_cod,medioco_estatus,medioco_nivel) 
VALUES(MEDIO,TIPO,CODIGO,'ACTIVO',NIVEL);
END$$

CREATE  PROCEDURE `PA_REGISTRARUSUARIO` (IN `id_trabajador` INT, IN `usuario` VARCHAR(150), IN `clave` VARCHAR(100), IN `fechainicio` DATE, IN `fechafinal` DATE, IN `rol` INT)  BEGIN
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
END$$

CREATE  PROCEDURE `PA_VERIFICARUSUARIO` (IN `_usu` VARCHAR(30), IN `_pass` VARCHAR(30))  BEGIN
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
END$$

CREATE  PROCEDURE `SP_AREA_MODIFICAR` (IN `IDAREA` INT, IN `AREA` VARCHAR(50), IN `ESTATUS` VARCHAR(10))  UPDATE area_trabajo SET  area_descripcion=AREA,area_estatus=ESTATUS
where area_codigo=IDAREA$$

CREATE  PROCEDURE `SP_AREA_REGISTRAR` (IN `AREA` VARCHAR(50), IN `ESTATUS` VARCHAR(10))  BEGIN
DECLARE cantidad INT;
SET @cantidad :=(SELECT COUNT(*) FROM area_trabajo where area_descripcion like AREA);
IF @cantidad = 0  THEN
INSERT INTO area_trabajo(area_descripcion,area_fecregistro,area_estatus)
VALUES(AREA,CURDATE(),ESTATUS);
SELECT 1;
ELSE
SELECT 2;
END IF;
END$$

CREATE  PROCEDURE `SP_CARGO_LISTAR` ()  SELECT * FROM cargo$$

CREATE  PROCEDURE `SP_CARGO_MODIFICAR` (IN `CODIGOCARGO` INT, IN `DESCRIPCION` VARCHAR(50), IN `ESTATUS` VARCHAR(10))  UPDATE cargo SET 
cargo_descripcion=DESCRIPCION,
cargo_estatus=ESTATUS
WHERE cargo_codigo=CODIGOCARGO$$

CREATE  PROCEDURE `SP_CARGO_REGISTRO` (IN `DESCRIPCION` VARCHAR(50), IN `ESTATUS` VARCHAR(30))  INSERT INTO cargo(cargo_descripcion,cargo_estatus) VALUES (DESCRIPCION,ESTATUS)$$

CREATE  PROCEDURE `SP_CARGO_SEGURO` (IN `DESCRIPCION` VARCHAR(50), IN `ESTATUS` VARCHAR(10))  INSERT INTO seguro(seguro_descripcion,seguro_estatus) values(DESCRIPCION,ESTATUS)$$

CREATE  PROCEDURE `SP_FAMILIAR_LISTAR` ()  SELECT
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
familiar$$

CREATE  PROCEDURE `SP_FAMILIAR_MODIFICAR` (IN `IDFAMILIAR` INT, IN `NOMBRE` VARCHAR(50), IN `APEPAT` VARCHAR(50), IN `APEMAT` VARCHAR(50), IN `NRODOCUMENTO` VARCHAR(12), IN `TIPODOCUMENTO` VARCHAR(30), IN `FECHANACIMIENTO` DATE, IN `ESTATUS` VARCHAR(10))  update familiar set familiar_nombre=NOMBRE,familiar_apepat=APEPAT,familiar_apemat=APEMAT,
familiar_nrodocumento=NRODOCUMENTO,familiar_tipodocumento=TIPODOCUMENTO,familiar_fecnac=FECHANACIMIENTO,
familiar_estatus=ESTATUS
where familiar_codigo=IDFAMILIAR$$

CREATE  PROCEDURE `SP_FAMILIAR_REGISTRO` (IN `NOMBRE` VARCHAR(50), IN `APEPAT` VARCHAR(50), IN `APEMAT` VARCHAR(50), IN `NRODOCUMENTO` VARCHAR(12), IN `TIPODOCUMENTO` VARCHAR(30), IN `FECHANACIMIENTO` DATE, IN `ESTATUS` VARCHAR(10))  BEGIN
	DECLARE cantidad INT;
	SET @cantidad :=(select COUNT(*) from familiar where familiar_nrodocumento=NRODOCUMENTO);
	IF @cantidad = 0 THEN
	INSERT INTO familiar(familiar_nombre,familiar_apepat,familiar_apemat,familiar_nrodocumento,familiar_tipodocumento,familiar_fecnac,familiar_estatus) VALUES(NOMBRE,APEPAT,APEMAT,NRODOCUMENTO,TIPODOCUMENTO,FECHANACIMIENTO,ESTATUS);
	SELECT 1;
	ELSE
		SELECT 2;
	END IF;
END$$

CREATE  PROCEDURE `SP_LISTARAREA` ()  SELECT * FROM area_trabajo$$

CREATE  PROCEDURE `SP_SEGURO_LISTAR` ()  SELECT * FROM seguro$$

CREATE  PROCEDURE `SP_SEGURO_MODIFICAR` (IN `IDSEGURO` INT, IN `SEGURO` VARCHAR(50), IN `ESTATUS` VARCHAR(10))  UPDATE seguro SET seguro_descripcion=SEGURO,seguro_estatus=ESTATUS
where seguro_id=IDSEGURO$$

CREATE  PROCEDURE `SP_TIPOCONTRATO_LISTAR` ()  SELECT * FROM tipo_contrato$$

CREATE  PROCEDURE `SP_TIPOCONTRATO_MODIFICAR` (IN `IDTIPO` INT, IN `TIPOCONTRATO` VARCHAR(50), IN `ESTATUS` VARCHAR(10))  UPDATE tipo_contrato set tipocon_descripcion=TIPOCONTRATO,tipocon_estatus=ESTATUS
where tipocon_codigo=IDTIPO$$

CREATE  PROCEDURE `SP_TIPOCONTRATO_REGISTRO` (IN `TIPOCONTRATO` VARCHAR(50), IN `ESTATUS` VARCHAR(10))  BEGIN
DECLARE cantidad INT;
SET @cantidad :=(SELECT COUNT(*) FROM tipo_contrato where tipocon_descripcion like TIPOCONTRATO);
IF @cantidad = 0  THEN
INSERT INTO tipo_contrato(tipocon_descripcion,tipocon_feccreacion,tipocon_estatus)
VALUES(TIPOCONTRATO,CURDATE(),ESTATUS);
SELECT 1;
ELSE
SELECT 2;
END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_trabajo`
--

CREATE TABLE `area_trabajo` (
  `area_codigo` int(11) NOT NULL,
  `area_descripcion` varchar(50) DEFAULT NULL,
  `area_fecregistro` date DEFAULT NULL,
  `area_estatus` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `area_trabajo`
--

INSERT INTO `area_trabajo` (`area_codigo`, `area_descripcion`, `area_fecregistro`, `area_estatus`) VALUES
(1, 'PRODUCCION', '2019-05-01', 'ACTIVO'),
(2, 'ADMINISTRATIVO', '2019-05-15', 'ACTIVO'),
(3, 'ALMACEN', '2019-05-15', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `cargo_codigo` int(11) NOT NULL,
  `cargo_descripcion` varchar(50) DEFAULT NULL,
  `cargo_estatus` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`cargo_codigo`, `cargo_descripcion`, `cargo_estatus`) VALUES
(1, 'JEFE DE ALMACEN', 'ACTIVO'),
(2, 'ASISTENTE ADMINISTRATIVO', 'ACTIVO'),
(3, 'OPERADOR', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concepto_fijo`
--

CREATE TABLE `concepto_fijo` (
  `conceptofijo_codigo` int(11) NOT NULL,
  `conceptofijo_monto` decimal(10,2) DEFAULT NULL,
  `tipoconcepto_codigo` int(11) DEFAULT NULL,
  `contrato_codigo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `concepto_fijo`
--

INSERT INTO `concepto_fijo` (`conceptofijo_codigo`, `conceptofijo_monto`, `tipoconcepto_codigo`, `contrato_codigo`) VALUES
(1, '500.00', 2, 1),
(3, '400.00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `contrato_codigo` int(11) NOT NULL,
  `contrato_fecinicio` date DEFAULT NULL,
  `contrato_fecterm` date DEFAULT NULL,
  `trabajador_cod` int(11) DEFAULT NULL,
  `contrato_terminos` varchar(350) DEFAULT NULL,
  `tipocon_codigo` int(11) DEFAULT NULL,
  `contrato_estatus` varchar(10) DEFAULT NULL,
  `contrato_sueldo` decimal(10,2) DEFAULT NULL,
  `seguro_id` int(11) DEFAULT NULL,
  `area_codigo` int(11) DEFAULT NULL,
  `cargo_codigo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`contrato_codigo`, `contrato_fecinicio`, `contrato_fecterm`, `trabajador_cod`, `contrato_terminos`, `tipocon_codigo`, `contrato_estatus`, `contrato_sueldo`, `seguro_id`, `area_codigo`, `cargo_codigo`) VALUES
(1, '2019-06-20', '2019-08-20', 11, 'Termino 1.2', 1, 'Activo', '5000.00', 1, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `con_modalidad_pago`
--

CREATE TABLE `con_modalidad_pago` (
  `tipag_codigo` int(11) NOT NULL COMMENT 'Codigo autogenerado, identificador de la tabla Modalidad de pago',
  `tipag_descripcion` varchar(50) NOT NULL COMMENT 'Descripcion de la Tabla Modalidad de Pago',
  `tipag_estado` enum('Activo','Inactivo') NOT NULL COMMENT 'Estado de la Tabla Modalidad de pago'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla Modalidad de Pago, no se podra repetir la Descripcion de la tabla';

--
-- Volcado de datos para la tabla `con_modalidad_pago`
--

INSERT INTO `con_modalidad_pago` (`tipag_codigo`, `tipag_descripcion`, `tipag_estado`) VALUES
(1, 'Contado', 'Activo'),
(2, 'Credito', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_trabajador`
--

CREATE TABLE `documento_trabajador` (
  `documento_id` int(11) NOT NULL,
  `trabajador_cod` int(11) DEFAULT NULL,
  `tipo_documento` varchar(50) NOT NULL,
  `documento_descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documento_trabajador`
--

INSERT INTO `documento_trabajador` (`documento_id`, `trabajador_cod`, `tipo_documento`, `documento_descripcion`) VALUES
(1, 9, 'DNI', '73340318'),
(2, 9, 'PASAPORTE', '73340317'),
(3, 11, 'DNI', '32928409'),
(4, 12, 'DNI', '32569852'),
(5, 9, 'RUC', '10406536209');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familiar`
--

CREATE TABLE `familiar` (
  `familiar_codigo` int(11) NOT NULL,
  `familiar_nombre` varchar(50) DEFAULT NULL,
  `familiar_apepat` varchar(50) DEFAULT NULL,
  `familiar_apemat` varchar(50) DEFAULT NULL,
  `familiar_nrodocumento` varchar(12) DEFAULT NULL,
  `familiar_tipodocumento` varchar(30) DEFAULT NULL,
  `familiar_fecnac` date DEFAULT NULL,
  `familiar_estatus` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `familiar`
--

INSERT INTO `familiar` (`familiar_codigo`, `familiar_nombre`, `familiar_apepat`, `familiar_apemat`, `familiar_nrodocumento`, `familiar_tipodocumento`, `familiar_fecnac`, `familiar_estatus`) VALUES
(2, 'AYELEN MILENA', 'RAMOS', 'CABALLEROS', '76216924', 'DNI', '1994-06-19', 'ACTIVO'),
(3, 'AINHOA NATZUMI', 'RODRIGUEZS', 'RAMOS', '12345678', 'DNI', '1994-03-01', 'ACTIVO'),
(4, 'RONY', 'GUZMAN', 'GUZMAN', '74123655', 'DNI', '1995-06-21', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medio_comunicacion`
--

CREATE TABLE `medio_comunicacion` (
  `medioco_id` int(11) NOT NULL,
  `medioco_descripcion` varchar(50) DEFAULT NULL,
  `medioco_tipo` varchar(50) DEFAULT NULL,
  `trabajador_cod` int(11) DEFAULT NULL,
  `medioco_estatus` varchar(10) DEFAULT NULL,
  `medioco_nivel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medio_comunicacion`
--

INSERT INTO `medio_comunicacion` (`medioco_id`, `medioco_descripcion`, `medioco_tipo`, `trabajador_cod`, `medioco_estatus`, `medioco_nivel`) VALUES
(1, 'lizethesl1980@gmail.com', 'Correo', 9, 'ACTIVO', 'P'),
(3, '982244930', 'Telefono', 9, 'ACTIVO', 'P'),
(4, 'lizethe3010@hotmail.com', 'Correo', 9, 'ACTIVO', 'S'),
(7, 'hdjdjd2@gmail.com', 'Correo', 25, 'ACTIVO', 'P'),
(8, '838383', 'Telefono', 25, 'ACTIVO', 'P');

--
-- Disparadores `medio_comunicacion`
--
DELIMITER $$
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
$$
DELIMITER ;
DELIMITER $$
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
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `modu_id` int(11) NOT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `modu_nom` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modu_icono` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modu_url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `permi_codigo` int(11) NOT NULL,
  `usu_codigo` int(11) DEFAULT NULL,
  `permi_fechainicio` date NOT NULL,
  `permi_fechafinal` date NOT NULL,
  `permi_est` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`permi_codigo`, `usu_codigo`, `permi_fechainicio`, `permi_fechafinal`, `permi_est`) VALUES
(1, 1, '2018-05-31', '2108-11-01', 'Activo'),
(2, 2, '2019-05-14', '2019-05-29', 'Activo'),
(7, 8, '2019-04-01', '2020-06-01', 'Activo'),
(8, 9, '2019-06-01', '2019-08-01', 'Activo'),
(9, 10, '2019-06-01', '2019-06-20', 'Activo'),
(10, 11, '2019-06-01', '2019-06-30', 'Activo'),
(11, 12, '2019-06-01', '2019-06-30', 'Activo'),
(12, 13, '2019-06-01', '2019-06-30', 'Activo'),
(13, 14, '2019-06-03', '2019-06-29', 'Activo'),
(14, 15, '2019-06-02', '2019-07-06', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `rol_des` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rol_freg` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `rol_est` enum('Activo','Inactivo') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_des`, `rol_freg`, `rol_est`) VALUES
(1, 'ADMINISTRADOR', '2018-06-18 01:10:08', 'Activo'),
(2, 'TRABAJADOR', '2019-05-30 05:53:54', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguro`
--

CREATE TABLE `seguro` (
  `seguro_id` int(11) NOT NULL,
  `seguro_descripcion` varchar(50) DEFAULT NULL,
  `seguro_estatus` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seguro`
--

INSERT INTO `seguro` (`seguro_id`, `seguro_descripcion`, `seguro_estatus`) VALUES
(1, 'SIS', 'ACTIVO'),
(2, 'ESSALUD', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_concepto`
--

CREATE TABLE `tipo_concepto` (
  `tipoconcepto_codigo` int(11) NOT NULL,
  `tipoconcepto_nombre` varchar(50) DEFAULT NULL,
  `tipoconcepto_porcentaje` int(11) DEFAULT NULL,
  `tipoconcepto_operacion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_concepto`
--

INSERT INTO `tipo_concepto` (`tipoconcepto_codigo`, `tipoconcepto_nombre`, `tipoconcepto_porcentaje`, `tipoconcepto_operacion`) VALUES
(1, 'AFP', 8, 'DESCUENTO'),
(2, 'ONP', 10, 'DESCUENTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_contrato`
--

CREATE TABLE `tipo_contrato` (
  `tipocon_codigo` int(11) NOT NULL,
  `tipocon_descripcion` varchar(50) DEFAULT NULL,
  `tipocon_feccreacion` date DEFAULT NULL,
  `tipocon_estatus` enum('ACTIVO','INACTIVO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tipo_contrato`
--

INSERT INTO `tipo_contrato` (`tipocon_codigo`, `tipocon_descripcion`, `tipocon_feccreacion`, `tipocon_estatus`) VALUES
(1, 'TEMPORAL', '2019-06-21', 'INACTIVO'),
(2, 'ANUAL', '2019-06-21', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `trabajador_cod` int(11) NOT NULL COMMENT 'identificador de la persona',
  `trab_nombre` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Nombre de la persona',
  `trab_apellidopate` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'apellido paterno de la persona',
  `trab_apellidomate` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'apellido materno de la persona',
  `trab_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'email de la persona',
  `trab_sexo` enum('M','F') COLLATE utf8_unicode_ci NOT NULL COMMENT 'sexo de la persona Masculino "M", Feminino "F"',
  `trab_fechanacimiento` date NOT NULL COMMENT 'fecha de nacimiento de la persona',
  `trab_fecharegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha del registro de la persona',
  `trab_estado` enum('Activo','Inactivo') COLLATE utf8_unicode_ci NOT NULL COMMENT 'estado de la persona',
  `trab_telefono` char(9) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Entidad persona';

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`trabajador_cod`, `trab_nombre`, `trab_apellidopate`, `trab_apellidomate`, `trab_email`, `trab_sexo`, `trab_fechanacimiento`, `trab_fecharegistro`, `trab_estado`, `trab_telefono`) VALUES
(9, 'Lizethe', ' Sarmiento', ' Sarmiento', 'lizethesl1980@gmail.com', 'F', '1992-06-29', '2018-04-29 08:24:21', 'Activo', '982244930'),
(10, 'Heber', 'Gomez', 'Hurtado', 'heber.gomez@usanpedro.edu.pe', 'M', '1990-06-14', '2018-04-30 02:36:16', 'Activo', ''),
(11, 'Pedro', 'Nolasco', 'Vergaray', 'lert.07.ds04.95@gmail.com', 'M', '2020-05-30', '2019-05-30 19:20:17', 'Activo', NULL),
(12, 'Pedro', 'Suarez', 'Verti', 'suares@gmail.com', 'M', '1989-05-30', '2019-05-30 20:27:55', 'Activo', NULL),
(13, 'Juan', 'Garcia', 'Gonalez', 'lert.07.04.95@gmail.com', 'M', '2020-05-30', '2019-05-30 20:28:17', 'Activo', NULL),
(14, 'Marta Gabi', 'De la Cruz', 'Sandobal', 'martita@gmail.com', 'F', '1989-05-30', '2019-05-30 20:28:42', 'Activo', NULL),
(15, 'Daniela ', 'Vargas', ' Sarmiento', 'daniela_v_69@hotmail.com', 'F', '1990-02-13', '2019-06-06 19:24:44', 'Activo', NULL),
(17, 'Jose ', 'Aoki', 'Paz', 'jaoki84@hotmail.com', 'M', '1988-05-13', '2019-06-06 19:26:01', 'Activo', NULL),
(18, 'Johana', 'Cabello', 'Bazalar', 'jcableo@hotmail.com', 'F', '1980-04-07', '2019-06-06 19:26:01', 'Activo', NULL),
(21, 'Nelson', 'Marillo', 'Nuñez', 'nelsongmn@gmail.com', 'M', '1985-01-05', '2019-06-06 19:33:15', 'Activo', NULL),
(22, 'Richard', 'Marillo', 'Nuñez', 'richardpmn1983@gmail.com', 'M', '1992-08-12', '2019-06-06 19:34:24', 'Activo', NULL),
(23, 'Jessibeth ', 'Salinas', 'Salinas', 'jessibeth81@gmail.com', 'F', '1990-04-21', '2019-06-06 19:34:24', 'Activo', NULL),
(24, 'Jonathan', 'Vega ', 'Gabriel', 'jhomar19887@gmail.com', 'M', '1988-01-25', '2019-06-06 19:35:31', 'Activo', NULL),
(25, 'jdjdj', 'jdjdjjd', 'jdjjd', 'hdjdjd2@gmail.com', 'F', '2019-06-20', '2019-06-20 06:22:17', 'Activo', '838383');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usu_codigo` int(11) NOT NULL,
  `usu_email` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `usu_clave` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `usu_estado` enum('Activo','Inactivo') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `intentos` int(11) NOT NULL,
  `fecha_ultimo_intento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trabajador_cod` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_codigo`, `usu_email`, `usu_clave`, `usu_estado`, `intentos`, `fecha_ultimo_intento`, `trabajador_cod`) VALUES
(1, 'admin', 'sarmiento1', 'Activo', 0, '2019-02-15 16:45:33', 9),
(2, 'heber', '123456', 'Activo', 0, '2019-05-30 08:48:47', 10),
(8, 'Jgarcia', '123456', 'Activo', 0, '2019-06-04 19:19:25', 13),
(9, 'psuarez', 'nfyzotliyw', 'Activo', 0, '2019-06-04 19:24:29', 12),
(10, 'Dcruz', '123456', 'Activo', 0, '2019-06-05 01:54:58', 14),
(11, 'Pnolasco', 'P12345', 'Activo', 0, '2019-06-06 17:47:49', 11),
(12, 'jcabello', 'pghgzizfqy', 'Activo', 0, '2019-06-07 20:34:57', 18),
(13, 'jsalinas', 'salinas', 'Activo', 0, '2019-06-07 20:41:43', 23),
(14, 'rmarillo', '123456', 'Activo', 0, '2019-06-07 21:19:23', 22),
(15, 'dvargas', 'daniela', 'Activo', 0, '2019-06-07 22:44:48', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usurol`
--

CREATE TABLE `usurol` (
  `usrol_id` int(11) NOT NULL,
  `usu_id` int(11) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `usrol_femod` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usrol_est` enum('Activo','Inactivo') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usurol`
--

INSERT INTO `usurol` (`usrol_id`, `usu_id`, `rol_id`, `usrol_femod`, `usrol_est`) VALUES
(1, 1, 1, '2018-06-18 01:12:53', 'Activo'),
(2, 2, 2, '2019-05-30 08:49:21', 'Activo'),
(6, 8, 2, '2019-06-04 19:19:25', 'Activo'),
(7, 9, 1, '2019-06-04 19:24:29', 'Activo'),
(8, 10, 1, '2019-06-05 01:54:58', 'Activo'),
(9, 11, 1, '2019-06-06 17:47:49', 'Activo'),
(10, 12, 1, '2019-06-07 20:34:57', 'Activo'),
(11, 13, 1, '2019-06-07 20:41:43', 'Activo'),
(12, 14, 2, '2019-06-07 21:19:23', 'Activo'),
(13, 15, 2, '2019-06-07 22:44:48', 'Activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area_trabajo`
--
ALTER TABLE `area_trabajo`
  ADD PRIMARY KEY (`area_codigo`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`cargo_codigo`);

--
-- Indices de la tabla `concepto_fijo`
--
ALTER TABLE `concepto_fijo`
  ADD PRIMARY KEY (`conceptofijo_codigo`),
  ADD KEY `tipoconcepto_codigo` (`tipoconcepto_codigo`),
  ADD KEY `contrato_codigo` (`contrato_codigo`);

--
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`contrato_codigo`),
  ADD KEY `cargo_codigo` (`cargo_codigo`),
  ADD KEY `area_codigo` (`area_codigo`),
  ADD KEY `seguro_id` (`seguro_id`),
  ADD KEY `trabajador_cod` (`trabajador_cod`),
  ADD KEY `tipocon_codigo` (`tipocon_codigo`);

--
-- Indices de la tabla `con_modalidad_pago`
--
ALTER TABLE `con_modalidad_pago`
  ADD PRIMARY KEY (`tipag_codigo`),
  ADD UNIQUE KEY `IU_descripcion` (`tipag_descripcion`) USING BTREE COMMENT 'Índice que permite  que no exista duplicidad en la descripción de la tabla.',
  ADD UNIQUE KEY `IX_codigo` (`tipag_codigo`) USING BTREE COMMENT 'Índice que indica que los datos se ordenaran a traves del codigo';

--
-- Indices de la tabla `documento_trabajador`
--
ALTER TABLE `documento_trabajador`
  ADD PRIMARY KEY (`documento_id`),
  ADD KEY `trabajador_codigo` (`trabajador_cod`);

--
-- Indices de la tabla `familiar`
--
ALTER TABLE `familiar`
  ADD PRIMARY KEY (`familiar_codigo`) USING BTREE;

--
-- Indices de la tabla `medio_comunicacion`
--
ALTER TABLE `medio_comunicacion`
  ADD PRIMARY KEY (`medioco_id`),
  ADD KEY `trabajador_cod` (`trabajador_cod`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`modu_id`),
  ADD KEY `fk_modu_rol_idx` (`rol_id`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`permi_codigo`),
  ADD KEY `fk_permi_usu_idx` (`usu_codigo`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`),
  ADD KEY `xi_rol_des` (`rol_des`);

--
-- Indices de la tabla `seguro`
--
ALTER TABLE `seguro`
  ADD PRIMARY KEY (`seguro_id`);

--
-- Indices de la tabla `tipo_concepto`
--
ALTER TABLE `tipo_concepto`
  ADD PRIMARY KEY (`tipoconcepto_codigo`);

--
-- Indices de la tabla `tipo_contrato`
--
ALTER TABLE `tipo_contrato`
  ADD PRIMARY KEY (`tipocon_codigo`) USING BTREE;

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`trabajador_cod`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_codigo`),
  ADD KEY `ss` (`fecha_ultimo_intento`),
  ADD KEY `trabajador_cod` (`trabajador_cod`);

--
-- Indices de la tabla `usurol`
--
ALTER TABLE `usurol`
  ADD PRIMARY KEY (`usrol_id`),
  ADD KEY `fk_usrol_usu_idx` (`usu_id`),
  ADD KEY `fk_usrol_rol_idx` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area_trabajo`
--
ALTER TABLE `area_trabajo`
  MODIFY `area_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `cargo_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `concepto_fijo`
--
ALTER TABLE `concepto_fijo`
  MODIFY `conceptofijo_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `contrato_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `con_modalidad_pago`
--
ALTER TABLE `con_modalidad_pago`
  MODIFY `tipag_codigo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo autogenerado, identificador de la tabla Modalidad de pago', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `documento_trabajador`
--
ALTER TABLE `documento_trabajador`
  MODIFY `documento_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `familiar`
--
ALTER TABLE `familiar`
  MODIFY `familiar_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `medio_comunicacion`
--
ALTER TABLE `medio_comunicacion`
  MODIFY `medioco_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `modu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `permi_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `seguro`
--
ALTER TABLE `seguro`
  MODIFY `seguro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_concepto`
--
ALTER TABLE `tipo_concepto`
  MODIFY `tipoconcepto_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_contrato`
--
ALTER TABLE `tipo_contrato`
  MODIFY `tipocon_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  MODIFY `trabajador_cod` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador de la persona', AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usurol`
--
ALTER TABLE `usurol`
  MODIFY `usrol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `concepto_fijo`
--
ALTER TABLE `concepto_fijo`
  ADD CONSTRAINT `concepto_fijo_ibfk_1` FOREIGN KEY (`tipoconcepto_codigo`) REFERENCES `tipo_concepto` (`tipoconcepto_codigo`),
  ADD CONSTRAINT `concepto_fijo_ibfk_2` FOREIGN KEY (`contrato_codigo`) REFERENCES `contrato` (`contrato_codigo`);

--
-- Filtros para la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `contrato_ibfk_1` FOREIGN KEY (`cargo_codigo`) REFERENCES `cargo` (`cargo_codigo`),
  ADD CONSTRAINT `contrato_ibfk_2` FOREIGN KEY (`area_codigo`) REFERENCES `area_trabajo` (`area_codigo`),
  ADD CONSTRAINT `contrato_ibfk_3` FOREIGN KEY (`seguro_id`) REFERENCES `seguro` (`seguro_id`),
  ADD CONSTRAINT `contrato_ibfk_4` FOREIGN KEY (`trabajador_cod`) REFERENCES `trabajador` (`trabajador_cod`),
  ADD CONSTRAINT `contrato_ibfk_5` FOREIGN KEY (`tipocon_codigo`) REFERENCES `tipo_contrato` (`tipocon_codigo`);

--
-- Filtros para la tabla `documento_trabajador`
--
ALTER TABLE `documento_trabajador`
  ADD CONSTRAINT `documento_trabajador_ibfk_1` FOREIGN KEY (`trabajador_cod`) REFERENCES `trabajador` (`trabajador_cod`);

--
-- Filtros para la tabla `medio_comunicacion`
--
ALTER TABLE `medio_comunicacion`
  ADD CONSTRAINT `medio_comunicacion_ibfk_1` FOREIGN KEY (`trabajador_cod`) REFERENCES `trabajador` (`trabajador_cod`);

--
-- Filtros para la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD CONSTRAINT `fk_modu_rol` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `fk_permi_usu` FOREIGN KEY (`usu_codigo`) REFERENCES `usuario` (`usu_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`trabajador_cod`) REFERENCES `trabajador` (`trabajador_cod`);

--
-- Filtros para la tabla `usurol`
--
ALTER TABLE `usurol`
  ADD CONSTRAINT `usurol_ibfk_1` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_codigo`),
  ADD CONSTRAINT `usurol_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
