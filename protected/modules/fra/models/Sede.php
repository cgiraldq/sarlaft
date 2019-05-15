<?php

/**
 * This is the model class for table "tbl_pais".
 *
 * The followings are the available columns in table 'tbl_pais':
 * @property integer $pai_id
 * @property string $pai_nombre
 *
 * The followings are the available model relations:
 * @property SedeStatus $paisStatus
 */
class Sede extends CActiveRecord {

    public $validaCampos;
	
	
		
 public function getFullName()
   {
      return $this->ciudad . "  - " . $this->sede. "(" . $this->contacto. "  - " . $this->descripcion.")";
   }


 public function getSedev()
   {
      return $this->ciudad . "  - " . $this->sede. "(" . $this->email.")";
   }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_sedes_regalos';
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
            'id_sede' => 'Id',
            'ciudad' => 'Ciudad',
            'sede' => 'Sede',
            'contacto' => 'Contacto',
            'email' => 'Email',
            'descripcion' => 'Descripción',
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
