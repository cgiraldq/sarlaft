<?php

class FormularioController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/simple';
        public function beforeAction($action) {        
            return Yii::app()->sysSecurity->checkUser();            
        }
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	
	public function init() {
        /**
         * Evitar Cross Domain
         */
        header('Access-Control-Allow-Origin: ' . $_SERVER['SERVER_NAME']);
        header('X-Permitted-Cross-Domain-Policies: master-only');
        header('X-Content-Type-Options: nosniff');
        header('Strict-Transport-Security: max-age=15768000 ; includeSubDomains');
        header('Content-Type: text/html; charset=utf-8');
        header('X-Frame-Options:SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('X-Powered-By: what-should-we-put-over-here?');
    }

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{		
            return array(                    
                     array('allow', // allow authenticated user to perform 'create' and 'update' actions
                     'actions' => array('view','create','consulta', 'selectdepartamento', 'selectciudad', 'uploadprofileimage', 'showimage'),
                     'users' => array('*'),
                     ),
                    );
        }
	
	public function actionSendMail(){
	
		$to = array('jcadag@asesor.une.com.co');
		$mailResponse = particularFunction::sendEmail($to, 'pruebas desde sarlaft', '<h1>mensaje con texto html</h1>');
		var_dump($mailResponse);
	}

	
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        // $model = Formulario::model()->findByPk($_GET['id']);       
		// $model->update('tbl_formulario_consulta', array('consulta_radicado'=>$id), 'id=:id', array(':id'=>$id));

		if(isset($_SESSION['login_user_consulta']))
			unset($_SESSION['login_user_consulta']); 
		
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}    
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		
		if(isset($_GET['logout_user']) && $_GET['logout_user']=='1'){
			
			
			if(isset($_SESSION['login_user_consulta']))
				unset($_SESSION['login_user_consulta']); 

			$this->redirect(array('create','st'=>'1'));
				
		} elseif(isset($_SESSION['login_user_consulta'])) {
			
			$arrLog = array();
			
			// Se guarda los datos del visitante 
			$arrVisitante = array();
			$proxy = $_SERVER['REMOTE_ADDR'];
			$ip = $this->get_client_ip();
			$model=new Formulario;

			// Se obtienen datos de parámetros del formulario
			$id_par = 1;
			$row_parametros = Parametros::model()->findAll('par_id = :id_par',array(':id_par'=>$id_par));
			//var_dump($row_parametros);die;
			// Uncomment the following line if AJAX validation is needed
			$this->performAjaxValidation($model);
			

			if(isset($_POST['Formulario']))
			{
				$model->attributes=$_POST['Formulario'];
				
				// Asigno valores automáticos del registro
				$model->fechacreacion = date('Y-m-d H:i:s');
				$model->consulta_usuario = $_SESSION['login_user_consulta'];
				$model->consulta_ip = $ip;

				$msj = "";
				$env = 0;
				
				// Se define si se ingresó un archivo de consulta
				$path_file = PATH_UPLOAD_ARCHIVOS;		//ruta del archivo
				$model->farchivo=CUploadedFile::getInstance($model,'farchivo');

				// Si se ingresó un archivo de consulta
				if(isset($model->farchivo) && !empty($model->farchivo)) {
				
					// Se define el nombre con el que se guardará el archivo
					$fileNombre = 'consulta-'.time().'-'.$model->farchivo;  // numero aleatorio  + nombre de archivo             
					// $fileNombre = $this->limpiarCaracteresEspeciales($fileNombre);
					
					// Si el archivo que se ingresó contine una extensión válida (txt,csv)
					if($model->validate()) {
					
						// Se guarda el archivo en el servidor
						if($model->farchivo->saveAs($path_file.$fileNombre)) {
							
							$ruta_archivo = $path_file.$fileNombre;
											
							// Se abre el archivo en modo lectura
							$archivo = fopen($ruta_archivo, 'r')
							or exit("No se pudo abrir el archivo ($ruta_archivo)");
								
							$count = 0;
							
							// Ciclo para recorrer líneas del archivo 
							while (!feof($archivo)) 
							{
								$count++;
								$linea = str_replace("'", "", fgets($archivo));
								
								$arrLinea = explode(',', $linea);
								// print_r($arrLinea);
								$string = trim($arrLinea[0]); 
								$string = str_replace("\n", "", $string); 
								$string = str_replace("\r", "", $string); 
								$model->consulta_identificacion_persona = $string;
								
								$string = trim($arrLinea[1]); 
								$string = str_replace("\n", "", $string); 
								$string = str_replace("\r", "", $string); 
								$model->consulta_nombre_persona = $string;

								if($arrLinea[0]!="" && $arrLinea[1]!="") {
								
									$arrLog = array("Identificacion"=>$model->consulta_identificacion_persona, "Nombre"=>$model->consulta_nombre_persona, "IP"=>$ip);
									// $rs_tipo_identificacion = Tipo_identificacion::model()->findByPk($model->consulta_tipo_identificacion_id);

									if($model->save()) {
										
										$fechaActual = date('dmY');

										////////////////////////////////////////////////////////////////
										//////// INICIA INSERCIÓN EN TABLA SQL SERVER //////////////////
										
										$tabla = new TableWS('Web','http://unevm-tmap.une.net.co/WebServicesC/proxy/wsSARLAFT.php?wsdl');

										//insert:
										$tabla->Insert('TipoIdentificacion,Identificacion,Nombre,Usuario')->into('Web')
												->valores(array(
													'',
													$model->consulta_identificacion_persona,
													$model->consulta_nombre_persona,
													$model->consulta_usuario
										));
										if ($tabla->query()) {
											$env++;
											// echo $tabla->getErrores();
										}
										
										//////////// FIN INSERCIÓN EN TABLA SQL SERVER /////////////////
										////////////////////////////////////////////////////////////////
										
										// Se guarda el log de las acciones
										$jsonLog = json_encode($arrLog);
										
										Yii::log($jsonLog,"info","application.controllers.FormularioController");
									}
									
								} 
								// else {
									// $msj = "Los datos no fueron almacenados, vuelva a intentarlo";
								// }

								
							}
							
							// Se cierra el archivo
							fclose($archivo);

							
						} else {
							$msj = "El archivo \"".$model->farchivo."\" no se pudo cargar ";
						}
							
					} else {
						$msj = "El archivo \"".$model->farchivo."\" no es válido ";
					}
					
				} else {
					
					if ($model->validate()) {
						
						$arrLog = array("Identificacion"=>$model->consulta_identificacion_persona, "Nombre"=>$model->consulta_nombre_persona, "IP"=>$ip);
						// $rs_tipo_identificacion = Tipo_identificacion::model()->findByPk($model->consulta_tipo_identificacion_id);

						if($model->save()) {
							
							$fechaActual = date('dmY');

							////////////////////////////////////////////////////////////////
							//////// INICIA INSERCIÓN EN TABLA SQL SERVER //////////////////
							
							$tabla = new TableWS('Web','http://unevm-tmap.une.net.co/WebServicesC/proxy/wsSARLAFT.php?wsdl');

							//insert:
							$tabla->Insert('TipoIdentificacion,Identificacion,Nombre,Usuario')->into('Web')
									->valores(array(
										'',
										$model->consulta_identificacion_persona,
										$model->consulta_nombre_persona,
										$model->consulta_usuario
							));
							if ($tabla->query()) {
								$env = 1;
								// echo $tabla->getErrores();
							}
							
							//////////// FIN INSERCIÓN EN TABLA SQL SERVER /////////////////
							////////////////////////////////////////////////////////////////
							
							// Se guarda el log de las acciones
							$jsonLog = json_encode($arrLog);
							
							Yii::log($jsonLog,"info","application.controllers.FormularioController");
							
						} else {
							$msj = "Los datos no fueron almacenados, vuelva a intentarlo";
						}
							
					} else {
						$msj = "Los datos ingresados no son válidos, vuelva a intentarlo";
					}
					
					
				}
				
				$this->redirect(array('create','st'=>'1','env'=>$env,'msj'=>$msj));
				
			}

			if(isset($_GET['env']) && $_GET['env']!="") {
				$env = $_GET['env'];
			} else {
				$env = "";
			}

			if(isset($_GET['msj']) && $_GET['msj']!="") {
				$msj = $_GET['msj'];
			} else {
				$msj = "";
			}
			
			$this->render('create',array(
				'model'=>$model,
				'row_parametros'=>$row_parametros,
				'env'=>$env,
				'msj'=>$msj,
			));
		}
		else
		{
			// Se obtienen datos de parámetros del formulario
			$id_par = 1;
			$row_parametros = Parametros::model()->findAll('par_id = :id_par',array(':id_par'=>$id_par));
			
			$msjauth=''; // Variable To Store Error Message
			if (isset($_POST['loginForm']) && $_POST['loginForm']=='1') {
				
				if (empty($_POST['username']) || empty($_POST['password'])) {
					$msjauth = "Favor ingresar usuario y contraseña";
				}
				else
				{
				
		
					// Define $username and $password
					$username=$_POST['username'];
					
					$password=$_POST['password'];

					$wsdl = "http://unevm-tmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
					//$options = array("login" => _USERWSAGE_, "password" => _PASSWORDWSAGE_);	

					//Se reaaliza conexión con ws y se trae información de acuerdo al pedido pasado en el parametro
					$client = new SoapClient($wsdl);
					$parametros = array(
						'login' => $username,
						'password' => $password,
						'dominio' => 'epmtelco.com.co',
						'aplicacion' => 'Sarlaft',
						'password_app' => 'sarlaft2015'			
					);
					
					//":{"login":1,"password":2,"aplicacion":"webapp","password_app":"b6920d9083c8e76685bcc8db34b8c9bb
					
					try {
						$response = $client->AutenticarMultiplesDA($parametros);
						$response = json_decode($response->Mensaje,true);
						// echo "<pre>";
						// var_dump($response);
						// echo "</pre>";
						$auth = $response["wsResponse"][$username]["epmtelco.com.co"][0]["code"];
						$msj =  $response["wsResponse"][$username]["epmtelco.com.co"][0]["message"];
						// echo "<br>".$msj." - code: ".$auth;
					} catch (SoapFault $exception) {
						$msjauth = "Error de autenticación, vuelva a intentarlo";
					}
					
					// $obj = new stdObject();
					// $obj = $response;
						// print_r($obj);
					
					if (isset($auth) && $auth=='1') {
						// session_start(); // Starting Session
					
					$objmodel=new validar_usuario();
					//$username="freddy.vela";
	$validar=$objmodel->FindByAttributes(array('login_usuario'=>$username));
	/*echo "<pre>";
	var_dump($validar);
	echo "</pre>";*/
	
	
	  $resultado=sizeof($validar);
	 //$_SESSION['resultado']=$resultado;
						if( $resultado==1){
						$_SESSION['login_user_consulta']=$username; // Initializing Session
						$this->redirect(array('create','st'=>'1'));
						
						}else{
						$msjauth = "No tiene suficientes permisos para ingresar!";
						}
					} else {
						$msjauth = "Usuario y/o contraseña inválidos";
					}					
					
				}
			}	

			$this->render('create',array(
				'msjauth'=>$msjauth,
				'row_parametros'=>$row_parametros,
			));		

			// header("location: index.php?r=consulta/formulario/create&st=1");
			// $this->redirect(array('create','st'=>'1'));
		} 
		
	}



	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionConsulta()
	{
		$arrLog = array();
		
		$model=new Formulario;
		
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		////////////////////////////////////////////////////////////////
		//////// INICIA CONSULTA EN TABLA SQL SERVER ///////////////////
		
		$tabla = new TableWS('Web','http://unevm-tmap.une.net.co/WebServicesC/proxy/wsSARLAFT.php?wsdl');

		$tabla->Select('*')->from('Informe')
		->condicion('Sistema','=','Web')
		->condicion('EstadoWeb','=','1','and')
		->condicion('Usuario','=',$_SESSION['login_user_consulta'],'and')
		//->condicion('Web.EstadoWEb','!=','0','and')
	;
	
//var_dump($tabla);//die;
		$datos = $tabla->query();
		
		
				$tabla->Select('Web.Nombre,Web.Identificacion')->from('Web')
				//->join('Informe','left','Identificacion','Identificacion')
					->condicion('Web.Usuario','=',$_SESSION['login_user_consulta'])
							//->condicion('Web.Identificacion','!=','Informe.Identificacion')
								->condicion('Web.EstadoWeb','=','0','and')
	;
	
	$datos2 = $tabla->query();
		// echo "<pre>";
		// var_dump($datos);
		// echo "</pre>";
		
		///////////// FIN CONSULTA EN TABLA SQL SERVER /////////////////
		////////////////////////////////////////////////////////////////
		
					

		$this->render('consulta',array(
			'datos'=>$datos,
			'datos2'=>$datos2,
		));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Formulario the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Formulario::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'La página no existe.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Formulario $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='consulta-form')
		{
		
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}        
    
}
