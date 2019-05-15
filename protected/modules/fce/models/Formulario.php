<?php

/**
 * This is the model class for table "tbl_formulario_fce".
 *
 * The followings are the available columns in table 'tbl_formulario_fce:
 * @property integer $fce_id
 * @property string $fce_radicado
 * @property string $fce_empresa_id
 * @property string $fce_tipo_identificacion_id
 * @property string $fce_identificacion_persona
 * @property string $fce_nombre_persona
 * @property string $fce_vicepresidencia
 * @property string $fce_area
 * @property string $fce_cargo
  * @property string $fce_pais_id
 * @property string $fce_departamento_id
 * @property string $fce_ciudad_id
 * @property string $fce_email
 * @property string $fce_telefono
 * @property string $fce_fecha_declaracion
 * @property string $fce_estado_id
 * @property integer $fce_usuario
 * @property integer $fce_prueba
 * @property string $fce_ip
 * @property integer $fce_usuario_id
 * @property string $fce_visitante
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
        return 'tbl_formulario_fce';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fce_nombre_persona,fce_identificacion_persona', 'required', 'on' => 'insert'),
			array('fce_nombre_persona,fce_area,fce_cargo,fce_identificacion_persona,fce_vicepresidencia,fce_empresa_id,fce_tipo_identificacion_id,fce_pais_id,fce_departamento_id,fce_ciudad_id,fce_email,fce_telefono,fce_estado_id', 'safe'),
            // array('fce_identificacion_persona,fce_reportante_identificacion', 'numerical', 'integerOnly' => true, 'on' => 'insert'),

			// array('fce_nombre_persona,fce_nombre_persona', 'match' , 'pattern'=> '/^[A-Za-zñÑáÁéÉíÍóÓúÚ\d_\s]$/i', 'message'=> 'Este campo solo puede contener texto'),
			// array('fce_nombre_persona', 'match' , 'pattern'=> '/^([a-z ñáéíóú][0-9])$/i', 'message'=> 'Este campo no puede contener caracteres especiales'),
			//array('fce_email', 'email', 'message' => 'Este campo debe contener una dirección de correo electrónico válida'),
			// array('fce_codigo_postal', 'match' , 'pattern'=> '/^[0-9]{5,5}([- ]?[0-9]{4,4})?$/', 'message'=> 'El código postal no es válido'),
			// array('fce_direccion', 'match' , 'pattern'=> '[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?)*', 'message'=> 'La dirección es inválida'),
			// array('fce_telefono', 'match' , 'pattern'=> '/^(\(?[0-9]{3,3}\)?|[0-9]{3,3}[-. ]?)[ ][0-9]{3,3}[-. ]?[0-9]{4,4}$/', 'message'=> 'El número de teléfono no es válido'),
			
			// array('farchivo', 'file', 'types'=>'pdf, doc, docx, jpg, jpeg, png, gif', 'maxSize'=>1024*1024*3, 'tooLarge'=>'El archivo no puede exceder los 3MB.', 'allowEmpty'=>false),
			// array('fce_file','file', 'maxFiles'=>5, 'on'=>'insert','message'=>'El número máximo de archivos a subir es 5'),
			// array('file', 'file', 'types'=> join(',',Yii::app()->generalFunctions->getAllowedExtensionGeneral()), 'message'=>'El archivo es obligatorio', 'on'=>'register' ),
            // array('samaccountname', 'unique', 'message' => 'El usuario ya se encuentra registrado', 'on' => 'register'),
            // array('modules', 'required', 'message' => '(Seleccione almenos una opción)', 'on' => 'register'),
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
            'formularioEmpresa' => array(self::BELONGS_TO, 'Empresa', 'fce_empresa_id'),
            // 'formularioClase' => array(self::BELONGS_TO, 'Clase', 'fce_clase_id'),
            // 'formularioCanal' => array(self::BELONGS_TO, 'Canal', 'fce_canal_id'),
            // 'formularioTipo' => array(self::BELONGS_TO, 'Tipo', 'fce_tipo_id'),
            // 'formularioAccion' => array(self::BELONGS_TO, 'Accion', 'fce_accion_id'),
            'formularioPais' => array(self::BELONGS_TO, 'Pais', 'fce_pais_id'),
            'formularioDepartamento' => array(self::BELONGS_TO, 'Departamento', 'fce_departamento_id'),
            'formularioCiudad' => array(self::BELONGS_TO, 'Ciudad', 'fce_ciudad_id'),
            //'formularioRadicado' => array(self::BELONGS_TO, 'Formulario', 'fce_complemento_id'),
			
//			'userProfileImg' => array(self::BELONGS_TO, 'MvcAttachment', 'pic_profile_id'),
        );
    }


	 /****************************************************************************
	 ************ FUNCIONES DE PRUEBAS TRATANDO DE FILTRAR fce_radicado **********
	 *****************************************************************************/
	/*
	public function fields()
	{
		return array(
			// field name is "name", its value is defined by a PHP callback
           'fce_id',
            'fce_radicado',
            'fce_empresa_id',
            'fce_complemento',
            'fce_complemento_id',
            'fce_tipo_identificacion_id',
            'fce_identificacion_persona',
            'fce_nombre_persona',
            'fce_sucursal_operacion',
            'fce_pais_id',
            'fce_departamento_id',
            'fce_ciudad_id',
            'fce_direccion',
            'fce_telefono',
			'fce_codigo_postal',
            'fce_grupo_interes_id',
            'fce_grupo_interes_otro',
            'fce_tipo_operacion_id',
            'fce_tipo_operacion_otro',
            'fce_persona',
            'fce_descripcion_consulta',
            'fce_fecha_declaracion',
            'fce_fecha_cierre',
            'fce_producto_id',
            'fce_otros_datos_contacto',
            'fce_file',
            'fce_prueba',
            'fce_estado_id',
            'fce_usuario_id',
			'fce_visitante',
			'fce_radicado' => function () {
				return Controller::sincifrar($this->fce_radicado);
			},
		);
	}
	*/
	
	/*
	public function fields()
	{
		$fields = parent::fields();

		// remove fields that contain sensitive information
		 $fields['fce_radicado'] = $this->sincifrar($fields['fce_radicado']);

		return $fields;
	}
	*/
	
     /*
	 public function getRadicado(){
          return  Controller::sincifrar($this->fce_radicado);
     }
	 */
	 
	 /****************************************************************************/
	 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'fce_id' => 'Form',
            'fce_empresa_id' => 'Empresa',
            'fce_radicado' => 'Radicado',
            'fce_tipo_identificacion_id' => 'Tipo de identificación',
            'fce_identificacion_persona' => 'Identificación ',
            'fce_nombre_persona' => 'Nombre',
			'fce_vicepresidencia' => 'Vicepresidencia',	
			'fce_area' => 'Area',
			'fce_cargo' => 'Cargo',
            'fce_pais_id' => 'País',
            'fce_departamento_id' => 'Departamento',
            'fce_ciudad_id' => 'Ciudad',
            'fce_email' => 'Correo electrónico',
            'fce_telefono' => 'Teléfono',
             'fce_fecha_declaracion' => 'Fecha declaración',
			'fce_prueba' => 'Prueba',
            'fce_estado_id' => 'Estado',
            'fce_usuario' => 'Usuario',
            'fce_usuario_id' => 'Estado usuario',
			'fce_visitante' => 'Datos visitante',
			'recaptcha' => 'Validación',
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

        $criteria->compare('fce_id', $this->fce_id);
        $criteria->compare('fce_radicado', $this->fce_radicado, true);
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
