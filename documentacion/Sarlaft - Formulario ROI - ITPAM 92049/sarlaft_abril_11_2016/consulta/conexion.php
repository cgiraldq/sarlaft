<?php
//Conexión al servidor
$Conn = mssql_connect('NET-DSQL04\GI', 'usSarlarftWeb', 'Dk7lb4PBz4pRWMgIOIpk') or die("No se puede conectar a la BD");
$db= mssql_select_db('Portal_GI',$Conn);
//$consulta= mssql_query("select GETDATE ( ) as fecha;");
//$resultado=mssql_fetch_array($consulta);
if($Conn) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r(mssql_get_last_message(), true));
}

//Llamado a función - Prueba
//ConsultaAplicacion_Servicio($Conn,12);
ConsultaAplicacion_Framework($Conn,1);

/*Mostrar en la consulta la Cantidad de almacenamiento asociado a SPLUNK separado por bd y aplicaciones (Aplicacion-Servidor), 
  indicar size (tamaño),  fabricante (EMC y NETAPP), caja de almacenamiento, nivel y tipo de datos.*/
function ConsultaServidor_BD($conn){
	 /* Query que nos mostrara el usuario con el que nos hemos conectado a la base de datos. */
	$consulta = "SELECT c.nombre BD_Servidor, a.size Tamaño, a.fabricante, a.caja_almacenamiento, 
				a.nivel_almacenamiento, a.tipo_datos, a.id_almacenamiento, e.nombre Aplicacion, f.nombre Servicio
				FROM [InventarioIDC].[dbo].[tbl2_almacenamiento] A,
				[InventarioIDC].[dbo].[tbl2_almacenamiento_bd] B,
				[InventarioIDC].[dbo].[tbl2_basesdatos] C,
				[InventarioIDC].[dbo].[tbl2_bd_app] D,
				[InventarioIDC].[dbo].[tbl2_aplicacion] E,
				[InventarioIDC].[dbo].[tbl2_servicio] F 
				WHERE a.id_almacenamiento = b.id_almacenamiento
				AND c.id_bd = b.id_bd
				AND c.id_bd = d.id_bd
				AND e.id_aplicacion = d.id_aplicacion
				AND e.id_servicio = f.id_servicio
				--AND e.id_servicio = 15
				UNION ALL
				SELECT c.nombre BD_Servidor, a.size Tamaño, a.fabricante, a.caja_almacenamiento, 
				 a.nivel_almacenamiento, a.tipo_datos, a.id_almacenamiento, e.nombre Aplicacion, f.nombre Servicio
				FROM [InventarioIDC].[dbo].[tbl2_almacenamiento] A,
				[InventarioIDC].[dbo].[tbl2_almacenamiento_servidor] B,
				[InventarioIDC].[dbo].[tbl2_servidor] C,
				[InventarioIDC].[dbo].[tbl2_servidor_app] D,
				[InventarioIDC].[dbo].[tbl2_aplicacion] E,
				[InventarioIDC].[dbo].[tbl2_servicio] F
				WHERE a.id_almacenamiento = b.id_almacenamiento
				AND c.id_servidor = b.id_servidor
				AND c.id_servidor = d.id_servidor
				AND e.id_aplicacion = d.id_aplicacion
				AND e.id_servicio = f.id_servicio
				--AND e.id_servicio = 15
				ORDER BY a.id_almacenamiento";
	$resultado = mssql_query( $consulta);
	$i=0;
	while($usuarios =  mssql_fetch_array($resultado)) {
		echo("Nombre: " .$usuarios["nombre"])."<br\n>";
		$i++;
	}
	if( $resultado === false ){
		echo "Error al ejecutar consulta.</br>";
		die( print_r( mssql_get_last_message(), true));
	}
	return $usuarios;
 }

/*Consulta que muestra Nombre, tipo de aplicacion, motor, framework, licencia, criticidad y OC de instalación de las 
  aplicaciones que estan asociadas al servicio SPLUNK (mostrar nombre del servicio, responsable tecnico del servicio y fecha de creación del servicio)*/
function ConsultaAplicacion_Servicio($conn,$servicio){
	 /* Query que nos mostrara el usuario con el que nos hemos conectado a la base de datos. */
	$consulta = "SELECT a.nombre, b.nombre Tipo_Servicio, c.nombre Tipo_Motor, d.nombre Framework, a.licencia, b.responsable_tecnico Responsable_Servicio, b.fechacreacion Fecha_Servicio
			FROM [InventarioIDC].[dbo].[tbl2_aplicacion] A,
			[InventarioIDC].[dbo].[tbl2_servicio] B,
			[InventarioIDC].[dbo].[tbl2_motor_app] C,
			[InventarioIDC].[dbo].[tbl2_framework] D
			WHERE a.id_servicio = b.id_servicio
			AND a.id_motor_app = c.id_motor_app
			AND a.id_framework = d.id_framework
			AND a.id_servicio = $servicio --(Splunk);";
	$resultado = mssql_query($consulta);
	$i=0;
	//var_dump($resultado);
	while($usuarios =  mssql_fetch_array($resultado)) {
		echo("Nombre: " .$usuarios["nombre"])."<br\n>";
		$i++;
	}
	if( $resultado === false ){
		echo "Error al ejecutar consulta.</br>";
		die( print_r( mssql_get_last_message(), true));
	}
	return $usuarios;
 }
