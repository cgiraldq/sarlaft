<?php
class Formulario extends CActiveRecord {

    // public $passwd2;
    public $file;
    public $validaCampos;
    public $modules;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_formulario_fra';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fra_nombre,fra_identificacion,fra_vicepresidencia,fra_area,fra_cargo,fra_email,fra_telefono,fra_ciudad,fra_sede_entrega,fra_regalo,,fra_fecha_entrega,fra_nombre_prov,fra_contacto_nom,fra_email_prov', 'required', 'on' => 'insert'),
			array('fra_nombre,fra_identificacion,fra_vicepresidencia,fra_area,fra_cargo,fra_email,fra_telefono,fra_ciudad,fra_sede_entrega,fra_regalo,fra_detalle_regalo,fra_fecha_entrega,fra_nombre_prov,fra_contacto_nom,fra_email_prov', 'safe'),
            // array('fra_identificacion_persona,fra_reportante_identificacion', 'numerical', 'integerOnly' => true, 'on' => 'insert'),

			// array('fra_nombre_persona,fra_nombre_persona', 'match' , 'pattern'=> '/^[A-Za-zñÑáÁéÉíÍóÓúÚ\d_\s]$/i', 'message'=> 'Este campo solo puede contener texto'),
			// array('fra_nombre_persona', 'match' , 'pattern'=> '/^([a-z ñáéíóú][0-9])$/i', 'message'=> 'Este campo no puede contener caracteres especiales'),
			//array('fra_email', 'email', 'message' => 'Este campo debe contener una dirección de correo electrónico válida'),
			// array('fra_codigo_postal', 'match' , 'pattern'=> '/^[0-9]{5,5}([- ]?[0-9]{4,4})?$/', 'message'=> 'El código postal no es válido'),
			// array('fra_direccion', 'match' , 'pattern'=> '[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?)*', 'message'=> 'La dirección es inválida'),
			// array('fra_telefono', 'match' , 'pattern'=> '/^(\(?[0-9]{3,3}\)?|[0-9]{3,3}[-. ]?)[ ][0-9]{3,3}[-. ]?[0-9]{4,4}$/', 'message'=> 'El número de teléfono no es válido'),
			
			// array('farchivo', 'file', 'types'=>'pdf, doc, docx, jpg, jpeg, png, gif', 'maxSize'=>1024*1024*3, 'tooLarge'=>'El archivo no puede exceder los 3MB.', 'allowEmpty'=>false),
			// array('fra_file','file', 'maxFiles'=>5, 'on'=>'insert','message'=>'El número máximo de archivos a subir es 5'),
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
            'formularioEmpresa' => array(self::BELONGS_TO, 'Empresa', 'fra_empresa_id'),
            // 'formularioClase' => array(self::BELONGS_TO, 'Clase', 'fra_clase_id'),
            // 'formularioCanal' => array(self::BELONGS_TO, 'Canal', 'fra_canal_id'),
            // 'formularioTipo' => array(self::BELONGS_TO, 'Tipo', 'fra_tipo_id'),
            // 'formularioAccion' => array(self::BELONGS_TO, 'Accion', 'fra_accion_id'),
            'formularioPais' => array(self::BELONGS_TO, 'Pais', 'fra_pais_id'),
            'formularioDepartamento' => array(self::BELONGS_TO, 'Departamento', 'fra_departamento_id'),
            'formularioCiudad' => array(self::BELONGS_TO, 'Ciudad', 'fra_ciudad_id'),
            //'formularioRadicado' => array(self::BELONGS_TO, 'Formulario', 'fra_complemento_id'),
			
//			'userProfileImg' => array(self::BELONGS_TO, 'MvcAttachment', 'pic_profile_id'),
        );
    }


	 /****************************************************************************
	 ************ FUNCIONES DE PRUEBAS TRATANDO DE FILTRAR fra_radicado **********
	 *****************************************************************************/
	/*
	public function fields()
	{
		return array(
			// field name is "name", its value is defined by a PHP callback
           'fra_id',
            'fra_radicado',
            'fra_empresa_id',
            'fra_complemento',
            'fra_complemento_id',
            'fra_tipo_identificacion_id',
            'fra_identificacion_persona',
            'fra_nombre_persona',
            'fra_sucursal_operacion',
            'fra_pais_id',
            'fra_departamento_id',
            'fra_ciudad_id',
            'fra_direccion',
            'fra_telefono',
			'fra_codigo_postal',
            'fra_grupo_interes_id',
            'fra_grupo_interes_otro',
            'fra_tipo_operacion_id',
            'fra_tipo_operacion_otro',
            'fra_persona',
            'fra_descripcion_consulta',
            'fra_fecha_declaracion',
            'fra_fecha_cierre',
            'fra_producto_id',
            'fra_otros_datos_contacto',
            'fra_file',
            'fra_prueba',
            'fra_estado_id',
            'fra_usuario_id',
			'fra_visitante',
			'fra_radicado' => function () {
				return Controller::sincifrar($this->fra_radicado);
			},
		);
	}
	*/
	
	/*
	public function fields()
	{
		$fields = parent::fields();

		// remove fields that contain sensitive information
		 $fields['fra_radicado'] = $this->sincifrar($fields['fra_radicado']);

		return $fields;
	}
	*/
	
     /*
	 public function getRadicado(){
          return  Controller::sincifrar($this->fra_radicado);
     }
	 */
	 
	 /****************************************************************************/
	 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'fra_id' => 'Form',
            'fra_empresa_id' => 'Empresa',
            'fra_radicado' => 'Radicado',
            'fra_tipo_identificacion_id' => 'Tipo de identificación',
            'fra_identificacion' => 'Identificación ',
            'fra_nombre' => 'Nombre',
			'fra_vicepresidencia' => 'Vicepresidencia',	
			'fra_area' => 'Area',
			'fra_cargo' => 'Cargo',
            'fra_ciudad' => 'Ciudad',
            'fra_email' => 'Correo electrónico',
            'fra_telefono' => 'Teléfono',
            'fra_fecha_declaracion' => 'Fecha declaración',
			'fra_sede_entrega' => 'Sede donde se entrega el regalo que recibiste',
			'fra_regalo' => '¿Qué regalo o atención recibiste? ',
			'fra_detalle_regalo' => 'Detalle del regalo o atención',
			'fra_fecha_entrega' => 'Fecha de entrega del regalo a la Compañía',
			'fra_nombre_prov' => 'Nombre del proveedor que envió el regalo',
			'fra_contacto_nom' => 'Nombre contacto del proveedor',
			'fra_email_prov' => 'Correo electrónico del Proveedor ',
            'fra_estado_id' => 'Estado',
            'fra_usuario' => 'Usuario',
            'fra_usuario_id' => 'Estado usuario',
			'fra_visitante' => 'Datos visitante',
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

        $criteria->compare('fra_id', $this->fra_id);
        $criteria->compare('fra_radicado', $this->fra_radicado, true);
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
