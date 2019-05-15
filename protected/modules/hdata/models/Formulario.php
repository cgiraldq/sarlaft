<?php

/**
 * This is the model class for table "tbl_formulario_hdata".
 *
 * The followings are the available columns in table 'tbl_formulario_hdata:
 * @property integer $hdata_id
 * @property string $hdata_radicado
 * @property string $hdata_empresa_id
 * @property string $hdata_tipo_identificacion_id
 * @property string $hdata_identificacion_persona
 * @property string $hdata_nombre_persona
 * @property string $hdata_vicepresidencia
 * @property string $hdata_area
 * @property string $hdata_cargo
  * @property string $hdata_pais_id
 * @property string $hdata_departamento_id
 * @property string $hdata_ciudad_id
 * @property string $hdata_email
 * @property string $hdata_telefono
 * @property string $hdata_fecha_declaracion
 * @property string $hdata_estado_id
 * @property integer $hdata_usuario
 * @property integer $hdata_prueba
 * @property string $hdata_ip
 * @property integer $hdata_usuario_id
 * @property string $hdata_visitante
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
        return 'tbl_formulario_hdata';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('hdata_nombre_persona,hdata_identificacion_persona', 'required', 'on' => 'insert'),
			array('hdata_nombre_persona,hdata_area,hdata_cargo,hdata_identificacion_persona,hdata_vicepresidencia,hdata_empresa_id,hdata_tipo_identificacion_id,hdata_pais_id,hdata_departamento_id,hdata_ciudad_id,hdata_email,hdata_telefono,hdata_estado_id', 'safe'),
            // array('hdata_identificacion_persona,hdata_reportante_identificacion', 'numerical', 'integerOnly' => true, 'on' => 'insert'),

			// array('hdata_nombre_persona,hdata_nombre_persona', 'match' , 'pattern'=> '/^[A-Za-zñÑáÁéÉíÍóÓúÚ\d_\s]$/i', 'message'=> 'Este campo solo puede contener texto'),
			// array('hdata_nombre_persona', 'match' , 'pattern'=> '/^([a-z ñáéíóú][0-9])$/i', 'message'=> 'Este campo no puede contener caracteres especiales'),
			//array('hdata_email', 'email', 'message' => 'Este campo debe contener una dirección de correo electrónico válida'),
			// array('hdata_codigo_postal', 'match' , 'pattern'=> '/^[0-9]{5,5}([- ]?[0-9]{4,4})?$/', 'message'=> 'El código postal no es válido'),
			// array('hdata_direccion', 'match' , 'pattern'=> '[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?)*', 'message'=> 'La dirección es inválida'),
			// array('hdata_telefono', 'match' , 'pattern'=> '/^(\(?[0-9]{3,3}\)?|[0-9]{3,3}[-. ]?)[ ][0-9]{3,3}[-. ]?[0-9]{4,4}$/', 'message'=> 'El número de teléfono no es válido'),
			
			// array('farchivo', 'file', 'types'=>'pdf, doc, docx, jpg, jpeg, png, gif', 'maxSize'=>1024*1024*3, 'tooLarge'=>'El archivo no puede exceder los 3MB.', 'allowEmpty'=>false),
			// array('hdata_file','file', 'maxFiles'=>5, 'on'=>'insert','message'=>'El número máximo de archivos a subir es 5'),
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
            'formularioEmpresa' => array(self::BELONGS_TO, 'Empresa', 'hdata_empresa_id'),
            // 'formularioClase' => array(self::BELONGS_TO, 'Clase', 'hdata_clase_id'),
            // 'formularioCanal' => array(self::BELONGS_TO, 'Canal', 'hdata_canal_id'),
            // 'formularioTipo' => array(self::BELONGS_TO, 'Tipo', 'hdata_tipo_id'),
            // 'formularioAccion' => array(self::BELONGS_TO, 'Accion', 'hdata_accion_id'),
            'formularioPais' => array(self::BELONGS_TO, 'Pais', 'hdata_pais_id'),
            'formularioDepartamento' => array(self::BELONGS_TO, 'Departamento', 'hdata_departamento_id'),
            'formularioCiudad' => array(self::BELONGS_TO, 'Ciudad', 'hdata_ciudad_id'),
            //'formularioRadicado' => array(self::BELONGS_TO, 'Formulario', 'hdata_complemento_id'),
			
//			'userProfileImg' => array(self::BELONGS_TO, 'MvcAttachment', 'pic_profile_id'),
        );
    }


	 /****************************************************************************
	 ************ FUNCIONES DE PRUEBAS TRATANDO DE FILTRAR hdata_radicado **********
	 *****************************************************************************/
	/*
	public function fields()
	{
		return array(
			// field name is "name", its value is defined by a PHP callback
           'hdata_id',
            'hdata_radicado',
            'hdata_empresa_id',
            'hdata_complemento',
            'hdata_complemento_id',
            'hdata_tipo_identificacion_id',
            'hdata_identificacion_persona',
            'hdata_nombre_persona',
            'hdata_sucursal_operacion',
            'hdata_pais_id',
            'hdata_departamento_id',
            'hdata_ciudad_id',
            'hdata_direccion',
            'hdata_telefono',
			'hdata_codigo_postal',
            'hdata_grupo_interes_id',
            'hdata_grupo_interes_otro',
            'hdata_tipo_operacion_id',
            'hdata_tipo_operacion_otro',
            'hdata_persona',
            'hdata_descripcion_consulta',
            'hdata_fecha_declaracion',
            'hdata_fecha_cierre',
            'hdata_producto_id',
            'hdata_otros_datos_contacto',
            'hdata_file',
            'hdata_prueba',
            'hdata_estado_id',
            'hdata_usuario_id',
			'hdata_visitante',
			'hdata_radicado' => function () {
				return Controller::sincifrar($this->hdata_radicado);
			},
		);
	}
	*/
	
	/*
	public function fields()
	{
		$fields = parent::fields();

		// remove fields that contain sensitive information
		 $fields['hdata_radicado'] = $this->sincifrar($fields['hdata_radicado']);

		return $fields;
	}
	*/
	
     /*
	 public function getRadicado(){
          return  Controller::sincifrar($this->hdata_radicado);
     }
	 */
	 
	 /****************************************************************************/
	 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'hdata_id' => 'Form',
            'hdata_empresa_id' => 'Empresa',
            'hdata_radicado' => 'Radicado',
            'hdata_tipo_identificacion_id' => 'Tipo de identificación',
            'hdata_identificacion_persona' => 'Identificación ',
            'hdata_nombre_persona' => 'Nombre',
			'hdata_vicepresidencia' => 'Vicepresidencia',	
			'hdata_area' => 'Area',
			'hdata_cargo' => 'Cargo',
            'hdata_pais_id' => 'País',
            'hdata_departamento_id' => 'Departamento',
            'hdata_ciudad_id' => 'Ciudad',
            'hdata_email' => 'Correo electrónico',
            'hdata_telefono' => 'Teléfono',
             'hdata_fecha_declaracion' => 'Fecha declaración',
			'hdata_prueba' => 'Prueba',
            'hdata_estado_id' => 'Estado',
            'hdata_usuario' => 'Usuario',
            'hdata_usuario_id' => 'Estado usuario',
			'hdata_visitante' => 'Datos visitante',
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

        $criteria->compare('hdata_id', $this->hdata_id);
        $criteria->compare('hdata_radicado', $this->hdata_radicado, true);
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
