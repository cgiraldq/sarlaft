<?php

/**
 * This is the model class for table "tbl_parametros".
 *
 * The followings are the available columns in table 'tbl_parametros':
 * @property integer $par_id
 * @property string $par_envio_correo
 * @property string $par_correo
 * @property string $par_formatos_validos
 *
 * The followings are the available model relations:
 * @property ParametrosStatus $parametrosStatus
 */
class Parametros extends CActiveRecord {

    public $validaCampos;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_parametros';
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'par_id' => 'Id',
            'par_envio_correo' => 'Enviar correo',
            'par_correo' => 'Correo formulario',
            'par_formatos_validos' => 'Formatos válidos adjuntos',
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
