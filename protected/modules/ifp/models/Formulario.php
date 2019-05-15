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
        return 'tbl_formulario_ifp';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ifp_nombre,ifp_identificacion,ifp_vicepresidencia,ifp_area,ifp_cargo,ifp_email,ifp_telefono,ifp_ciudad,ifp_jefe_inmediato,ifp_fecha_reunion,ifp_entidad,ifp_nit_entidad,ifp_num_participantes,ifp_proposito,ifp_desc_temas', 'required', 'on' => 'insert'),
			array('ifp_nombre,ifp_identificacion,ifp_vicepresidencia,ifp_area,ifp_cargo,ifp_email,ifp_telefono,ifp_ciudad,ifp_jefe_inmediato,ifp_fecha_reunion,ifp_entidad,ifp_nit_entidad,ifp_num_participantes,ifp_participantes_entidad,ifp_particpantes_tigoune,ifp_proposito,ifp_desc_temas,ifp_reporte', 'safe'),
            // array('ifp_identificacion_persona,ifp_reportante_identificacion', 'numerical', 'integerOnly' => true, 'on' => 'insert'),

			// array('ifp_nombre_persona,ifp_nombre_persona', 'match' , 'pattern'=> '/^[A-Za-zñÑáÁéÉíÍóÓúÚ\d_\s]$/i', 'message'=> 'Este campo solo puede contener texto'),
			// array('ifp_nombre_persona', 'match' , 'pattern'=> '/^([a-z ñáéíóú][0-9])$/i', 'message'=> 'Este campo no puede contener caracteres especiales'),
			//array('ifp_email', 'email', 'message' => 'Este campo debe contener una dirección de correo electrónico válida'),
			// array('ifp_codigo_postal', 'match' , 'pattern'=> '/^[0-9]{5,5}([- ]?[0-9]{4,4})?$/', 'message'=> 'El código postal no es válido'),
			// array('ifp_direccion', 'match' , 'pattern'=> '[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?)*', 'message'=> 'La dirección es inválida'),
			// array('ifp_telefono', 'match' , 'pattern'=> '/^(\(?[0-9]{3,3}\)?|[0-9]{3,3}[-. ]?)[ ][0-9]{3,3}[-. ]?[0-9]{4,4}$/', 'message'=> 'El número de teléfono no es válido'),
			
			// array('farchivo', 'file', 'types'=>'pdf, doc, docx, jpg, jpeg, png, gif', 'maxSize'=>1024*1024*3, 'tooLarge'=>'El archivo no puede exceder los 3MB.', 'allowEmpty'=>false),
			// array('ifp_file','file', 'maxFiles'=>5, 'on'=>'insert','message'=>'El número máximo de archivos a subir es 5'),
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
            'formularioEmpresa' => array(self::BELONGS_TO, 'Empresa', 'ifp_empresa_id'),
            // 'formularioClase' => array(self::BELONGS_TO, 'Clase', 'ifp_clase_id'),
            // 'formularioCanal' => array(self::BELONGS_TO, 'Canal', 'ifp_canal_id'),
            // 'formularioTipo' => array(self::BELONGS_TO, 'Tipo', 'ifp_tipo_id'),
            // 'formularioAccion' => array(self::BELONGS_TO, 'Accion', 'ifp_accion_id'),
            'formularioPais' => array(self::BELONGS_TO, 'Pais', 'ifp_pais_id'),
            'formularioDepartamento' => array(self::BELONGS_TO, 'Departamento', 'ifp_departamento_id'),
            'formularioCiudad' => array(self::BELONGS_TO, 'Ciudad', 'ifp_ciudad_id'),
            //'formularioRadicado' => array(self::BELONGS_TO, 'Formulario', 'ifp_complemento_id'),
			
//			'userProfileImg' => array(self::BELONGS_TO, 'MvcAttachment', 'pic_profile_id'),
        );
    }


	 /****************************************************************************
	 ************ FUNCIONES DE PRUEBAS TRATANDO DE FILTRAR ifp_radicado **********
	 *****************************************************************************/
	/*
	public function fields()
	{
		return array(
			// field name is "name", its value is defined by a PHP callback
           'ifp_id',
            'ifp_radicado',
            'ifp_empresa_id',
            'ifp_complemento',
            'ifp_complemento_id',
            'ifp_tipo_identificacion_id',
            'ifp_identificacion_persona',
            'ifp_nombre_persona',
            'ifp_sucursal_operacion',
            'ifp_pais_id',
            'ifp_departamento_id',
            'ifp_ciudad_id',
            'ifp_direccion',
            'ifp_telefono',
			'ifp_codigo_postal',
            'ifp_grupo_interes_id',
            'ifp_grupo_interes_otro',
            'ifp_tipo_operacion_id',
            'ifp_tipo_operacion_otro',
            'ifp_persona',
            'ifp_descripcion_consulta',
            'ifp_fecha_declaracion',
            'ifp_fecha_cierre',
            'ifp_producto_id',
            'ifp_otros_datos_contacto',
            'ifp_file',
            'ifp_prueba',
            'ifp_estado_id',
            'ifp_usuario_id',
			'ifp_visitante',
			'ifp_radicado' => function () {
				return Controller::sincifrar($this->ifp_radicado);
			},
		);
	}
	*/
	
	/*
	public function fields()
	{
		$fields = parent::fields();

		// remove fields that contain sensitive information
		 $fields['ifp_radicado'] = $this->sincifrar($fields['ifp_radicado']);

		return $fields;
	}
	*/
	
     /*
	 public function getRadicado(){
          return  Controller::sincifrar($this->ifp_radicado);
     }
	 */
	 
	 /****************************************************************************/
	 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ifp_id' => 'Form',
            'ifp_radicado' => 'Radicado',
            'ifp_identificacion' => 'Identificación ',
            'ifp_nombre' => 'Nombre',
			'ifp_vicepresidencia' => 'Vicepresidencia',	
			'ifp_area' => 'Area',
			'ifp_cargo' => 'Cargo',
			'ifp_email' => 'Correo electrónico',
			 'ifp_telefono' => 'Teléfono',
            'ifp_ciudad' => 'Ciudad',
             'ifp_fecha_reunion' => 'Fecha de la Reunión',
			'ifp_entidad' => 'Nombre de la Entidad que Realiza la interacción',
			'ifp_nit_entidad' => 'Nit de la Entidad',
			'ifp_num_participantes' => 'Número de Participantes',
			'ifp_proposito' => '<b>Proposito de la Reunión</b>',
			'ifp_desc_temas' => 'Dar Detalle',
			'ifp_reporte' => 'Dar Detalle',
			'ifp_jefe_inmediato' => 'Jefe Inmediato',
            'ifp_estado_id' => 'Estado',
            'ifp_usuario' => 'Usuario',
            'ifp_usuario_id' => 'Estado usuario',
			'ifp_visitante' => 'Datos visitante',
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

        $criteria->compare('ifp_id', $this->ifp_id);
        $criteria->compare('ifp_radicado', $this->ifp_radicado, true);
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
