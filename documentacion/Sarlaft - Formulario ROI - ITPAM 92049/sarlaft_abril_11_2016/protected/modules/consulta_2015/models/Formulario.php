<?php

/**
 * This is the model class for table "tbl_formulario_consulta".
 *
 * The followings are the available columns in table 'tbl_formulario_consulta':
 * @property integer $consulta_id
 * @property string $consulta_nombre_persona
 * @property string $consulta_tipo_identificacion_id
 * @property string $consulta_identificacion_persona
 * @property string $consulta_fecha
 * @property integer $consulta_prueba
 * @property string $consulta_estado_id
 * @property integer $consulta_usuario_id
 * @property string $consulta_visitante
 *
 * The followings are the available model relations:
 * @property FormularioStatus $formularioStatus
 */
class Formulario extends CActiveRecord {

    public $file;
    public $validaCampos;
    public $modules;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_formulario_consulta';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('consulta_nombre_persona', 'required', 'on' => 'insert'),
            // array('consulta_identificacion_persona,consulta_reportante_identificacion', 'numerical', 'integerOnly' => true, 'on' => 'insert'),

			// array('consulta_nombre_persona,consulta_reportante_nombre', 'match' , 'pattern'=> '/^[A-Za-zñÑáÁéÉíÍóÓúÚ\d_\s]$/i', 'message'=> 'Este campo solo puede contener texto'),
			// array('consulta_sucursal_operacion,consulta_grupo_interes_otro,consulta_tipo_operacion_otro,consulta_otros_datos_contacto', 'match' , 'pattern'=> '/^([a-z ñáéíóú][0-9])$/i', 'message'=> 'Este campo no puede contener caracteres especiales'),
			// array('consulta_codigo_postal', 'match' , 'pattern'=> '/^[0-9]{5,5}([- ]?[0-9]{4,4})?$/', 'message'=> 'El código postal no es válido'),
			// array('consulta_direccion', 'match' , 'pattern'=> '[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?)*', 'message'=> 'La dirección es inválida'),
			// array('consulta_telefono', 'match' , 'pattern'=> '/^(\(?[0-9]{3,3}\)?|[0-9]{3,3}[-. ]?)[ ][0-9]{3,3}[-. ]?[0-9]{4,4}$/', 'message'=> 'El número de teléfono no es válido'),
			
			// array('farchivo', 'file', 'types'=>'pdf, doc, docx, jpg, jpeg, png, gif', 'maxSize'=>1024*1024*3, 'tooLarge'=>'El archivo no puede exceder los 3MB.', 'allowEmpty'=>false),
			// array('consulta_file','file', 'maxFiles'=>5, 'on'=>'insert','message'=>'El número máximo de archivos a subir es 5'),
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
        );
    }


	 /****************************************************************************
	 ************ FUNCIONES DE PRUEBAS TRATANDO DE FILTRAR consulta_radicado **********
	 *****************************************************************************/
	/*
	public function fields()
	{
		return array(
			// field name is "name", its value is defined by a PHP callback
           'consulta_id',
            'consulta_radicado',
            'consulta_empresa_id',
            'consulta_complemento',
            'consulta_complemento_id',
            'consulta_tipo_identificacion_id',
            'consulta_identificacion_persona',
            'consulta_nombre_persona',
            'consulta_sucursal_operacion',
            'consulta_pais_id',
            'consulta_departamento_id',
            'consulta_ciudad_id',
            'consulta_direccion',
            'consulta_telefono',
			'consulta_codigo_postal',
            'consulta_grupo_interes_id',
            'consulta_grupo_interes_otro',
            'consulta_tipo_operacion_id',
            'consulta_tipo_operacion_otro',
            'consulta_persona',
            'consulta_descripcion_consulta',
            'consulta_fecha_ocurrencia',
            'consulta_fecha_cierre',
            'consulta_producto_id',
            'consulta_otros_datos_contacto',
			'consulta_reportante_nombre',
            'consulta_file',
            'consulta_prueba',
            'consulta_estado_id',
            'consulta_usuario_id',
			'consulta_visitante',
			'consulta_radicado' => function () {
				return Controller::sincifrar($this->consulta_radicado);
			},
		);
	}
	*/
	
	/*
	public function fields()
	{
		$fields = parent::fields();

		// remove fields that contain sensitive information
		 $fields['consulta_radicado'] = $this->sincifrar($fields['consulta_radicado']);

		return $fields;
	}
	*/
	
     /*
	 public function getRadicado(){
          return  Controller::sincifrar($this->consulta_radicado);
     }
	 */
	 
	 /****************************************************************************/
	 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'consulta_id' => 'Form',
            'consulta_nombre_persona' => 'Nombre',
            'consulta_tipo_identificacion_id' => 'Tipo identificacion',
            'consulta_identificacion_persona' => 'Identificacion',
            'consulta_fecha' => 'Fecha',
			'consulta_prueba' => 'Prueba',
            'consulta_estado_id' => 'Estado',
            'consulta_usuario_id' => 'Estado usuario',
			'consulta_visitante' => 'Datos visitante',
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

        $criteria->compare('consulta_id', $this->consulta_id);
        // $criteria->compare('consulta_radicado', $this->consulta_radicado, true);
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
