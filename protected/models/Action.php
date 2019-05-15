<?php

/**
 * This is the model class for table "tbl_action".
 *
 * The followings are the available columns in table 'tbl_action':
 * @property integer $action_id
 * @property string $action
 * @property string $description
 * @property string $creadopor
 * @property string $fechacreacion
 * @property string $modificadopor
 * @property string $fechamodificacion
 *
 * The followings are the available model relations:
 * @property PermissionsRoles[] $permissionsRoles
 */
class Action extends CActiveRecord
{
        
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_action';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('action, description, creadopor, fechacreacion, modificadopor, fechamodificacion', 'filter', 'filter'=>'trim'),
			array('description', 'required'),
			array('action, creadopor, modificadopor', 'length', 'max'=>100),
			array('description', 'length', 'max'=>255),
			array('fechacreacion, fechamodificacion', 'safe'),
			array('fechacreacion','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false, 'on'=>'insert'),
			array('fechamodificacion','default', 'value'=>null, 'setOnEmpty'=>false, 'on'=>'insert'),
			array('fechamodificacion','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false, 'on'=>'update'),
			array('creadopor','default', 'value'=>Yii::app()->user->name, 'setOnEmpty'=>false, 'on'=>'insert'),
			array('modificadopor','default', 'value'=>null, 'setOnEmpty'=>false, 'on'=>'insert'),
			array('modificadopor','default', 'value'=>Yii::app()->user->name, 'setOnEmpty'=>false, 'on'=>'update'),// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('action_id, action, description, creadopor, fechacreacion, modificadopor, fechamodificacion', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'permissionsRoles' => array(self::HAS_MANY, 'PermissionsRoles', 'action'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                       
			'action_id' => 'Action',
			'action' => 'Action',
			'description' => 'Description',
			'creadopor' => 'Creado por',
			'fechacreacion' => 'Fecha Creación',
			'modificadopor' => 'Modificado Por',
			'fechamodificacion' => 'Fecha Modificación',
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
	public function search($pagination = array( 'pageSize'=>10))
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('action_id',$this->action_id);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('creadopor',$this->creadopor,true);
		$criteria->compare('fechacreacion',$this->fechacreacion,true);
		$criteria->compare('modificadopor',$this->modificadopor,true);
		$criteria->compare('fechamodificacion',$this->fechamodificacion,true);
               $criteria->with = array(               			'permissionsRoles'=>array('select'=>'action_id'),                          
               );           
                $sort = new CSort();
                //$sort->attributes = array('action_id');
                $sort->defaultOrder = array('action_id' => 'DESC');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>$pagination,
                        'sort' => $sort,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Action the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
