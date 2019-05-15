<?php

/**
 * This is the model class for table "tbl_permisos_formulario_consulta".
 *
 * The followings are the available columns in table 'tbl_permisos_formulario_consulta':
 * @property integer $tid_id
 * @property string $tid_nombre
 *
 * The followings are the available model relations:
 * @property Tipo_identificacionStatus $tipo_identificacionStatus
 */
class Validar_Usuario extends CActiveRecord {

    public $validaCampos;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_comite_aprobacion_ep';
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
            'id_permiso' => 'Id',
            'login_usuario' => 'Login',
			'area' => 'area',
			'fechacreacion' => 'Fecha Creación',
			'modificadopor' => 'Modificado por',
			'fechamodificacion' => 'Fecha modificación',
        );
    }


    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('login_usuario', $this->login_usuario);


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
