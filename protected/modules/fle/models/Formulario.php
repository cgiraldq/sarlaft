<?php

/**
 * This is the model class for table "tbl_formulario_fle".
 *
 * The followings are the available columns in table 'tbl_formulario_fle':
 * @property integer $fle_id
 * @property string $fle_radicado
 * @property string $fle_empresa_id
 * @property string $fle_nombre_persona
 * @property string $fle_pais_id
 * @property string $fle_departamento_id
 * @property string $fle_ciudad_id
 * @property string $fle_descripcion_consulta
 * @property string $fle_fecha_ocurrencia
 * @property string $fle_fecha_cierre
 * @property string $fle_otros_datos_contacto
 * @property string $fle_reportante_nombre
 * @property integer $fle_prueba
 * @property string $fle_estado_id
 * @property integer $fle_usuario_id
 * @property string $fle_visitante
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
        return 'tbl_formulario_fle';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('fle_descripcion_consulta,fle_fecha_ocurrencia,fle_nombre_persona,fle_empresa_id,fle_ciudad_id', 'required', 'on' => 'insert'),
			array('fle_reportante_nombre,fle_pais_id,fle_departamento_id,fle_otros_datos_contacto,fle_estado_id', 'safe'),
            // array('fle_identificacion_persona,fle_reportante_identificacion', 'numerical', 'integerOnly' => true, 'on' => 'insert'),

			// array('fle_nombre_persona,fle_reportante_nombre', 'match' , 'pattern'=> '/^[A-Za-zñÑáÁéÉíÍóÓúÚ\d_\s]$/i', 'message'=> 'Este campo solo puede contener texto'),
			// array('fle_sucursal_operacion,fle_grupo_interes_otro,fle_tipo_operacion_otro,fle_otros_datos_contacto', 'match' , 'pattern'=> '/^([a-z ñáéíóú][0-9])$/i', 'message'=> 'Este campo no puede contener caracteres especiales'),
			// array('fle_codigo_postal', 'match' , 'pattern'=> '/^[0-9]{5,5}([- ]?[0-9]{4,4})?$/', 'message'=> 'El código postal no es válido'),
			// array('fle_direccion', 'match' , 'pattern'=> '[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?)*', 'message'=> 'La dirección es inválida'),
			// array('fle_telefono', 'match' , 'pattern'=> '/^(\(?[0-9]{3,3}\)?|[0-9]{3,3}[-. ]?)[ ][0-9]{3,3}[-. ]?[0-9]{4,4}$/', 'message'=> 'El número de teléfono no es válido'),
			
			// array('farchivo', 'file', 'types'=>'pdf, doc, docx, jpg, jpeg, png, gif', 'maxSize'=>1024*1024*3, 'tooLarge'=>'El archivo no puede exceder los 3MB.', 'allowEmpty'=>false),
			// array('fle_file','file', 'maxFiles'=>5, 'on'=>'insert','message'=>'El número máximo de archivos a subir es 5'),
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
            'formularioEmpresa' => array(self::BELONGS_TO, 'Empresa', 'fle_empresa_id'),
            // 'formularioClase' => array(self::BELONGS_TO, 'Clase', 'fle_clase_id'),
            // 'formularioCanal' => array(self::BELONGS_TO, 'Canal', 'fle_canal_id'),
            // 'formularioTipo' => array(self::BELONGS_TO, 'Tipo', 'fle_tipo_id'),
            // 'formularioAccion' => array(self::BELONGS_TO, 'Accion', 'fle_accion_id'),
            'formularioPais' => array(self::BELONGS_TO, 'Pais', 'fle_pais_id'),
            'formularioDepartamento' => array(self::BELONGS_TO, 'Departamento', 'fle_departamento_id'),
            'formularioCiudad' => array(self::BELONGS_TO, 'Ciudad', 'fle_ciudad_id'),
            //'formularioRadicado' => array(self::BELONGS_TO, 'Formulario', 'fle_complemento_id'),
			
//			'userProfileImg' => array(self::BELONGS_TO, 'MvcAttachment', 'pic_profile_id'),
        );
    }


	 /****************************************************************************
	 ************ FUNCIONES DE PRUEBAS TRATANDO DE FILTRAR fle_radicado **********
	 *****************************************************************************/
	/*
	public function fields()
	{
		return array(
			// field name is "name", its value is defined by a PHP callback
           'fle_id',
            'fle_radicado',
            'fle_empresa_id',
            'fle_complemento',
            'fle_complemento_id',
            'fle_tipo_identificacion_id',
            'fle_identificacion_persona',
            'fle_nombre_persona',
            'fle_sucursal_operacion',
            'fle_pais_id',
            'fle_departamento_id',
            'fle_ciudad_id',
            'fle_direccion',
            'fle_telefono',
			'fle_codigo_postal',
            'fle_grupo_interes_id',
            'fle_grupo_interes_otro',
            'fle_tipo_operacion_id',
            'fle_tipo_operacion_otro',
            'fle_persona',
            'fle_descripcion_consulta',
            'fle_fecha_ocurrencia',
            'fle_fecha_cierre',
            'fle_producto_id',
            'fle_otros_datos_contacto',
			'fle_reportante_nombre',
            'fle_file',
            'fle_prueba',
            'fle_estado_id',
            'fle_usuario_id',
			'fle_visitante',
			'fle_radicado' => function () {
				return Controller::sincifrar($this->fle_radicado);
			},
		);
	}
	*/
	
	/*
	public function fields()
	{
		$fields = parent::fields();

		// remove fields that contain sensitive information
		 $fields['fle_radicado'] = $this->sincifrar($fields['fle_radicado']);

		return $fields;
	}
	*/
	
     /*
	 public function getRadicado(){
          return  Controller::sincifrar($this->fle_radicado);
     }
	 */
	 
	 /****************************************************************************/
	 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'fle_id' => 'Form',
            'fle_empresa_id' => 'Empresa',
            'fle_nombre_persona' => 'Persona o área reportada',
            'fle_pais_id' => 'País',
            'fle_departamento_id' => 'Departamento',
            'fle_ciudad_id' => 'Ciudad',
            'fle_descripcion_consulta' => 'Descripción de la consulta o reporte',
            'fle_fecha_ocurrencia' => 'Fecha ocurrencia',
            'fle_otros_datos_contacto' => 'Otros datos de contacto',
			'fle_reportante_nombre' => 'Nombre completo',
			'fle_prueba' => 'Prueba',
            'fle_estado_id' => 'Estado',
            'fle_usuario_id' => 'Estado usuario',
			'fle_visitante' => 'Datos visitante',
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

        $criteria->compare('fle_id', $this->fle_id);
        $criteria->compare('fle_radicado', $this->fle_radicado, true);
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
