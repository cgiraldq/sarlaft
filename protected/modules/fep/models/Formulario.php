<?php

/**
 * This is the model class for table "tbl_formulario_fep".
 *
 * The followings are the available columns in table 'tbl_formulario_fep':
 * @property integer $fep_id
 * @property string $fep_radicado
 * @property string $fep_nombre
 * @property string $fep_razon_social
 * @property string $fep_nit
 * @property string $fep_persona_responsable
 * @property string $fep_cargo
 * @property string $fep_direccion
 * @property string $fep_telefono
 * @property string $fep_celular
 * @property string $fep_email
 * @property string $fep_descripcion_soli
 * @property string $fep_pais_id
 * @property string $fep_departamento_id
 * @property string $fep_ciudad_id
 * @property string $fep_fecha_ini_even
 * @property string $fep_fecha_fin_even
 * @property string $fep_observaciones
 * @property integer $fep_tipo_moneda
 * @property string $fep_valor_soli_sin_iva
 * @property integer $fep_tipo_publico
 * @property integer $fep_numero_patrocinadores
 * @property string $fep_patrocinadores
 * @property string $fep_grupo_interes
 * @property integer $fep_patrocinios_anteriores
 * @property string $fep_info_adicional
 * @property integer $fep_usuario
 * @property string $fep_ip
 * @property integer $fep_usuario_id
 * @property string $fep_visitante
 * @property string $fep_comite
 * @property string $fep_soporte_inventario
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
        return 'tbl_formulario_fep';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fep_nombre,fep_razon_social,fep_nit,fep_persona_responsable,fep_cargo,fep_direccion,fep_telefono,fep_celular,fep_email,fep_descripcion_soli,fep_pais_id,fep_departamento_id,fep_ciudad_id,fep_fecha_ini_even,fep_fecha_fin_even,fep_tipo_moneda,fep_valor_soli_sin_iva,fep_tipo_publico,fep_numero_patrocinadores,fep_patrocinadores,fep_grupo_interes,fep_patrocinios_anteriores', 'required', 'on' => 'insert'),
			array('fep_nombre,fep_razon_social,fep_nit,fep_persona_responsable,fep_cargo,fep_direccion,fep_telefono,fep_celular,fep_email,fep_descripcion_soli,fep_pais_id,fep_departamento_id,fep_ciudad_id,fep_fecha_ini_even,fep_fecha_fin_even,fep_observaciones,fep_tipo_moneda,fep_valor_soli_sin_iva,fep_tipo_publico,fep_numero_patrocinadores,fep_patrocinadores,fep_grupo_interes,fep_patrocinios_anteriores,fep_info_adicional,fep_comite,fep_soporte_inventario', 'safe'),
            // array('fep_identificacion_persona,fep_reportante_identificacion', 'numerical', 'integerOnly' => true, 'on' => 'insert'),

			// array('fep_nombre_persona,fep_nombre_persona', 'match' , 'pattern'=> '/^[A-Za-zñÑáÁéÉíÍóÓúÚ\d_\s]$/i', 'message'=> 'Este campo solo puede contener texto'),
			// array('fep_nombre_persona', 'match' , 'pattern'=> '/^([a-z ñáéíóú][0-9])$/i', 'message'=> 'Este campo no puede contener caracteres especiales'),
			//array('fep_email', 'email', 'message' => 'Este campo debe contener una dirección de correo electrónico válida'),
			// array('fep_codigo_postal', 'match' , 'pattern'=> '/^[0-9]{5,5}([- ]?[0-9]{4,4})?$/', 'message'=> 'El código postal no es válido'),
			// array('fep_direccion', 'match' , 'pattern'=> '[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?)*', 'message'=> 'La dirección es inválida'),
			// array('fep_telefono', 'match' , 'pattern'=> '/^(\(?[0-9]{3,3}\)?|[0-9]{3,3}[-. ]?)[ ][0-9]{3,3}[-. ]?[0-9]{4,4}$/', 'message'=> 'El número de teléfono no es válido'),
			
			// array('farchivo', 'file', 'types'=>'pdf, doc, docx, jpg, jpeg, png, gif', 'maxSize'=>1024*1024*3, 'tooLarge'=>'El archivo no puede exceder los 3MB.', 'allowEmpty'=>false),
			// array('fep_file','file', 'maxFiles'=>5, 'on'=>'insert','message'=>'El número máximo de archivos a subir es 5'),
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
            //'formularioEmpresa' => array(self::BELONGS_TO, 'Empresa', 'fep_empresa_id'),
            // 'formularioClase' => array(self::BELONGS_TO, 'Clase', 'fep_clase_id'),
            // 'formularioCanal' => array(self::BELONGS_TO, 'Canal', 'fep_canal_id'),
            // 'formularioTipo' => array(self::BELONGS_TO, 'Tipo', 'fep_tipo_id'),
            // 'formularioAccion' => array(self::BELONGS_TO, 'Accion', 'fep_accion_id'),
            'formularioPais' => array(self::BELONGS_TO, 'Pais', 'fep_pais_id'),
            'formularioDepartamento' => array(self::BELONGS_TO, 'Departamento', 'fep_departamento_id'),
            'formularioCiudad' => array(self::BELONGS_TO, 'Ciudad', 'fep_ciudad_id'),
            //'formularioRadicado' => array(self::BELONGS_TO, 'Formulario', 'fep_complemento_id'),
			
//			'userProfileImg' => array(self::BELONGS_TO, 'MvcAttachment', 'pic_profile_id'),
        );
    }


	 /****************************************************************************
	 ************ FUNCIONES DE PRUEBAS TRATANDO DE FILTRAR fep_radicado **********
	 *****************************************************************************/
	/*
	public function fields()
	{
		return array(
			// field name is "name", its value is defined by a PHP callback
           'fep_id',
	   'fep_nombre',
            'fep_radicado',
           
            'fep_complemento',
            'fep_complemento_id',
            'fep_tipo_identificacion_id',
            'fep_identificacion_persona',
            'fep_nombre_persona',
            'fep_sucursal_operacion',
            'fep_pais_id',
            'fep_departamento_id',
            'fep_ciudad_id',
            'fep_direccion',
            'fep_telefono',
			'fep_codigo_postal',
            'fep_grupo_interes_id',
            'fep_grupo_interes_otro',
            'fep_tipo_operacion_id',
            'fep_tipo_operacion_otro',
            'fep_persona',
            'fep_descripcion_consulta',
            'fep_fecha_cierre',
            'fep_producto_id',
            'fep_otros_datos_contacto',
            'fep_file',
            'fep_prueba',
            'fep_estado_id',
            'fep_usuario_id',
			'fep_visitante',
			'fep_radicado' => function () {
				return Controller::sincifrar($this->fep_radicado);
			},
		);
	}
	*/
	
	/*
	public function fields()
	{
		$fields = parent::fields();

		// remove fields that contain sensitive information
		 $fields['fep_radicado'] = $this->sincifrar($fields['fep_radicado']);

		return $fields;
	}
	*/
	
     /*
	 public function getRadicado(){
          return  Controller::sincifrar($this->fep_radicado);
     }
	 */
	 
	 /****************************************************************************/
	 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
			 'fep_id' => 'Form',
			 'fep_radicado' => 'Radicado',
			 'fep_nombre' => 'Nombre del Evento',
			 'fep_razon_social' => 'Razón Social<br><p style="font-size:9px;  padding: 0;">(Nombre completo en caso de que sea persona natural)</p>',
			 'fep_nit' => 'Nit<br><p style="font-size:9px;  padding: 0;">(Cédula en caso de que sea persona natural)</p>',
			 'fep_persona_responsable' => 'Persona responsable de la solicitud',
			 'fep_cargo' => 'Cargo',
			 'fep_direccion' => 'Dirección',
			 'fep_telefono' => 'Teléfono(s)',
			 'fep_celular' => 'Celular',
			 'fep_email' => 'Email<br><p style="font-size:9px;  padding: 0;">(Este será utilizado para enviar información de la solicitud )</p>',
			 'fep_descripcion_soli' => 'Descripción de la solicitud',
			 'fep_pais_id' => 'Pais',
			 'fep_departamento_id'  => 'Departamento',
			 'fep_ciudad_id'  => 'Ciudad',
			 'fep_fecha_ini_even' => 'Fecha de inicio del evento o patrocinio',
			 'fep_fecha_fin_even' => 'Fecha de fin del evento o patrocinio',
			 'fep_observaciones' => 'Observaciones',
			 'fep_tipo_moneda' => 'Tipo de Moneda',
			 'fep_valor_soli_sin_iva' => 'Valor de la solicitud sin IVA',
			 'fep_tipo_publico' => 'Tipo de público al que va dirigido la solicitud',
			 'fep_numero_patrocinadores' => 'Número de patrocinadores',
			 'fep_patrocinadores' => 'Indicar patrocinadores',
			 'fep_grupo_interes' => '¿ El destinatario del evento/patrocinio hace parte de algún grupo de interés de TigoUne (accionista, cliente, proveedor, aliado, entre otros)?',
			 'fep_patrocinios_anteriores' => '¿ Ha recibido el destinatario patrocinios de TigoUne o Millicom anteriormente?',
			 'fep_info_adicional' => 'Adjuntar Archivos ',
			 'fep_soporte_inventario' => 'Adjuntar Soporte inventario',
			
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

        $criteria->compare('fep_id', $this->fep_id);
        $criteria->compare('fep_radicado', $this->fep_radicado, true);
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
