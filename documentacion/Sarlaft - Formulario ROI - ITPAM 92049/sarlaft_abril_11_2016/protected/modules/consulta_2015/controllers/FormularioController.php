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
				 'actions' => array('view', 'query', 'create', 'selectdepartamento', 'selectciudad', 'uploadprofileimage', 'showimage'),
				 'users' => array('*'),
				 ),
				);
    }
	
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        // $model = Formulario::model()->findByPk($_GET['id']);       
		// $model->update('tbl_formulario_consulta', array('consulta_radicado'=>$id), 'id=:id', array(':id'=>$id));
		
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}    
	

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionQuery()
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
		
		$tabla = new TableWS('Web','http://unevm-dmap.une.net.co/WebServicesC/proxy/wsSARLAFT.php?wsdl');

		//insert:
		$tabla->Insert('TipoIdentificacion,Identificacion,Nombre,Usuario')->into('Web')
                ->valores(array(
                    'cc',
                    '123456',
                    'Fulanito',
					'jcadag'
        ));
        if ($tabla->query()) {
			echo " ******* OK <br><br>";
			echo $tabla->getErrores();
		}else{
			echo $tabla->getErrores();
		}
		
		echo "<br><br>";
		$tabla->Select('*')->from('Web');
		$datos = $tabla->query();
		echo "<pre>";
		var_dump($datos);
		echo "</pre>";
		echo "<br><br>";

		// Se obtienen datos de parámetros del formulario
		$id_par = 1;
		$row_parametros = Parametros::model()->findAll('par_id = :id_par',array(':id_par'=>$id_par));
		
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Formulario']))
		{
			$model->attributes=$_POST['Formulario'];

			// Asigno el formato de fecha correcto
			$model->fechacreacion = date('Y-m-d H:i:s');
			
			if ($model->validate()) {
				
				$arrLog = array("Identificacion"=>$model->consulta_identificacion_persona, "Nombre"=>$model->consulta_nombre_persona, "Proxy"=>$proxy, "IP"=>$ip, "Navegador"=>$browser);
				
				$model->consulta_nombre_persona = $this->cifrar($model->consulta_nombre_persona);
				$model->creadopor = $this->cifrar($model->creadopor);
				$model->modificadopor = $this->cifrar($model->modificadopor);
			}
			
			if($model->save()) {
				$fechaActual = date('dmY');
				
				// Se guarda los datos de consulta
				$model->consulta_visitante = $this->cifrar($jsonVisitante);
				Formulario::model()->updateByPk($model->consulta_id, array('consulta_visitante'=>$model->consulta_visitante));
				
				// Se guarda el log de las acciones
				$jsonLog = json_encode($arrLog);
				Yii::log($jsonLog,"info","application.controllers.FormularioController");
				$this->redirect(array('view','id'=>$model->consulta_id));
			}
		}

		$this->render('query',array(
			'model'=>$model,
			'datos'=>$datos,
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='consulta-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}        

}
