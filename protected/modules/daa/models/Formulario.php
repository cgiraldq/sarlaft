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
        return 'tbl_formulario_daa';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('daa_nombre,daa_identificacion,daa_email,daa_just_has_ofre,daa_just_han_ofre,daa_just_rela_tigoune,daa_certifica', 'required', 'on' => 'insert'),
			array('daa_nombre,daa_area,daa_cargo,daa_identificacion,daa_vicepresidencia,daa_tipo_identificacion_id,daa_pais_id,daa_departamento_id,daa_ciudad_id,daa_email,daa_telefono,daa_estado_id,daa_certifica', 'safe'),
            // array('daa_identificacion_persona,daa_reportante_identificacion', 'numerical', 'integerOnly' => true, 'on' => 'insert'),

			// array('daa_nombre_persona,daa_nombre_persona', 'match' , 'pattern'=> '/^[A-Za-zñÑáÁéÉíÍóÓúÚ\d_\s]$/i', 'message'=> 'Este campo solo puede contener texto'),
			// array('daa_nombre_persona', 'match' , 'pattern'=> '/^([a-z ñáéíóú][0-9])$/i', 'message'=> 'Este campo no puede contener caracteres especiales'),
			//array('daa_email', 'email', 'message' => 'Este campo debe contener una dirección de correo electrónico válida'),
			// array('daa_codigo_postal', 'match' , 'pattern'=> '/^[0-9]{5,5}([- ]?[0-9]{4,4})?$/', 'message'=> 'El código postal no es válido'),
			// array('daa_direccion', 'match' , 'pattern'=> '[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?)*', 'message'=> 'La dirección es inválida'),
			// array('daa_telefono', 'match' , 'pattern'=> '/^(\(?[0-9]{3,3}\)?|[0-9]{3,3}[-. ]?)[ ][0-9]{3,3}[-. ]?[0-9]{4,4}$/', 'message'=> 'El número de teléfono no es válido'),
			
			// array('farchivo', 'file', 'types'=>'pdf, doc, docx, jpg, jpeg, png, gif', 'maxSize'=>1024*1024*3, 'tooLarge'=>'El archivo no puede exceder los 3MB.', 'allowEmpty'=>false),
			// array('daa_file','file', 'maxFiles'=>5, 'on'=>'insert','message'=>'El número máximo de archivos a subir es 5'),
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
            'formularioEmpresa' => array(self::BELONGS_TO, 'Empresa', 'daa_empresa_id'),
            // 'formularioClase' => array(self::BELONGS_TO, 'Clase', 'daa_clase_id'),
            // 'formularioCanal' => array(self::BELONGS_TO, 'Canal', 'daa_canal_id'),
            // 'formularioTipo' => array(self::BELONGS_TO, 'Tipo', 'daa_tipo_id'),
            // 'formularioAccion' => array(self::BELONGS_TO, 'Accion', 'daa_accion_id'),
            'formularioPais' => array(self::BELONGS_TO, 'Pais', 'daa_pais_id'),
            'formularioDepartamento' => array(self::BELONGS_TO, 'Departamento', 'daa_departamento_id'),
            'formularioCiudad' => array(self::BELONGS_TO, 'Ciudad', 'daa_ciudad_id'),
            //'formularioRadicado' => array(self::BELONGS_TO, 'Formulario', 'daa_complemento_id'),
			
//			'userProfileImg' => array(self::BELONGS_TO, 'MvcAttachment', 'pic_profile_id'),
        );
    }


	 /****************************************************************************
	 ************ FUNCIONES DE PRUEBAS TRATANDO DE FILTRAR daa_radicado **********
	 *****************************************************************************/
	/*
	public function fields()
	{
		return array(
			// field name is "name", its value is defined by a PHP callback
           'daa_id',
            'daa_radicado',
            'daa_empresa_id',
            'daa_complemento',
            'daa_complemento_id',
            'daa_tipo_identificacion_id',
            'daa_identificacion_persona',
            'daa_nombre_persona',
            'daa_sucursal_operacion',
            'daa_pais_id',
            'daa_departamento_id',
            'daa_ciudad_id',
            'daa_direccion',
            'daa_telefono',
			'daa_codigo_postal',
            'daa_grupo_interes_id',
            'daa_grupo_interes_otro',
            'daa_tipo_operacion_id',
            'daa_tipo_operacion_otro',
            'daa_persona',
            'daa_descripcion_consulta',
            'daa_fecha_declaracion',
            'daa_fecha_cierre',
            'daa_producto_id',
            'daa_otros_datos_contacto',
            'daa_file',
            'daa_prueba',
            'daa_estado_id',
            'daa_usuario_id',
			'daa_visitante',
			'daa_radicado' => function () {
				return Controller::sincifrar($this->daa_radicado);
			},
		);
	}
	*/
	
	/*
	public function fields()
	{
		$fields = parent::fields();

		// remove fields that contain sensitive information
		 $fields['daa_radicado'] = $this->sincifrar($fields['daa_radicado']);

		return $fields;
	}
	*/
	
     /*
	 public function getRadicado(){
          return  Controller::sincifrar($this->daa_radicado);
     }
	 */
	 
	 /****************************************************************************/
	 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'daa_id' => 'Form',
            'daa_radicado' => 'Radicado',
            'daa_tipo_identificacion_id' => 'Tipo de identificación',
            'daa_identificacion' => 'Identificación ',
            'daa_nombre' => 'Nombre',
			'daa_vicepresidencia' => 'Vicepresidencia',	
			'daa_area' => 'Area',
			'daa_cargo' => 'Cargo',
            'daa_email' => 'Correo electrónico',
            'daa_telefono' => 'Teléfono',
            'daa_fecha_declaracion' => 'Fecha declaración',
            'daa_certifica' => 'Certifica',
			'daa_has_ofrecido' => '',
			'daa_just_has_ofre' => 'Justificación',
			'daa_te_han_ofrecido' => '',
			'daa_just_han_ofre' => 'Justificación',
			'daa_relacion_tigoune' => '',
			'daa_just_rela_tigoune' => 'Justificación',		 
            'daa_estado_id' => 'Estado',
            'daa_usuario' => 'Usuario',
            'daa_usuario_id' => 'Estado usuario',
			'daa_visitante' => 'Datos visitante',
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

        $criteria->compare('daa_id', $this->daa_id);
        $criteria->compare('daa_radicado', $this->daa_radicado, true);
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
