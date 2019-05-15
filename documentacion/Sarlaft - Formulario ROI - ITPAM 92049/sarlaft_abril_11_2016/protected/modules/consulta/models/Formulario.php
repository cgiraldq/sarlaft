<?php

/**
 * This is the model class for table "tbl_formulario_consulta".
 *
 * The followings are the available columns in table 'tbl_formulario_consulta':
 * @property integer $consulta_id
 * @property string $consulta_tipo_identificacion_id
 * @property string $consulta_identificacion_persona
 * @property string $consulta_nombre_persona
 * @property string $farchivo
 * @property string $consulta_fecha
 * @property integer $consulta_usuario
 * @property integer $consulta_prueba
 * @property string $consulta_ip
 * @property integer $consulta_usuario_id
 *
 * The followings are the available model relations:
 * @property FormularioStatus $formularioStatus
 */
class Formulario extends CActiveRecord {

    // public $passwd2;
    public $file;
	public $farchivo;
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
            // array('consulta_identificacion_persona,consulta_nombre_persona', 'required', 'on' => 'insert'),
			array('farchivo', 'file', 'types'=>'txt,scv', 'maxSize'=>1024*1024*10, 'tooLarge'=>'El archivo no puede exceder los 10MB.', 'allowEmpty'=>true, 'safe' => false),
			array('consulta_tipo_identificacion_id,consulta_identificacion_persona,consulta_nombre_persona', 'safe'),
            // array('consulta_identificacion_persona,consulta_reportante_identificacion', 'numerical', 'integerOnly' => true, 'on' => 'insert'),

			// array('consulta_nombre_persona,consulta_nombre_persona', 'match' , 'pattern'=> '/^[A-Za-zñÑáÁéÉíÍóÓúÚ\d_\s]$/i', 'message'=> 'Este campo solo puede contener texto'),
			// array('consulta_nombre_persona', 'match' , 'pattern'=> '/^([a-z ñáéíóú][0-9])$/i', 'message'=> 'Este campo no puede contener caracteres especiales'),
			//array('consulta_email', 'email', 'message' => 'Este campo debe contener una dirección de correo electrónico válida'),
			// array('consulta_codigo_postal', 'match' , 'pattern'=> '/^[0-9]{5,5}([- ]?[0-9]{4,4})?$/', 'message'=> 'El código postal no es válido'),
			// array('consulta_direccion', 'match' , 'pattern'=> '[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?)*', 'message'=> 'La dirección es inválida'),
			// array('consulta_telefono', 'match' , 'pattern'=> '/^(\(?[0-9]{3,3}\)?|[0-9]{3,3}[-. ]?)[ ][0-9]{3,3}[-. ]?[0-9]{4,4}$/', 'message'=> 'El número de teléfono no es válido'),
			// array('consulta_file','file', 'maxFiles'=>5, 'on'=>'insert','message'=>'El número máximo de archivos a subir es 5'),
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
            // 'formularioTipo' => array(self::BELONGS_TO, 'Tipo', 'consulta_tipo_id'),
			
			// 'userProfileImg' => array(self::BELONGS_TO, 'MvcAttachment', 'pic_profile_id'),
        );
    }



    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'consulta_id' => 'Form',
            'consulta_tipo_identificacion_id' => 'Tipo de identificación',
            'consulta_identificacion_persona' => 'Identificación ',
            'consulta_nombre_persona' => 'Nombre',
            'farchivo' => 'Archivo',
			'consulta_prueba' => 'Prueba',
            'consulta_estado_id' => 'Estado',
            'consulta_usuario' => 'Usuario',
            'consulta_usuario_id' => 'Estado usuario',
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
        // $criteria->compare('sn', $this->sn, true);
        // $criteria->compare('samaccountname', $this->samaccountname, true);
        // $criteria->compare('employeenumber', $this->employeenumber, true);
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
