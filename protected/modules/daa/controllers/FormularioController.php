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
		// $model->update('tbl_formulario_daa', array('daa_radicado'=>$id), 'id=:id', array(':id'=>$id));

		if(isset($_SESSION['login_user']))
			unset($_SESSION['login_user']); 
		
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
			
			
			if(isset($_SESSION['login_user']))
				unset($_SESSION['login_user']); 

			$this->redirect(array('create','st'=>'1'));
				
		} elseif(isset($_SESSION['login_user'])) {
			
			$arrLog = array();
			
			// Se guarda los datos del visitante 
			$arrVisitante = array();
			$proxy = $_SERVER['REMOTE_ADDR'];
			$ip = $this->get_client_ip();
			$browser = $_SERVER['HTTP_USER_AGENT'];
			$nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$dns = @gethostbyaddr($_SERVER["HTTP_X_FORWARDED_FOR"]);
			$host = @gethostbyaddr($HTTP_SERVER_VARS["REMOTE_ADDR"]);	
			$arrVisitante = array("Proxy"=>$proxy, "IP"=>$ip, "Navegador"=>$browser);
			$jsonVisitante = json_encode($arrVisitante);
			// Yii::log($jsonVisitante,"info","application.controllers.FormularioController");
		//	var_dump($_POST);die;
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
				
				// Asigno el formato de fecha correcto
				$model->daa_fecha_declaracion = date("Y-m-d",strtotime($model->daa_fecha_declaracion));
				$model->fechacreacion = date('Y-m-d H:i:s');
				
				$model->daa_certifica = $_POST["daa_certifica"];
				$model->daa_has_ofrecido = $_POST["justi1"];
				$model->daa_te_han_ofrecido = $_POST["justi2"];
				$model->daa_relacion_tigoune = $_POST["justi3"];
				//echo "<pre>";var_dump($_POST);die;
				if ($model->validate()) {
					
					$arrLog = array("Nombre"=>$model->daa_nombre, "Reportante"=>$model->daa_nombre, "Proxy"=>$proxy, "IP"=>$ip, "Navegador"=>$browser);
					
					$model_mail = array();
					// Se hace ciclo para asignar valores al array que armará el correo a enviar
					// No se asigna directamente el array ya que heredaría las propiedades del otro 
					// y no permitiría agregar los valores correspondientes a los campos que tienen el valor del id
					foreach($model as $campo=>$valor)
					{
						$model_mail[$campo] = utf8_decode($valor);
					}				
					
				
					
					// $rs_tipo_identificacion = Tipo_identificacion::model()->findByPk($model->daa_tipo_identificacion_id);
					// $model_mail['for_tipo_identificacion'] = utf8_decode($rs_tipo_identificacion['tid_nombre']);
					
					


					
					
					$model->daa_nombre = $this->cifrar($model->daa_nombre);
					$model->daa_vicepresidencia= $this->cifrar($model->daa_vicepresidencia);
					$model->daa_area= $this->cifrar($model->daa_area);
					$model->daa_cargo= $this->cifrar($model->daa_cargo);					
					//$model->daa_identificacion_persona = $this->cifrar($model->daa_identificacion_persona);
					$model->daa_email = $this->cifrar($model->daa_email);
					
					$model->creadopor = $this->cifrar($model->creadopor);
					$model->modificadopor = $this->cifrar($model->modificadopor);
					
				}

				if($model->save()) {
				
					
					$fechaActual = date('dmY');
					$idRadicado = (string) $model->daa_id;
					
					if(strlen($idRadicado)==1)
						$idRadicado = '000'.$idRadicado;
					elseif(strlen($idRadicado)==2)
						$idRadicado = '00'.$idRadicado;
					elseif(strlen($idRadicado)==3)
						$idRadicado = '0'.$idRadicado;
					
					$model->daa_radicado = 'A&A-'.$fechaActual.'-'.$idRadicado;
					// $radicado = $this->cifrar($radicado);
					Formulario::model()->updateByPk($model->daa_id, array('daa_radicado'=>$model->daa_radicado));

					$model_mail['daa_radicado'] = $model->daa_radicado;
					
					// Se guarda los datos del visitante 
					$model->daa_visitante = $this->cifrar($jsonVisitante);
					Formulario::model()->updateByPk($model->daa_id, array('daa_visitante'=>$model->daa_visitante));
					
					// Se envía por correo
					if($row_parametros[0]['par_envio_correo']==1) {
						// Yii::app()->enviar_correo($row_parametros[0]['par_correo']);
						// $to = array('jnavarrm@asesor.une.com.co','jcadag@asesor.une.com.co');
						// $to = array($row_parametros[0]['par_correo']);
						// $contenidoResponse = particularFunction::contentEmail($model_mail);
						// $contenidoResponse = utf8_encode($contenidoResponse);
						// $mailResponse = particularFunction::sendEmail($to, 'Reporte Formulario Código de Ética', $contenidoResponse);					
					}
					
					// Se guarda el log de las acciones
					$jsonLog = json_encode($arrLog);
					
					
					Yii::log($jsonLog,"info","application.controllers.FormularioController");
					$this->redirect(array('view','id'=>$model->daa_id));
				}
			}

			$this->render('create',array(
				'model'=>$model,
				'row_parametros'=>$row_parametros,
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

				//$wsdl = "http://unevm-dmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
				//$wsdl = "http://unevm-tmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
				$wsdl = "http://unevm-pmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
					//$options = array("login" => _USERWSAGE_, "password" => _PASSWORDWSAGE_);	

					//Se reaaliza conexión con ws y se trae información de acuerdo al pedido pasado en el parametro
					$client = new SoapClient($wsdl);
					$parametros = array(
						'login' => $username,
						'password' => $password,
						'dominio' => '',
						'aplicacion' => 'Sarlaft',
						'password_app' => 'sarlaft2015'			
					);
					
					//":{"login":1,"password":2,"aplicacion":"webapp","password_app":"b6920d9083c8e76685bcc8db34b8c9bb
					
					try {
						$response = $client->AutenticarMultiplesDA($parametros);
						 $response = json_decode($response->CodRespuesta,true);
						//echo $response;die;
						// echo "<pre>";
						// var_dump($response);
						// echo "</pre>";
						//echo $auth = $response["wsResponse"][$username]["epmtelco.com.co"][0]["code"];die;
						 $auth =$response;
						$msj =  $response["wsResponse"][$username]["epmtelco.com.co"][0]["message"];
						// echo "<br>".$msj." - code: ".$auth;
					} catch (SoapFault $exception) {
						$msjauth = "Error de autenticación, vuelva a intentarlo";
					}
					
					// $obj = new stdObject();
					// $obj = $response;
						//$auth=1;// print_r($obj);
					
					if (isset($auth) && $auth=='1') {
						// session_start(); // Starting Session
						$_SESSION['login_user']=$username; 
						$_SESSION['password']=$password; // Initializing Session
						$this->redirect(array('create','st'=>'1'));
					} else {
						 $msjauth = "Usuario y/o contraseña inválidos";
					}					
					
				}
			}	

			$this->render('create',array(
				'msjauth'=>$msjauth,
				'row_parametros'=>$row_parametros,
			));		

			// header("location: index.php?r=daa/formulario/create&st=1");
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
		
		// Se guarda los datos del visitante 
		$arrVisitante = array();
		$proxy = $_SERVER['REMOTE_ADDR'];
		$ip = $this->get_client_ip();
		$browser = $_SERVER['HTTP_USER_AGENT'];
		$nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		$dns = @gethostbyaddr($_SERVER["HTTP_X_FORWARDED_FOR"]);
		$host = @gethostbyaddr($HTTP_SERVER_VARS["REMOTE_ADDR"]);	
		$arrVisitante = array("Proxy"=>$proxy, "IP"=>$ip, "Navegador"=>$browser);
		$jsonVisitante = json_encode($arrVisitante);
		// Yii::log($jsonVisitante,"info","application.controllers.FormularioController");
		
		$model=new Formulario;
		
		// Se obtienen datos de parámetros del formulario
		$id_par = 1;
		$row_parametros = Parametros::model()->findAll('par_id = :id_par',array(':id_par'=>$id_par));
		
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Formulario']))
		{
			$model->attributes=$_POST['Formulario'];

			// Asigno el formato de fecha correcto
			$model->daa_fecha_declaracion = date("Y-m-d",strtotime($model->daa_fecha_declaracion));
			$model->fechacreacion = date('Y-m-d H:i:s');
			
			if ($model->validate()) {
				
				$arrLog = array("Nombre"=>$model->daa_nombre, "Reportante"=>$model->daa_nombre, "Proxy"=>$proxy, "IP"=>$ip, "Navegador"=>$browser);
				
				$model_mail = array();
				// Se hace ciclo para asignar valores al array que armará el correo a enviar
				// No se asigna directamente el array ya que heredaría las propiedades del otro 
				// y no permitiría agregar los valores correspondientes a los campos que tienen el valor del id
				foreach($model as $campo=>$valor)
				{
					$model_mail[$campo] = utf8_decode($valor);
				}				
				
				// $model->daa_nombre_persona = $this->cifrar($model->daa_nombre_persona);
				// $model->creadopor = $this->cifrar($model->creadopor);
				// $model->modificadopor = $this->cifrar($model->modificadopor);
			}
			
			if($model->save()) {
				$fechaActual = date('dmY');
				$idRadicado = (string) $model->daa_id;
				
				if(strlen($idRadicado)==1)
					$idRadicado = '000'.$idRadicado;
				elseif(strlen($idRadicado)==2)
					$idRadicado = '00'.$idRadicado;
				elseif(strlen($idRadicado)==3)
					$idRadicado = '0'.$idRadicado;
				
				$model->daa_radicado = 'A&A-'.$fechaActual.'-'.$idRadicado;
				// $radicado = $this->cifrar($radicado);
				Formulario::model()->updateByPk($model->daa_id, array('daa_radicado'=>$model->daa_radicado));

				$model_mail['daa_radicado'] = $model->daa_radicado;
				
				// Se guarda los datos del visitante 
				$model->daa_visitante = $this->cifrar($jsonVisitante);
				Formulario::model()->updateByPk($model->daa_id, array('daa_visitante'=>$model->daa_visitante));
				
				// Se envía por correo
				if($row_parametros[0]['par_envio_correo']==1 && false) {
					// Yii::app()->enviar_correo($row_parametros[0]['par_correo']);
					// $to = array('jnavarrm@asesor.une.com.co','jcadag@asesor.une.com.co');
					$to = array($row_parametros[0]['par_correo']);
					$contenidoResponse = particularFunction::contentEmail($model_mail);
					$contenidoResponse = utf8_encode($contenidoResponse);
					$mailResponse = particularFunction::sendEmail($to, 'Reporte Formulario Código de Ética', $contenidoResponse);					
				}
				
				// Se guarda el log de las acciones
				$jsonLog = json_encode($arrLog);
				Yii::log($jsonLog,"info","application.controllers.FormularioController");
				$this->redirect(array('view','id'=>$model->daa_id));
			}
		}

		$this->render('consulta',array(
			'model'=>$model,
			'row_parametros'=>$row_parametros,
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='daa-form')
		{
		
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}        

	public function actionSelectdepartamento()
	{
		$id_pais = $_POST['Formulario']['daa_pais_id'];
		$lista = Departamento::model()->findAll('dep_pais_id = :id_pais',array(':id_pais'=>$id_pais));
		$lista = CHtml::listData($lista,'dep_id','dep_nombre');
		
		echo CHtml::tag('option',array('value'=>''), '--Seleccione--', true);
		
		foreach ($lista as $valor => $descripcion) {
			echo CHtml::tag('option',array('value'=>$valor), CHtml::encode($descripcion), true);
		}
	}

	public function actionSelectciudad()
	{
		$id_dep = $_POST['Formulario']['daa_departamento_id'];
		$lista = Ciudad::model()->findAll('ciud_departamento_id = :id_dep',array(':id_dep'=>$id_dep)); //array('order'=>'ciu_nombre')
		$lista = CHtml::listData($lista,'ciu_id','ciu_nombre');
		
		echo CHtml::tag('option',array('value'=>''), '--Seleccione--', true);
		
		foreach ($lista as $valor => $descripcion) {
			echo CHtml::tag('option',array('value'=>$valor), CHtml::encode($descripcion), true);
		}
	}

    
    /*
     * Método para subir la foto de perfil del usuario en sesión
     */
    public function actionUploadProfileImage() {
        $id = Yii::app()->generalFunctions->uploadFile($_FILES['Formulario'], $_POST['Formulario'],Yii::app()->session['file']->id);
        $model = new Attachment;
        $data = $model->findByPk($id);
        Yii::app()->session['file'] = $data;
        
        $userModel =Users::model()->findByAttributes(array('samaccountname'=>Yii::app()->session['users']->samaccountname));
        $userModel->scenario = 'updateProfileImage';  
        $userModel->pic_profile_id = $id;
        $userModel->SaveAttributes(array('pic_profile_id'));
        // lo almacena en session
        Yii::app()->session['users']->pic_profile_id = $id;        
        echo CJSON::encode($data);
        Yii::app()->end();
    }
    
    /*
     * Método para mostrar las imágenes que se encuentran en la NAS
     */
    public function actionShowImage() {
        if(empty($_GET['file'])){ 
            Yii::app()->generalFunctions->fileInLine(Yii::app()->session['file']->filename,PATH_UPLOAD_REGISTROS);
        }else {
            Yii::app()->generalFunctions->fileInLine($_GET['file'],PATH_UPLOAD_REGISTROS);
        }
    }
}
