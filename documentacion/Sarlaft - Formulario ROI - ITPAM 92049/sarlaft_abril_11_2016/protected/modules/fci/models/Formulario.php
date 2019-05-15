<?php

/**
 * This is the model class for table "tbl_formulario_fci".
 *
 * The followings are the available columns in table 'tbl_formulario_fci':
 * @property integer $fci_id
 * @property string $fci_radicado
 * @property string $fci_empresa_id
 * @property string $fci_tipo_identificacion_id
 * @property string $fci_identificacion_persona
 * @property string $fci_nombre_persona
 * @property string $fci_pais_id
 * @property string $fci_departamento_id
 * @property string $fci_ciudad_id
 * @property string $fci_email
 * @property string $fci_telefono
 * @property string $fci_existe_conflicto
 * @property string $fci_identificacion_persona_conflicto
 * @property string $fci_nombre_persona_conflicto
 * @property string $fci_parentesco
 * @property string $fci_identificacion_empresa_conflicto
 * @property string $fci_nombre_empresa_conflicto
 * @property string $fci_actividad_empresa_conflicto
 * @property string $fci_declaracion_conflicto
 * @property string $fci_fecha_declaracion
 * @property string $fci_estado_id
 * @property integer $fci_usuario
 * @property integer $fci_prueba
 * @property string $fci_ip
 * @property integer $fci_usuario_id
 * @property string $fci_visitante
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
        return 'tbl_formulario_fci';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('fci_nombre_persona,fci_identificacion_persona', 'required', 'on' => 'insert'),
			array('fci_empresa_id,fci_tipo_identificacion_id,fci_pais_id,fci_departamento_id,fci_ciudad_id,fci_email,fci_telefono,fci_existe_conflicto,fci_nombre_persona_conflicto,fci_tipo_identificacion_persona_conflicto_id,fci_identificacion_persona_conflicto,fci_parentesco,fci_nombre_empresa_conflicto,fci_identificacion_empresa_conflicto,fci_actividad_empresa_conflicto,fci_declaracion_conflicto,fci_estado_id', 'safe'),
            // array('fci_identificacion_persona,fci_reportante_identificacion', 'numerical', 'integerOnly' => true, 'on' => 'insert'),

			// array('fci_nombre_persona,fci_nombre_persona', 'match' , 'pattern'=> '/^[A-Za-zñÑáÁéÉíÍóÓúÚ\d_\s]$/i', 'message'=> 'Este campo solo puede contener texto'),
			// array('fci_nombre_persona', 'match' , 'pattern'=> '/^([a-z ñáéíóú][0-9])$/i', 'message'=> 'Este campo no puede contener caracteres especiales'),
			//array('fci_email', 'email', 'message' => 'Este campo debe contener una dirección de correo electrónico válida'),
			// array('fci_codigo_postal', 'match' , 'pattern'=> '/^[0-9]{5,5}([- ]?[0-9]{4,4})?$/', 'message'=> 'El código postal no es válido'),
			// array('fci_direccion', 'match' , 'pattern'=> '[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?)*', 'message'=> 'La dirección es inválida'),
			// array('fci_telefono', 'match' , 'pattern'=> '/^(\(?[0-9]{3,3}\)?|[0-9]{3,3}[-. ]?)[ ][0-9]{3,3}[-. ]?[0-9]{4,4}$/', 'message'=> 'El número de teléfono no es válido'),
			
			// array('farchivo', 'file', 'types'=>'pdf, doc, docx, jpg, jpeg, png, gif', 'maxSize'=>1024*1024*3, 'tooLarge'=>'El archivo no puede exceder los 3MB.', 'allowEmpty'=>false),
			// array('fci_file','file', 'maxFiles'=>5, 'on'=>'insert','message'=>'El número máximo de archivos a subir es 5'),
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
            'formularioEmpresa' => array(self::BELONGS_TO, 'Empresa', 'fci_empresa_id'),
            // 'formularioClase' => array(self::BELONGS_TO, 'Clase', 'fci_clase_id'),
            // 'formularioCanal' => array(self::BELONGS_TO, 'Canal', 'fci_canal_id'),
            // 'formularioTipo' => array(self::BELONGS_TO, 'Tipo', 'fci_tipo_id'),
            // 'formularioAccion' => array(self::BELONGS_TO, 'Accion', 'fci_accion_id'),
            'formularioPais' => array(self::BELONGS_TO, 'Pais', 'fci_pais_id'),
            'formularioDepartamento' => array(self::BELONGS_TO, 'Departamento', 'fci_departamento_id'),
            'formularioCiudad' => array(self::BELONGS_TO, 'Ciudad', 'fci_ciudad_id'),
            //'formularioRadicado' => array(self::BELONGS_TO, 'Formulario', 'fci_complemento_id'),
			
//			'userProfileImg' => array(self::BELONGS_TO, 'MvcAttachment', 'pic_profile_id'),
        );
    }


	 /****************************************************************************
	 ************ FUNCIONES DE PRUEBAS TRATANDO DE FILTRAR fci_radicado **********
	 *****************************************************************************/
	/*
	public function fields()
	{
		return array(
			// field name is "name", its value is defined by a PHP callback
           'fci_id',
            'fci_radicado',
            'fci_empresa_id',
            'fci_complemento',
            'fci_complemento_id',
            'fci_tipo_identificacion_id',
            'fci_identificacion_persona',
            'fci_nombre_persona',
            'fci_sucursal_operacion',
            'fci_pais_id',
            'fci_departamento_id',
            'fci_ciudad_id',
            'fci_direccion',
            'fci_telefono',
			'fci_codigo_postal',
            'fci_grupo_interes_id',
            'fci_grupo_interes_otro',
            'fci_tipo_operacion_id',
            'fci_tipo_operacion_otro',
            'fci_persona',
            'fci_descripcion_consulta',
            'fci_fecha_declaracion',
            'fci_fecha_cierre',
            'fci_producto_id',
            'fci_otros_datos_contacto',
            'fci_file',
            'fci_prueba',
            'fci_estado_id',
            'fci_usuario_id',
			'fci_visitante',
			'fci_radicado' => function () {
				return Controller::sincifrar($this->fci_radicado);
			},
		);
	}
	*/
	
	/*
	public function fields()
	{
		$fields = parent::fields();

		// remove fields that contain sensitive information
		 $fields['fci_radicado'] = $this->sincifrar($fields['fci_radicado']);

		return $fields;
	}
	*/
	
     /*
	 public function getRadicado(){
          return  Controller::sincifrar($this->fci_radicado);
     }
	 */
	 
	 /****************************************************************************/
	 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'fci_id' => 'Form',
            'fci_empresa_id' => 'Empresa',
            'fci_radicado' => 'Radicado',
            'fci_tipo_identificacion_id' => 'Tipo de identificación',
            'fci_identificacion_persona' => 'Identificación ',
            'fci_nombre_persona' => 'Nombre',
            'fci_pais_id' => 'País',
            'fci_departamento_id' => 'Departamento',
            'fci_ciudad_id' => 'Ciudad',
            'fci_email' => 'Correo electrónico',
            'fci_telefono' => 'Teléfono',
            'fci_existe_conflicto' => 'Existe conflicto',
            'fci_nombre_persona_conflicto' => 'Nombre de la persona con la que se tiene un posible conflicto de intereses',
            'fci_identificacion_persona_conflicto' => 'Rut/Nit/Cedula ',
			'fci_parentesco' => 'Parentesco',
            'fci_nombre_empresa_conflicto' => 'Nombre de la empresa relacionada',
            'fci_identificacion_empresa_conflicto' => 'Rut/Nit',
            'fci_actividad_empresa_conflicto' => 'Actividad de la empresa',
            'fci_declaracion_conflicto' => 'Declaración o posible conflicto de intereses',			
            'fci_fecha_declaracion' => 'Fecha declaración',
			'fci_prueba' => 'Prueba',
            'fci_estado_id' => 'Estado',
            'fci_usuario' => 'Usuario',
            'fci_usuario_id' => 'Estado usuario',
			'fci_visitante' => 'Datos visitante',
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

        $criteria->compare('fci_id', $this->fci_id);
        $criteria->compare('fci_radicado', $this->fci_radicado, true);
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
