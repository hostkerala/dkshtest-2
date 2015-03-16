<?php

/**
 * This is the model class for table "categories".
 *
 * The followings are the available columns in table 'categories':
 * @property integer $id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property RelTopicCategory[] $relTopicCategories
 */
class Categories extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Categories the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'length', 'max' => 255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name', 'safe', 'on' => 'search'),
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
			'relTopicCategories' => array(self::HAS_MANY, 'RelTopicCategory', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public static function getCategoriesFilterList()
	{
		$catlist = Categories::model()->findAll();
                $dropdownCatList = array();
		foreach ($catlist as $key => $category) {
			$dropdownCatList[$key]['label'] = $category->name;
			$dropdownCatList[$key]['url'] = Yii::app()->createUrl('/topic/index', array('category_id' => $category->id));
		}
		array_unshift($dropdownCatList, array('label' => 'All', 'url' => '/topic/index'));
		return $dropdownCatList;
	}

	public static function getLabelCategoriesFilter()
	{
		$category_id = Yii::app()->request->getQuery('category_id');
		if ($category_id && $model = Categories::model()->findByPk($category_id)) {
			return $model->name;
		};
		return 'Select category';

	}
}