<?php

/**
 * This is the model class for table "tbl_formulario_roi".
 *
 * The followings are the available columns in table 'tbl_formulario_roi':
 * @property integer $for_id
 * @property string $for_radicado
 * @property string $for_empresa_id
 * @property string $for_complemento
 * @property integer $for_complemento_id
 * @property string $for_identificacion_persona
 * @property string $for_nombre_persona
 * @property string $for_sucursal_operacion
 * @property string $for_pais_id
 * @property string $for_departamento_id
 * @property string $for_ciudad_id
 * @property string $for_direccion
 * @property string $for_telefono
 * @property string $for_codigo_postal
 * @property string $for_grupo_interes_id
 * @property string $for_grupo_interes_otro
 * @property string $for_tipo_operacion_id
 * @property string $for_tipo_operacion_otro
 * @property string $for_persona
 * @property string $for_observacion
 * @property string $for_fecha_inicio
 * @property string $for_fecha_fin
 * @property integer $for_producto_id
 * @property string $for_producto_otro
 * @property string $for_reportante_nombre
 * @property integer $for_reportante_tipo_identificacion_id
 * @property string $for_reportante_identificacion
 * @property string $for_reportante_correo
 * @property string $for_file
 * @property integer $for_prueba
 * @property string $for_estado_id
 * @property integer $for_usuario_id
 * @property string $for_visitante
 *
 * The followings are the available model relations:
 * @property FormularioStatus $formularioStatus
 */
class Formulario extends CActiveRecord {

    // public $passwd2;
    public $file;
    public $validaCampos;
    public $modules;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_formulario_roi';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('for_radicado,for_empresa_id,for_identificacion_persona,for_nombre_persona,for_pais_id,for_departamento_id,for_ciudad_id,for_grupo_interes_id,for_tipo_operacion_id,for_observacion,for_producto_id', 'required', 'on' => 'insert'),
			array('for_tipo_identificacion_id,for_complemento,for_complemento_id,for_sucursal_operacion,for_direccion,for_telefono,for_codigo_postal,for_grupo_interes_otro,for_tipo_operacion_otro,for_fecha_inicio,for_fecha_fin,for_producto_otro,for_reportante_nombre,for_reportante_tipo_identificacion_id,for_reportante_identificacion,for_reportante_correo,for_prueba,for_estado_id,for_usuario_id','length', 'max'=>250, 'on'=>'insert'),
			array('for_reportante_correo', 'email', 'message' => 'Este campo debe contener una dirección de correo electrónico válida'),
            // array('for_identificacion_persona,for_reportante_identificacion', 'numerical', 'integerOnly' => true, 'on' => 'insert'),
			//array('for_reportante_correo', 'email', 'on' => 'insert'),

			// array('for_nombre_persona,for_reportante_nombre', 'match' , 'pattern'=> '/^[A-Za-zñÑáÁéÉíÍóÓúÚ\d_\s]$/i', 'message'=> 'Este campo solo puede contener texto'),
			// array('for_sucursal_operacion,for_grupo_interes_otro,for_tipo_operacion_otro,for_producto_otro', 'match' , 'pattern'=> '/^([a-z ñáéíóú][0-9])$/i', 'message'=> 'Este campo no puede contener caracteres especiales'),
			// array('for_codigo_postal', 'match' , 'pattern'=> '/^[0-9]{5,5}([- ]?[0-9]{4,4})?$/', 'message'=> 'El código postal no es válido'),
			// array('for_direccion', 'match' , 'pattern'=> '[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?)*', 'message'=> 'La dirección es inválida'),
			// array('for_telefono', 'match' , 'pattern'=> '/^(\(?[0-9]{3,3}\)?|[0-9]{3,3}[-. ]?)[ ][0-9]{3,3}[-. ]?[0-9]{4,4}$/', 'message'=> 'El número de teléfono no es válido'),
			
