<?php

/**
 * This is the model class for table "tbl_grupo_interes".
 *
 * The followings are the available columns in table 'tbl_grupo_interes':
 * @property integer $tip_id
 * @property string $tip_nombre
 *
 * The followings are the available model relations:
 * @property Grupo_interesStatus $grupo_interesStatus
 */
class Grupo_interes extends CActiveRecord {

    public $validaCampos;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_grupo_interes';
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
            'gru_id' => 'Id',
            'gru_nombre' => 'Grupo de Interés',
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
