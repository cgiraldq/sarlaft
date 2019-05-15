<?php

/**
 * This is the model class for table "tbl_persona_formulario".
 *
 * The followings are the available columns in table 'tbl_persona_formulario':
 * @property integer $per_id
 * @property string $per_nombre
 * @property integer $per_tipo_identificacion_id
 * @property string $per_identificacion
 * @property string $per_observacion
 * @property integer $per_formulario_id
 *
 * The followings are the available model relations:
 * @property Formulario $formulario
 */
class Persona_formulario extends CActiveRecord {

    public $validaCampos;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_persona_formulario';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // class name for the relations automatically generated below.
        return array(
            // 'userProfile' => array(self::BELONGS_TO, 'Profiles', 'id_profile'),
			 'formulario' => array(self::BELONGS_TO, 'Formulario', 'per_formulario_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'per_id' => 'Id',
            'per_nombre' => 'Nombre completo o Razón Social',
            'per_tipo_identificacion_id' => 'Tipo Identificación',
            'per_identificacion' => 'Número Identificación',
            'per_observacion' => 'Observación',
        );
    }


    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
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