/*Consulta para mostrar el Nombre de aplicaciones desarrolladas en framework Laravel con licencia entreprise.*/
 function ConsultaAplicacion_Framework($conn,$framework){
	 /* Query que nos mostrara el usuario con el que nos hemos conectado a la base de datos. */
	$consulta = "SELECT a.nombre Aplicacion, b.nombre Framework, b.licencia 
		FROM [InventarioIDC].[dbo].[tbl2_aplicacion] A,
		[InventarioIDC].[dbo].[tbl2_framework] B
		WHERE A.id_framework = B.id_framework AND B.id_framework = $framework";
	$resultado = mssql_query($consulta);
	$i=0;
	//var_dump($resultado);
	while($usuarios =  mssql_fetch_array($resultado)) {
		echo("Aplicación: " .$usuarios["Aplicacion"])."<br\n>";
		echo $i;
		$i++;
	}
	if( $resultado === false ){
		echo "Error al ejecutar consulta.</br>";
		die( print_r( mssql_get_last_message(), true));
	}
	return $usuarios;
 }
//

 function ConsultaAplicacion_Servicio_BD($conn){
	 /* Query que nos mostrara el usuario con el que nos hemos conectado a la base de datos. */
	$consulta = "SELECT B.nombre Base_de_Datos, C.nombre Instancia, C.ambiente Ambiente_Instancia, D.nombre Motor_Instancia, 
				D.fabricante Fabricante, D.clase Clase_Instancia, D.licencia Licencia_Instancia, 
				F.nombre Nombre_Servicio, G.nombre Aplicación
				FROM [InventarioIDC].[dbo].[tbl2_bd_instancia] A,
				[InventarioIDC].[dbo].[tbl2_basesdatos] B,
				[InventarioIDC].[dbo].[tbl2_instancia] C,
				[InventarioIDC].[dbo].[tbl2_motor_bd] D,
				[InventarioIDC].[dbo].[tbl2_bd_app] E,
				[InventarioIDC].[dbo].[tbl2_servicio] F,
				[InventarioIDC].[dbo].[tbl2_aplicacion] G
				WHERE A.id_bd = B.id_bd
				AND A.id_instancia = C.id_instancia
				AND C.id_motor_bd = D.id_motor_bd
				AND B.id_bd = E.id_bd
				AND E.id_aplicacion = G.id_aplicacion
				AND F.id_servicio = G.id_servicio";
	$resultado = mssql_query($conn, $consulta);
	$i=0;
	while($usuarios =  mssql_fetch_array($resultado)) {
		echo("Nombre: " .$usuarios["Aplicación"])."<br\n>";
		$i++;
	}
	if( $resultado === false ){
		echo "Error al ejecutar consulta.</br>";
		die( print_r( mssql_get_last_message(), true));
	}
	return $usuarios;
 }


function ConsultaCluster_Servidor($conn){
 /* Query que nos mostrara el usuario con el que nos hemos conectado a la base de datos. */
	$consulta = "SELECT C.nombre Servidor, c.serial Serial_Servidor, e.nombre_vlan
		FROM [InventarioIDC].[dbo].[tbl2_cluster_virtualizacion] A,
		[InventarioIDC].[dbo].[tbl2_servidor_cluster] B,
		[InventarioIDC].[dbo].[tbl2_servidor] C,
		[InventarioIDC].[dbo].[tbl2_servidor_vlan] D,
		[InventarioIDC].[dbo].[tbl2_vlan] E
		WHERE a.id_cluster_virtualizacion = b.id_cluster_virtualizacion
		AND b.id_servidor = c.id_servidor
		AND C.id_servidor = D.id_servidor
		AND d.id_vlan = e.id_vlan
		AND a.id_cluster_virtualizacion IN (10,11)";
	$resultado = mssql_query( $consulta);
	$i=0;
	while($usuarios =  mssql_fetch_array($resultado)) {
		echo("Servidor: " .$usuarios["Bases_Datos"])."<br\n>";
		$i++;
	}
	if( $resultado === false ){
		echo "Error al ejecutar consulta.</br>";
		die( print_r( mssql_get_last_message(), true));
	}
	return $usuarios;
}

/*Consulta para mostrar las bases de datos que hay en la instancia MSALUD2
(mostrar nombre de las bases de datos, nombre de la instancia, ambiente, motor, licencia).*/

