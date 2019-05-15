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
		// $model->update('tbl_formulario_roi', array('for_radicado'=>$id), 'id=:id', array(':id'=>$id));
		
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
		$model_persona=new Persona_formulario;
		
		// Se obtienen datos de parámetros del formulario
		$id_par = 1;
		$row_parametros = Parametros::model()->findAll('par_id = :id_par',array(':id_par'=>$id_par));
		
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		$this->performAjaxValidation($model_persona);

		if(isset($_POST['Formulario']))
		{
			$model->attributes=$_POST['Formulario'];

			// Asigno el formato de fecha correcto
			$model->for_fecha_inicio = date("Y-m-d",strtotime($model->for_fecha_inicio));
			$model->for_fecha_fin = date("Y-m-d",strtotime($model->for_fecha_fin));
			$model->fechacreacion = date('Y-m-d H:i:s');
			
			if ($model->validate()) {
				
				$arrLog = array("Identificacion"=>$model->for_identificacion_persona, "Nombre"=>$model->for_nombre_persona, "Reportante"=>$model->for_reportante_nombre, "Email"=>$model->for_reportante_correo, "Proxy"=>$proxy, "IP"=>$ip, "Navegador"=>$browser);
				
				$model_mail = array();
				// Se hace ciclo para asignar valores al array que armará el correo a enviar
				// No se asigna directamente el array ya que heredaría las propiedades del otro 
				// y no permitiría agregar los valores correspondientes a los campos que tienen el valor del id
				foreach($model as $campo=>$valor)
				{
					$model_mail[$campo] = utf8_decode($valor);
				}				
				
				$rs_empresa = Empresa::model()->findByPk($model->for_empresa_id);
				$model_mail['for_empresa'] = utf8_decode($rs_empresa['emp_nombre']);
				
				if(isset($model->for_complemento) && $model->for_complemento=='1')
					$model_mail['for_complemento'] = 'Si';
				else
					$model_mail['for_complemento'] = 'No';
				
				if(isset($model->for_complemento_id)) {
					$rs_complemento = Formulario::model()->findByPk($model->for_complemento_id);
					$model_mail['for_radicado_complemento'] = utf8_decode($rs_complemento['for_radicado']);
				} else {
					$model_mail['for_radicado_complemento'] = '';
				}
				
				$rs_tipo_identificacion = Tipo_identificacion::model()->findByPk($model->for_tipo_identificacion_id);
				$model_mail['for_tipo_identificacion'] = utf8_decode($rs_tipo_identificacion['tid_nombre']);
				
				$rs_pais = Pais::model()->findByPk($model->for_pais_id);
				$model_mail['for_pais'] = utf8_decode($rs_pais['pai_nombre']);
				
				$rs_departamento = Departamento::model()->findByPk($model->for_departamento_id);
				$model_mail['for_departamento'] = utf8_decode($rs_departamento['dep_nombre']);
				
				$rs_ciudad = Ciudad::model()->findByPk($model->for_ciudad_id);
				$model_mail['for_ciudad'] = utf8_decode($rs_ciudad['ciu_nombre']);
				
				$rs_grupo_interes = Grupo_interes::model()->findByPk($model->for_grupo_interes_id);
				$model_mail['for_grupo_interes'] = utf8_decode($rs_grupo_interes['gru_nombre']);
				
				$rs_tipo_operacion = Tipo_operacion::model()->findByPk($model->for_tipo_operacion_id);
				$model_mail['for_tipo_operacion'] = utf8_decode($rs_tipo_operacion['tip_nombre']);
				
				$rs_producto = Producto::model()->findByPk($model->for_producto_id);
				$model_mail['for_producto'] = utf8_decode($rs_producto['pro_nombre']);
				
				$rs_reportante_tipo_identificacion = Tipo_identificacion::model()->findByPk($model->for_reportante_tipo_identificacion_id);
				$model_mail['for_reportante_tipo_identificacion'] = utf8_decode($rs_reportante_tipo_identificacion['tid_nombre']);
				
				$model->for_nombre_persona = $this->cifrar($model->for_nombre_persona);
				$model->for_identificacion_persona = $this->cifrar($model->for_identificacion_persona);
				$model->for_sucursal_operacion = $this->cifrar($model->for_sucursal_operacion);
				$model->for_direccion = $this->cifrar($model->for_direccion);
				$model->for_telefono = $this->cifrar($model->for_telefono);
				$model->for_codigo_postal = $this->cifrar($model->for_codigo_postal);
				$model->for_grupo_interes_otro = $this->cifrar($model->for_grupo_interes_otro);
				$model->for_tipo_operacion_otro = $this->cifrar($model->for_tipo_operacion_otro);
				$model->for_observacion = $this->cifrar($model->for_observacion);
				$model->for_producto_otro = $this->cifrar($model->for_producto_otro);
				$model->for_reportante_nombre = $this->cifrar($model->for_reportante_nombre);
				$model->for_reportante_identificacion = $this->cifrar($model->for_reportante_identificacion);
				$model->for_reportante_correo = $this->cifrar($model->for_reportante_correo);
				$model->creadopor = $this->cifrar($model->creadopor);
				$model->modificadopor = $this->cifrar($model->modificadopor);
			}
			
			if($model->save()) {
				$fechaActual = date('dmY');
				$idRadicado = (string) $model->for_id;
				
				if(strlen($idRadicado)==1)
					$idRadicado = '000'.$idRadicado;
				elseif(strlen($idRadicado)==2)
					$idRadicado = '00'.$idRadicado;
				elseif(strlen($idRadicado)==3)
					$idRadicado = '0'.$idRadicado;
				
				$model->for_radicado = 'ROI-'.$fechaActual.'-'.$idRadicado;
				// $radicado = $this->cifrar($radicado);
				Formulario::model()->updateByPk($model->for_id, array('for_radicado'=>$model->for_radicado));

				$model_mail['for_radicado'] = $model->for_radicado;
				
				// Se guarda la lista de otras personas en el reporte
				$otras_personas->attributes=$_POST['Persona_formulario'];				
				$arrOtrasPersonas = array();
				foreach ($otras_personas as $datos_persona) {
					foreach ($datos_persona as $field_persona => $value_persona) {
						if(isset($field_persona) && trim($field_persona)!='')
						{
							// $arrOtrasPersonas[$field_persona] = $this->limpiarCaracteresEspeciales($value_persona);
							$arrOtrasPersonas[$field_persona] = $value_persona;
						}
					}
				}			
				$jsonPersonas = json_encode($arrOtrasPersonas);
				$model->for_persona = $this->cifrar($jsonPersonas);
				Formulario::model()->updateByPk($model->for_id, array('for_persona'=>$model->for_persona));
				
				if(isset($model->per_tipo_identificacion_id)) {
					$rs_tipo_identificacion_per = Tipo_identificacion::model()->findByPk($model->per_tipo_identificacion_id);
					$model_mail['per_tipo_identificacion'] = utf8_decode($rs_tipo_identificacion_per['tid_nombre']);
				} else {
					$model_mail['per_tipo_identificacion'] = '';
				}
				
				// Se guarda en base de datos y en carpeta los archivos adjuntos 
				$path_file = PATH_UPLOAD_ARCHIVOS;		//ruta del archivo
				$uploadedFile = CUploadedFile::getInstancesByName('for_file');
				$arrFiles = array();
				foreach ($uploadedFile as $file => $value) {
					if(isset($value) && trim($value)!='')
					{
						$fileNombre = time().'-'.$value;  // numero aleatorio  + nombre de archivo             
						// $fileNombre = $this->limpiarCaracteresEspeciales($fileNombre);
						$value->saveAs($path_file.$fileNombre);
						$arrFiles[] = $fileNombre;
					}
				}			
				$jsonFiles = json_encode($arrFiles);
				$model->for_file = $this->cifrar($jsonFiles);
				Formulario::model()->updateByPk($model->for_id, array('for_file'=>$model->for_file));

				
				// Se guarda los datos del visitante 
				$model->for_visitante = $this->cifrar($jsonVisitante);
				Formulario::model()->updateByPk($model->for_id, array('for_visitante'=>$model->for_visitante));
				
				// $model_persona->per_formulario_id = $model->for_id;
				// $model_persona->attributes=$_POST['Persona_formulario'];
				// $model_persona->save(false);

				// Se envía por correo
				if($row_parametros[0]['par_envio_correo']==1) {
					// Yii::app()->enviar_correo($row_parametros[0]['par_correo']);
					// $to = array('jnavarrm@asesor.une.com.co','jcadag@asesor.une.com.co');
					$to = array($row_parametros[0]['par_correo']);
					$contenidoResponse = particularFunction::contentEmail($model_mail);
					$contenidoResponse = utf8_encode($contenidoResponse);
					$mailResponse = particularFunction::sendEmail($to, 'Reporte Formulario ROI - Sarlaft', $contenidoResponse);					
				}
				
				// Se guarda el log de las acciones
				$jsonLog = json_encode($arrLog);
				Yii::log($jsonLog,"info","application.controllers.FormularioController");
				$this->redirect(array('view','id'=>$model->for_id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'model_persona'=>$model_persona,
			'row_parametros'=>$row_parametros,
		));
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
		$model_persona=new Persona_formulario;
		
		// Se obtienen datos de parámetros del formulario
		$id_par = 1;
		$row_parametros = Parametros::model()->findAll('par_id = :id_par',array(':id_par'=>$id_par));
		
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		$this->performAjaxValidation($model_persona);

		if(isset($_POST['Formulario']))
		{
			$model->attributes=$_POST['Formulario'];

			// Asigno el formato de fecha correcto
			$model->for_fecha_inicio = date("Y-m-d",strtotime($model->for_fecha_inicio));
			$model->for_fecha_fin = date("Y-m-d",strtotime($model->for_fecha_fin));
			$model->fechacreacion = date('Y-m-d H:i:s');
			
			if ($model->validate()) {
				
				$arrLog = array("Identificacion"=>$model->for_identificacion_persona, "Nombre"=>$model->for_nombre_persona, "Reportante"=>$model->for_reportante_nombre, "Email"=>$model->for_reportante_correo, "Proxy"=>$proxy, "IP"=>$ip, "Navegador"=>$browser);
				
				$model_mail = array();
				// Se hace ciclo para asignar valores al array que armará el correo a enviar
				// No se asigna directamente el array ya que heredaría las propiedades del otro 
				// y no permitiría agregar los valores correspondientes a los campos que tienen el valor del id
				foreach($model as $campo=>$valor)
				{
					$model_mail[$campo] = utf8_decode($valor);
				}				
				
				$rs_tipo_identificacion = Tipo_identificacion::model()->findByPk($model->for_tipo_identificacion_id);
				$model_mail['for_tipo_identificacion'] = utf8_decode($rs_tipo_identificacion['tid_nombre']);
				
				$model->for_nombre_persona = $this->cifrar($model->for_nombre_persona);
				$model->for_identificacion_persona = $this->cifrar($model->for_identificacion_persona);
				$model->creadopor = $this->cifrar($model->creadopor);
				$model->modificadopor = $this->cifrar($model->modificadopor);
			}
			
			if($model->save()) {
				$fechaActual = date('dmY');
				$idRadicado = (string) $model->for_id;
				
				if(strlen($idRadicado)==1)
					$idRadicado = '000'.$idRadicado;
				elseif(strlen($idRadicado)==2)
					$idRadicado = '00'.$idRadicado;
				elseif(strlen($idRadicado)==3)
					$idRadicado = '0'.$idRadicado;
				
				$model->for_radicado = 'ROI-'.$fechaActual.'-'.$idRadicado;
				// $radicado = $this->cifrar($radicado);
				Formulario::model()->updateByPk($model->for_id, array('for_radicado'=>$model->for_radicado));

				$model_mail['for_radicado'] = $model->for_radicado;
				
				if(isset($model->per_tipo_identificacion_id)) {
					$rs_tipo_identificacion_per = Tipo_identificacion::model()->findByPk($model->per_tipo_identificacion_id);
					$model_mail['per_tipo_identificacion'] = utf8_decode($rs_tipo_identificacion_per['tid_nombre']);
				} else {
					$model_mail['per_tipo_identificacion'] = '';
				}
				
				// Se guarda en base de datos y en carpeta los archivos adjuntos 
				$path_file = PATH_UPLOAD_ARCHIVOS;		//ruta del archivo
				$uploadedFile = CUploadedFile::getInstancesByName('for_file');
				$arrFiles = array();
				foreach ($uploadedFile as $file => $value) {
					if(isset($value) && trim($value)!='')
					{
						$fileNombre = time().'-'.$value;  // numero aleatorio  + nombre de archivo             
						// $fileNombre = $this->limpiarCaracteresEspeciales($fileNombre);
						$value->saveAs($path_file.$fileNombre);
						$arrFiles[] = $fileNombre;
					}
				}			
				$jsonFiles = json_encode($arrFiles);
				$model->for_file = $this->cifrar($jsonFiles);
				Formulario::model()->updateByPk($model->for_id, array('for_file'=>$model->for_file));

				
				// Se guarda los datos del visitante 
				$model->for_visitante = $this->cifrar($jsonVisitante);
				Formulario::model()->updateByPk($model->for_id, array('for_visitante'=>$model->for_visitante));
				
				// $model_persona->per_formulario_id = $model->for_id;
				// $model_persona->attributes=$_POST['Persona_formulario'];
				// $model_persona->save(false);

				// Se envía por correo
				if($row_parametros[0]['par_envio_correo']==1) {
					// Yii::app()->enviar_correo($row_parametros[0]['par_correo']);
					// $to = array('jnavarrm@asesor.une.com.co','jcadag@asesor.une.com.co');
					$to = array($row_parametros[0]['par_correo']);
					$contenidoResponse = particularFunction::contentEmail($model_mail);
					$contenidoResponse = utf8_encode($contenidoResponse);
					$mailResponse = particularFunction::sendEmail($to, 'Reporte Formulario ROI - Sarlaft', $contenidoResponse);					
				}
				
				// Se guarda el log de las acciones
				$jsonLog = json_encode($arrLog);
				Yii::log($jsonLog,"info","application.controllers.FormularioController");
				$this->redirect(array('view','id'=>$model->for_id));
			}
		}

		$this->render('consulta',array(
			'model'=>$model,
			'model_persona'=>$model_persona,
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='roi-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}        

	public function actionSelectdepartamento()
	{
		$id_pais = $_POST['Formulario']['for_pais_id'];
		$lista = Departamento::model()->findAll('dep_pais_id = :id_pais',array(':id_pais'=>$id_pais));
		$lista = CHtml::listData($lista,'dep_id','dep_nombre');
		
		echo CHtml::tag('option',array('value'=>''), '--Seleccione--', true);
		
		foreach ($lista as $valor => $descripcion) {
			echo CHtml::tag('option',array('value'=>$valor), CHtml::encode($descripcion), true);
		}
	}

	public function actionSelectciudad()
	{
		$id_dep = $_POST['Formulario']['for_departamento_id'];
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
