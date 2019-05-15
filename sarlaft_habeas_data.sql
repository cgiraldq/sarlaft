/*
Navicat MySQL Data Transfer

Source Server         : sarlaft dllo
Source Server Version : 50512
Source Host           : MySQLPortDllo.une.net.co:3306
Source Database       : dbsarlaft

Target Server Type    : MYSQL
Target Server Version : 50512
File Encoding         : 65001

Date: 2017-05-08 17:12:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_formulario_hdata
-- ----------------------------
DROP TABLE IF EXISTS `tbl_formulario_hdata`;
CREATE TABLE `tbl_formulario_hdata` (
  `hdata_id` int(10) NOT NULL AUTO_INCREMENT,
  `hdata_radicado` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hdata_empresa_id` int(10) DEFAULT NULL,
  `hdata_tipo_identificacion_id` int(10) DEFAULT NULL,
  `hdata_identificacion_persona` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hdata_nombre_persona` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `hdata_vicepresidencia` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hdata_area` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hdata_cargo` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hdata_pais_id` int(10) DEFAULT NULL,
  `hdata_departamento_id` int(10) DEFAULT NULL,
  `hdata_ciudad_id` int(10) DEFAULT NULL,
  `hdata_email` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hdata_telefono` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hdata_fecha_declaracion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `hdata_estado_id` int(10) DEFAULT NULL,
  `hdata_usuario` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hdata_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hdata_usuario_id` int(10) DEFAULT NULL,
  `creadopor` int(10) DEFAULT NULL,
  `fechacreacion` datetime DEFAULT NULL,
  `modificadopor` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechamodificacion` datetime DEFAULT NULL,
  `hdata_visitante` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`hdata_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO tbl_reports VALUES (79, 'Habeas Data', 'Habeas Data', NULL, NULL, 'tbl_formulario_hdata', 'hdata_id', NULL, NULL, NULL, 1, 1, 99, 0, 1, 0, 0, NULL, 1, 'LMC9xGnDFhg=', '2017-5-8 16:01:42', NULL, NULL);




INSERT INTO `tbl_reports_fields` (
	`field_id`,
	`report_id`,
	`table_field`,
	`field`,
	`alias`,
	`label`,
	`field_find`,
	`align`,
	`field_type_id`,
	`option_list`,
	`select_sql`,
	`field_id_list`,
	`field_desc_list`,
	`select_complex`,
	`function_aggregate`,
	`foreign_table`,
	`foreign_table_field_id`,
	`foreign_table_desc`,
	`select_filter`,
	`comparison`,
	`order_by`,
	`group_by`,
	`show_in_grid`,
	`group_header`,
	`group_header_columns`,
	`frozen_column`,
	`order_field`,
	`width_column`,
	`field_where`,
	`editable`,
	`required`,
	`formatter`,
	`format_options`,
	`edit_options`,
	`summary_type`,
	`summary_tpl`,
	`formoptions`,
	`editrules`,
	`search`,
	`searchrules`,
	`creadopor`,
	`fechacreacion`,
	`modificadopor`,
	`fechamodificacion`
)
VALUES ('', 79, 'tbl_formulario_hdata', 'hdata_nombre_persona', 'hdata_nombre_persona', 'Persona', '', '', 2, '', '', '', '', 0, '', '', '', '', '', 'eq', '', 0, 1, '', 0, 0, 7, 190, 0, 0, 0, '', '', '', '', '', '', '', 1, '', '', '0000-0-0 00:00:00', '', '0000-0-0 00:00:00') ,
 ('', 79, 'tbl_formulario_hdata', 'hdata_radicado', 'hdata_radicado', 'Radicado', '', '', 2, '', '', '', '', 0, '', '', '', '', '', 'eq', '', 0, 1, '', 0, 0, 1, 120, 0, 0, 0, '', '', '', '', '', '', '', 1, '', '', '0000-0-0 00:00:00', '', '0000-0-0 00:00:00') ,
 ('', 79, 'tbl_formulario_hdata', 'hdata_empresa_id', 'hdata_empresa_id', 'Empresa', '', '', 10, '', 'select emp_id, emp_nombre from tbl_empresa', 'emp_id', 'emp_nombre', 0, '', 'tbl_empresa', 'emp_id', 'emp_nombre', 'select emp_id, emp_nombre from tbl_empresa', 'eq', '', 0, 1, '', 0, 0, 2, 100, 0, 0, 0, '', '', '', '', '', '', '', 1, '', '', '0000-0-0 00:00:00', '', '0000-0-0 00:00:00') ,
 ('', 79, 'tbl_formulario_hdata', 'hdata_ciudad_id', 'hdata_ciudad_id', 'Ciudad', '', '', 10, '', 'select ciu_id, ciu_nombre from tbl_ciudad', 'ciu_id', 'ciu_nombre', 0, '', 'tbl_ciudad', 'ciu_id', 'ciu_nombre', 'select ciu_id, ciu_nombre from tbl_ciudad', 'eq', '', 0, 1, '', 0, 0, 9, 120, 0, 0, 0, '', '', '', '', '', '', '', 1, '', '', '0000-0-0 00:00:00', '', '0000-0-0 00:00:00') ,
 ('', 79, 'tbl_formulario_hdata', 'hdata_estado_id', 'hdata_estado_id', 'Estado', '', '', 10, '', 'select est_id, est_nombre from tbl_estado', 'est_id', 'est_nombre', 0, '', 'tbl_estado', 'est_id', 'est_nombre', 'select est_id, est_nombre from tbl_estado', 'eq', '', 0, 1, '', 0, 0, 0, 100, 0, 1, 0, '', '', '', '', '', '', '', 1, '', '', '0000-0-0 00:00:00', '', '0000-0-0 00:00:00') ,
 ('', 79, 'tbl_formulario_hdata', 'hdata_fecha_declaracion', 'hdata_fecha_declaracion', 'Fecha declaracion', '', 'left', 1, '', '', '', '', 0, '', '', '', '', '', '', '', 0, 1, '', 0, 0, 20, 90, 0, 0, 0, '', '', '', '', '', '', '', 1, '', '', '0000-0-0 00:00:00', '', '0000-0-0 00:00:00') ,
 ('', 79, 'tbl_formulario_hdata', 'hdata_email', 'hdata_email', 'Email', '', '', 2, '', '', '', '', 0, '', '', '', '', '', 'eq', '', 0, 1, '', 0, 0, 7, 190, 0, 0, 0, '', '', '', '', '', '', '', 1, '', '', '0000-0-0 00:00:00', '', '0000-0-0 00:00:00') ,
 ('', 79, 'tbl_formulario_hdata', 'hdata_telefono', 'hdata_telefono', 'Telefono', '', '', 2, '', '', '', '', 0, '', '', '', '', '', 'eq', '', 0, 1, '', 0, 0, 7, 190, 0, 0, 0, '', '', '', '', '', '', '', 1, '', '', '0000-0-0 00:00:00', '', '0000-0-0 00:00:00') ,
 ('', 79, 'tbl_formulario_hdata', 'hdata_identificacion_persona', 'hdata_identificacion_persona', 'Identificación declarante', '', '', 2, '', '', '', '', 0, '', '', '', '', '', 'eq', '', 0, 1, '', 0, 0, 6, 170, 0, 0, 0, '', '', '', '', '', '', '', 1, '', '', '0000-0-0 00:00:00', '', '0000-0-0 00:00:00') ,
 ('', 79, 'tbl_formulario_hdata', 'hdata_visitante', 'hdata_visitante', 'Datos visitante', '', '', 17, '', '', '', '', NULL, '', '', '', '', '', '', '', 0, 1, '', 0, 0, 40, 120, 0, 0, 0, '', '', '', '', '', '', '', 0, '', '', '0000-0-0 00:00:00', '', '0000-0-0 00:00:00') ,
 ('', 79, 'tbl_formulario_hdata', 'fechacreacion', 'fechacreacion', 'Fecha registro', '', 'left', 1, '', '', '', '', 0, '', '', '', '', '', '', 'ASC', 0, 1, '', 0, 0, 1, 90, 0, 0, 0, '', '', '', '', '', '', '', 1, '', '', '0000-0-0 00:00:00', '', '0000-0-0 00:00:00') ,
 ('', 79, 'tbl_formulario_hdata', 'hdata_vicepresidencia', 'hdata_vicepresidencia', 'Vicepresidencia', '', '', 2, '', '', '', '', 0, '', '', '', '', '', 'eq', '', 0, 1, '', 0, 0, 4, 190, 0, 0, 0, '', '', '', '', '', '', '', 1, '', '', '0000-0-0 00:00:00', '', '0000-0-0 00:00:00') ,
 ('', 79, 'tbl_formulario_hdata', 'hdata_area', 'hdata_area', 'Area', '', '', 2, '', '', '', '', 0, '', '', '', '', '', 'eq', '', 0, 1, '', 0, 0, 4, 190, 0, 0, 0, '', '', '', '', '', '', '', 1, '', '', '0000-0-0 00:00:00', '', '0000-0-0 00:00:00') ,
 ('', 79, 'tbl_formulario_hdata', 'hdata_cargo', 'hdata_cargo', 'Cargo', '', '', 2, '', '', '', '', 0, '', '', '', '', '', 'eq', '', 0, 1, '', 0, 0, 4, 190, 0, 0, 0, '', '', '', '', '', '', '', 1, '', '', '0000-0-0 00:00:00', '', '0000-0-0 00:00:00');


 INSERT INTO `tbl_reports_permissions_roles` (`id`, `report_id`, `rol`, `view_`, `insert_`, `edit`, `delete_`, `excel`, `pdf`, `word`, `txt`, `creadopor`, `fechacreacion`, `modificadopor`, `fechamodificacion`) VALUES ('135', '79', 'superadminsarlaft', '1', '1', '1', '1', '1', '1', '1', '1', 'cgiraldq', '2017-09-05 ', 'cgiraldq', '')