			// array('farchivo', 'file', 'types'=>'pdf, doc, docx, jpg, jpeg, png, gif', 'maxSize'=>1024*1024*3, 'tooLarge'=>'El archivo no puede exceder los 3MB.', 'allowEmpty'=>false),
			// array('for_file','file', 'maxFiles'=>5, 'on'=>'insert','message'=>'El número máximo de archivos a subir es 5'),
			// array('file', 'file', 'types'=> join(',',Yii::app()->generalFunctions->getAllowedExtensionGeneral()), 'message'=>'El archivo es obligatorio', 'on'=>'register' ),
            // array('samaccountname', 'unique', 'message' => 'El usuario ya se encuentra registrado', 'on' => 'register'),
            // array('modules', 'required', 'message' => '(Seleccione almenos una opción)', 'on' => 'register'),
            // array('passwd, sessionid, last_visit_date', 'safe'),
            // // The following rule is used by search().
            // // @todo Please remove those attributes that should not be searched.
            // array('user_id, givenname, sn, samaccountname, employeenumber, departmentnumber, department, id_profile, cn, mail, passwd, sessionid, last_visit_date, user_status, location', 'safe', 'on' => 'search'),
            // array('immediate_boss_mail', 'email'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            // 'userStatus' => array(self::BELONGS_TO, 'Userstatus', 'user_status'),
            'formularioEmpresa' => array(self::BELONGS_TO, 'Empresa', 'for_empresa_id'),
            'formularioTipo_identificacion' => array(self::BELONGS_TO, 'Tipo_identificacion', 'for_tipo_identificacion_id'),
            'formularioTipo_operacion' => array(self::BELONGS_TO, 'Tipo_operacion', 'for_tipo_operacion_id'),
            'formularioGrupo_interes' => array(self::BELONGS_TO, 'Grupo_interes', 'for_grupo_interes_id'),
            'formularioProducto' => array(self::BELONGS_TO, 'Producto', 'for_producto_id'),
            'formularioPais' => array(self::BELONGS_TO, 'Pais', 'for_pais_id'),
            'formularioDepartamento' => array(self::BELONGS_TO, 'Departamento', 'for_departamento_id'),
            'formularioCiudad' => array(self::BELONGS_TO, 'Ciudad', 'for_ciudad_id'),
            'formularioRadicado' => array(self::BELONGS_TO, 'Formulario', 'for_complemento_id'),
			
//			'userProfileImg' => array(self::BELONGS_TO, 'MvcAttachment', 'pic_profile_id'),
        );
    }


	 /****************************************************************************
	 ************ FUNCIONES DE PRUEBAS TRATANDO DE FILTRAR for_radicado **********
	 *****************************************************************************/
	/*
	public function fields()
	{
		return array(
			// field name is "name", its value is defined by a PHP callback
           'for_id',
            'for_radicado',
            'for_empresa_id',
            'for_complemento',
            'for_complemento_id',
            'for_tipo_identificacion_id',
            'for_identificacion_persona',
            'for_nombre_persona',
            'for_sucursal_operacion',
            'for_pais_id',
            'for_departamento_id',
            'for_ciudad_id',
            'for_direccion',
            'for_telefono',
			'for_codigo_postal',
            'for_grupo_interes_id',
            'for_grupo_interes_otro',
            'for_tipo_operacion_id',
            'for_tipo_operacion_otro',
            'for_persona',
            'for_observacion',
            'for_fecha_inicio',
            'for_fecha_fin',
            'for_producto_id',
            'for_producto_otro',
			'for_reportante_nombre',
			'for_reportante_tipo_identificacion_id',
			'for_reportante_identificacion',
			'for_reportante_correo',
            'for_file',
            'for_prueba',
            'for_estado_id',
            'for_usuario_id',
			'for_visitante',
			'for_radicado' => function () {
				return Controller::sincifrar($this->for_radicado);
			},
		);
	}
	*/
	
	/*
	public function fields()
	{
		$fields = parent::fields();

		// remove fields that contain sensitive information
		 $fields['for_radicado'] = $this->sincifrar($fields['for_radicado']);

		return $fields;
	}
	*/
	
     /*
	 public function getRadicado(){
          return  Controller::sincifrar($this->for_radicado);
     }
	 */
	 
	 /****************************************************************************/
	 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'for_id' => 'Form',
            'for_radicado' => 'Radicado',
            'for_empresa_id' => 'Empresa',
            'for_complemento' => '¿Es complemento de otro reporte anterior?',
            'for_complemento_id' => 'Número de radicado del resporte anterior',
            'for_tipo_identificacion_id' => 'Tipo Identificación',
            'for_identificacion_persona' => 'Identificación',
            'for_nombre_persona' => 'Nombre completo o Razón Social',
            'for_sucursal_operacion' => 'Sucursal u oficina de la operación inusual',
            'for_pais_id' => 'País',
            'for_departamento_id' => 'Departamento',
            'for_ciudad_id' => 'Ciudad',
            'for_direccion' => 'Dirección',
            'for_telefono' => 'Teléfono',
            'for_codigo_postal' => 'Código postal',
            'for_grupo_interes_id' => 'Grupos de Interés',
            'for_grupo_interes_otro' => 'Otros Grupos de Interés',
            'for_tipo_operacion_id' => 'Tipo de operación inusual',
            'for_tipo_operacion_otro' => 'Otro Tipo de operación inusual',
            'for_persona' => 'Otras personas',
            'for_observacion' => 'Observación',
            'for_fecha_inicio' => 'Fecha inicio',
            'for_fecha_fin' => 'Fecha fin',
            'for_producto_id' => 'Producto o Servicio',
            'for_producto_otro' => 'Otro Producto o Servicio',
			'for_reportante_nombre' => 'Nombre del reportante',
			'for_reportante_tipo_identificacion_id' => 'Tipo identificación',
			'for_reportante_identificacion' => 'Identificación',
			'for_reportante_correo' => 'Correo electrónico',
            'for_file' => 'Seleccione los documentos adjuntos',
			'for_prueba' => 'Prueba',
            'for_estado_id' => 'Estado',
            'for_usuario_id' => 'Estado usuario',
			'for_visitante' => 'Datos visitante',
        );
    }


    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('for_id', $this->for_id);
        $criteria->compare('for_radicado', $this->for_radicado, true);
        // $criteria->compare('sn', $this->sn, true);
        // $criteria->compare('samaccountname', $this->samaccountname, true);
        // $criteria->compare('employeenumber', $this->employeenumber, true);
        // $criteria->compare('departmentnumber', $this->departmentnumber, true);
        // $criteria->compare('department', $this->department, true);
        // $criteria->compare('id_profile', $this->id_profile, true);
        // $criteria->compare('cn', $this->cn, true);
        // $criteria->compare('mail', $this->mail, true);
        // $criteria->compare('passwd', $this->passwd, true);
        // $criteria->compare('sessionid', $this->sessionid, true);
        // $criteria->compare('last_visit_date', $this->last_visit_date, true);
        // $criteria->compare('user_status', $this->user_status);
        // $criteria->compare('location', $this->location);
		// $criteria->compare('pic_profile_id',$this->pic_profile_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Formulario the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
