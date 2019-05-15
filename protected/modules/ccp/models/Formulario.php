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
        return 'tbl_formulario_ccp';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ccp_razon_social,ccp_nit,ccp_representante,ccp_id_representante,ccp_nom_prov,ccp_id_prov,ccp_tel_prov,ccp_email_prov,ccp_pais_id,ccp_departamento_id,ccp_ciudad_id,ccp_nombre_tigoune,ccp_email_tigoune,ccp_certifica,ccp_observaciones', 'required', 'on' => 'insert'),
			array('ccp_razon_social,ccp_nit,ccp_representante,ccp_id_representante,ccp_nom_prov,ccp_id_prov,ccp_tel_prov,ccp_email_prov,ccp_pais_id,ccp_departamento_id,ccp_ciudad_id,ccp_nombre_tigoune,ccp_email_tigoune,ccp_certifica,ccp_observaciones', 'safe'),
            // array('ccp_identificacion_persona,ccp_reportante_identificacion', 'numerical', 'integerOnly' => true, 'on' => 'insert'),

			// array('ccp_nombre_persona,ccp_nombre_persona', 'match' , 'pattern'=> '/^[A-Za-zñÑáÁéÉíÍóÓúÚ\d_\s]$/i', 'message'=> 'Este campo solo puede contener texto'),
			// array('ccp_nombre_persona', 'match' , 'pattern'=> '/^([a-z ñáéíóú][0-9])$/i', 'message'=> 'Este campo no puede contener caracteres especiales'),
			//array('ccp_email', 'email', 'message' => 'Este campo debe contener una dirección de correo electrónico válida'),
			// array('ccp_codigo_postal', 'match' , 'pattern'=> '/^[0-9]{5,5}([- ]?[0-9]{4,4})?$/', 'message'=> 'El código postal no es válido'),
			// array('ccp_direccion', 'match' , 'pattern'=> '[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?)*', 'message'=> 'La dirección es inválida'),
			// array('ccp_telefono', 'match' , 'pattern'=> '/^(\(?[0-9]{3,3}\)?|[0-9]{3,3}[-. ]?)[ ][0-9]{3,3}[-. ]?[0-9]{4,4}$/', 'message'=> 'El número de teléfono no es válido'),
			
			// array('farchivo', 'file', 'types'=>'pdf, doc, docx, jpg, jpeg, png, gif', 'maxSize'=>1024*1024*3, 'tooLarge'=>'El archivo no puede exceder los 3MB.', 'allowEmpty'=>false),
			// array('ccp_file','file', 'maxFiles'=>5, 'on'=>'insert','message'=>'El número máximo de archivos a subir es 5'),
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
            //'formularioEmpresa' => array(self::BELONGS_TO, 'Empresa', 'ccp_empresa_id'),
            // 'formularioClase' => array(self::BELONGS_TO, 'Clase', 'ccp_clase_id'),
            // 'formularioCanal' => array(self::BELONGS_TO, 'Canal', 'ccp_canal_id'),
            // 'formularioTipo' => array(self::BELONGS_TO, 'Tipo', 'ccp_tipo_id'),
            // 'formularioAccion' => array(self::BELONGS_TO, 'Accion', 'ccp_accion_id'),
            'formularioPais' => array(self::BELONGS_TO, 'Pais', 'ccp_pais_id'),
            'formularioDepartamento' => array(self::BELONGS_TO, 'Departamento', 'ccp_departamento_id'),
            'formularioCiudad' => array(self::BELONGS_TO, 'Ciudad', 'ccp_ciudad_id'),
            //'formularioRadicado' => array(self::BELONGS_TO, 'Formulario', 'ccp_complemento_id'),
			
//			'userProfileImg' => array(self::BELONGS_TO, 'MvcAttachment', 'pic_profile_id'),
        );
    }


	 /****************************************************************************
	 ************ FUNCIONES DE PRUEBAS TRATANDO DE FILTRAR ccp_radicado **********
	 *****************************************************************************/
	/*
	public function fields()
	{
		return array(
			// field name is "name", its value is defined by a PHP callback
           'ccp_id',
	   'ccp_nombre',
            'ccp_radicado',
           
            'ccp_complemento',
            'ccp_complemento_id',
            'ccp_tipo_identificacion_id',
            'ccp_identificacion_persona',
            'ccp_nombre_persona',
            'ccp_sucursal_operacion',
            'ccp_pais_id',
            'ccp_departamento_id',
            'ccp_ciudad_id',
            'ccp_direccion',
            'ccp_telefono',
			'ccp_codigo_postal',
            'ccp_grupo_interes_id',
            'ccp_grupo_interes_otro',
            'ccp_tipo_operacion_id',
            'ccp_tipo_operacion_otro',
            'ccp_persona',
            'ccp_descripcion_consulta',
            'ccp_fecha_cierre',
            'ccp_producto_id',
            'ccp_otros_datos_contacto',
            'ccp_file',
            'ccp_prueba',
            'ccp_estado_id',
            'ccp_usuario_id',
			'ccp_visitante',
			'ccp_radicado' => function () {
				return Controller::sincifrar($this->ccp_radicado);
			},
		);
	}
	*/
	
	/*
	public function fields()
	{
		$fields = parent::fields();

		// remove fields that contain sensitive information
		 $fields['ccp_radicado'] = $this->sincifrar($fields['ccp_radicado']);

		return $fields;
	}
	*/
	
     /*
	 public function getRadicado(){
          return  Controller::sincifrar($this->ccp_radicado);
     }
	 */
	 
	 /****************************************************************************/
	 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
			 'ccp_id' => 'Form',
			 'ccp_radicado' => 'Radicado',
			 'ccp_razon_social' => 'Razón Social<br><p style="font-size:9px;  padding: 0;">(Nombre completo en caso de que sea persona natural)</p>',
			 'ccp_nit' => 'Nit<br><p style="font-size:9px;  padding: 0;">(Cédula en caso de que sea persona natural)</p>',
			 'ccp_representante' => 'Nombres y apellidos representante legal',
			 'ccp_id_representante' => 'Identificación representante legal',
			 'ccp_nom_prov' => 'Nombre',
			 'ccp_id_prov' => 'Identificación',
			 'ccp_tel_prov' => 'Telefono',
			 'ccp_email_prov' => 'Correo Electronico',
			 'ccp_pais_id' => 'Pais',
			 'ccp_departamento_id'  => 'Departamento',
			 'ccp_ciudad_id'  => 'Ciudad',
			 'ccp_nombre_tigoune' => 'Nombre',
			 'ccp_email_tigoune' => 'Correo Electronico',
             'ccp_certifica' => 'Certifica',
             'ccp_observaciones' => 'Observaciones',
			
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

        $criteria->compare('ccp_id', $this->ccp_id);
        $criteria->compare('ccp_radicado', $this->ccp_radicado, true);
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