function ConsultaInstancia_BD($conn){
 /* Query que nos mostrara el usuario con el que nos hemos conectado a la base de datos. */
	$consulta = "SELECT C.nombre Servidor, c.serial Serial_Servidor, e.nombre_vlan
		FROM [InventarioIDC].[dbo].[tbl2_cluster_virtualizacion] A,
		[InventarioIDC].[dbo].[tbl2_servidor_cluster] B,
		[InventarioIDC].[dbo].[tbl2_servidor] C,
		[InventarioIDC].[dbo].[tbl2_servidor_vlan] D,
		[InventarioIDC].[dbo].[tbl2_vlan] E
		WHERE a.id_cluster_virtualizacion = b.id_cluster_virtualizacion
		AND b.id_servidor = c.id_servidor
		AND C.id_servidor = D.id_servidor
		AND d.id_vlan = e.id_vlan
		AND a.id_cluster_virtualizacion IN (10,11)";
	$resultado = mssql_query( $consulta);
	$i=0;
	while($usuarios =  mssql_fetch_array($resultado)) {
		echo("Servidor: " .$usuarios["Bases_Datos"])."<br\n>";
		$i++;
	}
	if( $resultado === false ){
		echo "Error al ejecutar consulta.</br>";
		die( print_r( mssql_get_last_message(), true));
	}
	return $usuarios;
}

/*Consulta para mostrar las instancias con motor ORacle 11g en ambiente de producción. 
  (mostrar nombre instancias, motor, licencia, ambiente)*/
  
function ConsultaInstancia_MotorBD($conn){
 /* Query que nos mostrara el usuario con el que nos hemos conectado a la base de datos. */
	$consulta = "SELECT A.nombre Instancia, b.nombre, b.licencia, a.ambiente
		FROM [InventarioIDC].[dbo].[tbl2_instancia] A,
		[InventarioIDC].[dbo].[tbl2_motor_bd] B
		WHERE a.id_motor_bd = b.id_motor_bd
		AND a.id_motor_bd = 9
		AND a.ambiente = 'Produccion'";
	$resultado = mssql_query( $consulta);
	$i=0;
	while($usuarios =  mssql_fetch_array($resultado)) {
		echo("Instancia: " .$usuarios["Instancia"])."<br\n>";
		$i++;
	}
	if( $resultado === false ){
		echo "Error al ejecutar consulta.</br>";
		die( print_r( mssql_get_last_message(), true));
	}
	return $usuarios;
}

/*Consulta para mostrar los servidores de bases de datos(Instancias) 
  (mostrar nombre del servidor, serial y vlan)*/

function ConsultaBD_Servidor_Instancia($conn){
 /* Query que nos mostrara el usuario con el que nos hemos conectado a la base de datos. */
	$consulta = "SELECT b.nombre Servidor, b.serial, e.nombre_vlan
				FROM [InventarioIDC].[dbo].[tbl2_servidor_instancia] A,
				[InventarioIDC].[dbo].[tbl2_servidor] B,
				[InventarioIDC].[dbo].[tbl2_instancia] C,
				[InventarioIDC].[dbo].[tbl2_servidor_vlan] D,
				[InventarioIDC].[dbo].[tbl2_vlan] E
				WHERE a.id_instancia = c.id_instancia
				AND a.id_servidor = b.id_servidor 
				AND b.id_servidor = d.id_servidor
				AND e.id_vlan = d.id_vlan
				--AND a.id_instancia = 10";
	$resultado = mssql_query( $consulta);
	$i=0;
	while($usuarios =  mssql_fetch_array($resultado)) {
		echo("Servidor: " .$usuarios["Servidor"])."<br\n>";
		$i++;
	}
	if( $resultado === false ){
		echo "Error al ejecutar consulta.</br>";
		die( print_r( mssql_get_last_message(), true));
	}
	return $usuarios;
}
/*Consulta que muestra - Nombre, serial, dirección IP de servicio, datacenter, fabricante, 
  S.O (nombre y edición), OC de instalación, 
  tipo de servidor y Responsable tecnico de servidores asociados al servicio de SPLUNK*/

function ConsultaBD_Servidor_Servicio($conn){
 /* Query que nos mostrara el usuario con el que nos hemos conectado a la base de datos. */
	$consulta = "SELECT a.nombre Servidor, a.serial Serial, a.ip_servicio Direccion_IP_Servicio, a.ubicación_datacenter DataCenter, 
				a.fabricante Fabricante, a.SO_Clase Sistema_Operativo, a.SO_edicion Edición, a.OC_Instalacion, 
				a.tipo_servidor Tipo_Servidor, a.responsable_tecnico, d.nombre Servicio
				FROM [InventarioIDC].[dbo].[tbl2_servidor] A,
				[InventarioIDC].[dbo].[tbl2_servidor_app] B,
				[InventarioIDC].[dbo].[tbl2_aplicacion] C,
				[InventarioIDC].[dbo].[tbl2_servicio] D
				WHERE a.id_servidor = b.id_servidor
				AND c.id_aplicacion = b.id_aplicacion   
				AND c.id_servicio = d.id_servicio
				--AND c.id_servicio = 15";
	$resultado = mssql_query( $consulta);
	$i=0;
	while($usuarios = l($resultado)) {
		echo("Servidor: " .$usuarios["Servidor"])."<br\n>";
		$i++;
	}
	if( $resultado === false ){
		echo "Error al ejecutar consulta.</br>";
		die( print_r( mssql_get_last_message(), true));
	}
	return $usuarios;
}

/* Cerramos la conexión, muy importante. */
mssql_close( $conn);
?>