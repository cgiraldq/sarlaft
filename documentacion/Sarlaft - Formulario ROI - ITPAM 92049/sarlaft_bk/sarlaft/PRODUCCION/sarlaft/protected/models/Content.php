<?php

/**
 * This is the model class for table "tbl_content".
 *
 * The followings are the available columns in table 'tbl_content':
 * @property integer $content_id
 * @property string $alias
 * @property string $category
 * @property string $title
 * @property string $content
 * @property integer $published
 * @property string $date_init
 * @property string $date_end
 * @property string $creadopor
 * @property string $fechacreacion
 * @property string $modificadopor
 * @property string $fechamodificacion
 */
class Content extends CActiveRecord
{
        
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('alias, category, title, content, published, date_init, date_end, creadopor, fechacreacion, modificadopor, fechamodificacion', 'filter', 'filter'=>'trim'),
			array('published', 'numerical', 'integerOnly'=>true),
			array('alias, creadopor, modificadopor', 'length', 'max'=>100),
			array('category', 'length', 'max'=>200),
			array('title', 'length', 'max'=>1000),
			array('content, date_init, date_end, fechacreacion, fechamodificacion', 'safe'),
			array('fechacreacion','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false, 'on'=>'insert'),
			array('fechamodificacion','default', 'value'=>null, 'setOnEmpty'=>false, 'on'=>'insert'),
			array('fechamodificacion','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false, 'on'=>'update'),
			array('creadopor','default', 'value'=>Yii::app()->user->name, 'setOnEmpty'=>false, 'on'=>'insert'),
			array('modificadopor','default', 'value'=>null, 'setOnEmpty'=>false, 'on'=>'insert'),
			array('modificadopor','default', 'value'=>Yii::app()->user->name, 'setOnEmpty'=>false, 'on'=>'update'),// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('content_id, alias, category, title, content, published, date_init, date_end, creadopor, fechacreacion, modificadopor, fechamodificacion', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                       
			'content_id' => 'Contenido ID',
			'alias' => 'Alias',
			'category' => 'Categoria',
			'title' => 'Titulo',
			'content' => 'Contenido',
			'published' => 'Publicado',
			'date_init' => 'Fecha Inicio Publicación',
			'date_end' => 'Fecha Finalización Publicación',
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

		$criteria->compare('content_id',$this->content_id);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('published',$this->published);
		$criteria->compare('date_init',$this->date_init,true);
		$criteria->compare('date_end',$this->date_end,true);
		$criteria->compare('creadopor',$this->creadopor,true);
		$criteria->compare('fechacreacion',$this->fechacreacion,true);
		$criteria->compare('modificadopor',$this->modificadopor,true);
		$criteria->compare('fechamodificacion',$this->fechamodificacion,true);
                          
                $sort = new CSort();
                $sort->attributes = array('content_id');
                $sort->defaultOrder = array('content_id' => 'DESC');

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
	 * @return Content the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
